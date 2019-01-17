<?php

/**
 * 模式名称: 注册模式 (Registry)
 * 模式类型: 结构型
 * 模式描述: 将对象保存在静态变量中，便于重复调用
 * 解决的问题: 同一对象重复调用问题
 * 优点: 对象共享调用，避免资源浪费
 * 缺点: 功能单一，对于不重复调用的场景不适合
 * 和它类似的模式: 单例、对象池、依赖注入容器的具体实现
 */

class Registry
{
    protected static $objects = [];

    public function set($name, $object)
    {
        self::$objects[$name] = $object;
    }

    public function get($name)
    {
        if (isset(self::$objects[$name])) {
            return isset(self::$objects[$name]);
        }

        throw new \Exception('不存在的对象: ' . $name);
    }
}

