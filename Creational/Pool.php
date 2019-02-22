<?php

/**
 * 模式名称: 对象池 (Pool)
 * 模式类型: 创建型
 * 模式描述: 主要由一个对象实例化的封装类构成，方便重复调用
 * 解决的问题: 可以将需要频繁调用，但是很繁重的对象实例化，方便重复调用
 * 优点: 将复杂繁琐的类的实例化过程封装，提高类的使用效率，避免了重复类实例化的重复过程
 * 缺点: 违反开闭原则，待实例化的对象过于具体
 * 和它类似的模式: 单例，同样是简化对象实例化过程，不同的是，单例对待实例化的对象由要求，而对象池则没有
 */

// 校验对象池
class ValidationRulesPool implements \Countable
{
    // 占用的对象实例
    private $occupiedInstances = [];

    // 释放的对象实例
    private $freeInstances = [];

    // 获取待实例化的对象
    public function get() : NotEmpty
    {
        if (count($this->freeInstances)) {
            $worker = array_pop($this->freeInstances);
        } else {
            $worker = new NotEmpty();
        }

        $this->occupiedInstances[spl_object_hash($worker)] = $worker;

        return $worker;
    }

    // 释放掉指定的实例化对象
    public function dispose($worker)
    {
        $hash = spl_object_hash($worker);

        if (isset($this->occupiedInstances[$hash])) {
            $this->freeInstances[$hash] = $worker;
            unset($this->occupiedInstances[$hash]);
        }

        return false;
    }

    public function count()
    {
        echo 'occupiedInstances:', PHP_EOL;
        print_r($this->occupiedInstances);
        echo 'freeInstances:', PHP_EOL;
        print_r($this->freeInstances);

        return count($this->occupiedInstances + $this->freeInstances);
    }

}

// 待实例化对象
class NotEmpty
{
    private $id;

    public function __construct()
    {
        $this->id = 1;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }
}

$pool = new ValidationRulesPool();

echo '获取2个实例:', PHP_EOL;
$worker1 = $pool->get();
$pool->dispose($worker1);
$worker2 = $pool->get();
echo $pool->count(), PHP_EOL;
