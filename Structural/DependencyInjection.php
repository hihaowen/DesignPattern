<?php

/**
 * 模式名称: 依赖注入 (DependencyInjection)
 * 模式类型: 创建型
 * 模式描述: 解耦对象间的依赖，主要通过构造函数、接口定义、属性三种方式进行对象的引用
 * 解决的问题: 解决对象之间的相互依赖问题，让对象与对象之间完全解耦
 * 优点: 遵循单一职责、依赖倒置 (也叫依赖反转)
 * 缺点: 暂无
 * 和它类似的模式: 它更像是一种指导思想，而不讲究具体的实现
 */

// 定义一个电话的接口
interface Phone
{
    public function call();
}

class IPhone implements Phone
{

    public function call()
    {
        // I'm IPhone.
    }

}

class Person
{
    private $phone;

    public function __construct(Phone $phone)
    {
        $this->phone = $phone;
    }

    public function callMyMathor()
    {
        // 1. 准备想说的话
        // @todo

        // 2. 打电话
        $this->phone->call();
    }
}
