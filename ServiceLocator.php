<?php

/**
 * 模式名称: 服务定位器 (ServiceLocator)
 * 模式类型: 其它型
 * 模式描述: 将所需要对象提前注册进服务定位器，方便随时调用
 * 解决的问题: 解决对象之间的依赖问题
 * 优点: 防止了对象资源的滥用、解决了对象之间的强依赖关系、由于它是不强制用户使用的，因此更容易接入到现有系统中
 * 缺点: 隐藏了被依赖对象的内部细节，加大了排查问题的难度
 * 和它类似的模式: 依赖注入，同样实现了控制反转 (Ioc)，运用了对象池的概念，提前将对象保存，便于调用
 */

interface PsrContainerInterface
{
    public function get($id);

    public function has($id);
}

class ServiceLocator implements PsrContainerInterface
{
    // 服务对应参数集合
    protected $services = [];

    // 实例化的对象集合
    protected $instantiated = [];

    // 是否需要共享
    protected $shared = [];

    /**
     * 获取注册的服务对象
     *
     * @param $id
     * @return Object
     * @throws Exception
     */
    public function get($id)
    {
        // 如果存在实例化的对象，并且是共享属性，则直接返回
        if (isset($this->instantiated[$id]) && isset($this->shared[$id])) {
            return $this->instantiated[$id];
        }

        if (! $this->has($id)) {
            throw new \Exception('不存在的服务: ' . $id, -1);
        }

        // 类反射
        $reflectionClass = new ReflectionClass($id);

        if (! $reflectionClass->isInstantiable()) {
            throw new \Exception('该服务不能被实例化: ' . $id, -1);
        }

        $constructor = $reflectionClass->getConstructor();

        if ($constructor instanceof \ReflectionMethod) {
            $paramsCount = $constructor->getNumberOfParameters();

            if ($paramsCount === 0) {
                return $reflectionClass->newInstance();
            }

            $renderParams = $this->services[$id];

            // 填充可选字段
            if ($paramsCount > $renderParamsCount = count($renderParams)) {
                $params = $constructor->getParameters();

                $appendParams = array_splice($params, $renderParamsCount - 1);

                foreach ($appendParams as $appendParam) {
                    if ($appendParam->isOptional()) {
                        array_push($renderParams, $appendParam->getDefaultValue());
                    }
                }
            }

            if ($paramsCount != $renderParamsCount = count($renderParams)) {
                throw new \Exception(sprintf('Service %s 参数数量错误, 需要 %d, 实际: %d', $id, $paramsCount, $renderParamsCount), -1);
            }

            return $reflectionClass->newInstanceArgs($renderParams);
        }

        return $reflectionClass->newInstance();
    }

    /**
     * 是否存在该服务
     *
     * @param $id
     * @return bool
     */
    public function has($id)
    {
        return isset($this->services[$id]);
    }

    /**
     * 添加一个服务对象
     *
     * @param object|string $id
     * @param array $params
     * @param bool $shared
     * @return $this
     */
    public function add($id, $params = [], $shared = true)
    {
        if (is_object($id)) {
            $this->instantiated[get_class($id)] = $id;
            $id = get_class($id);
        }

        $this->services[$id] = $params;

        $this->shared = boolval($shared);

        return $this;
    }
}

class A
{
    protected $arg1, $arg2, $arg3;

    public function __construct($arg1, $arg2, $arg3 = 'default')
    {
        $this->arg1 = $arg1;
        $this->arg2 = $arg2;
        $this->arg3 = $arg3;
    }
}

class B
{
    protected $arg1, $arg2, $arg3;

    public function __construct($arg1, $arg2, $arg3)
    {
        $this->arg1 = $arg1;
        $this->arg2 = $arg2;
        $this->arg3 = $arg3;
    }
}

class C
{

}

$serviceLocator = new ServiceLocator();
$serviceLocator->add('A', [1, 'argv2']);
$serviceLocator->add('B', [1, 2, 3]);
$serviceLocator->add('C');

var_dump($serviceLocator->get('A'));
var_dump($serviceLocator->get('B'));
var_dump($serviceLocator->get('C'));
