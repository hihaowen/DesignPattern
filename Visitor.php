<?php

/**
 * 模式名称: 访问者 (Visitor)
 * 模式类型: 行为型
 * 模式描述: 将对象A嵌入到对象B中，被调用方B除了自己本身的功能可以使用外，还可以使用A的能力，A就是访问者
 * 解决的问题: 在不改变原有被调用方的结构下，给被调用方增加新特性
 * 优点: 对象与对象之间完全解耦
 * 缺点: 1、访问者可以利用被调用者进行重复的调用，导致死循环 2、被调用方被访问者使用时能使用的功能是相对固定的
 * 和它类似的模式: 状态模式中也有利用到这个特性，但是状态模式要更加复杂
 */

interface VisitorInterface
{
    public function execute(ServiceInterface $service);
}

interface ServiceInterface
{
    public function accept(VisitorInterface $visitor);
}

class MyService implements ServiceInterface
{

    public function sayHi()
    {
        echo 'hi', PHP_EOL;
    }

    public function accept(VisitorInterface $visitor)
    {
        $visitor->execute($this);
    }

}

class Visitor1 implements VisitorInterface
{

    public function execute(ServiceInterface $service)
    {
        echo 'i am visitor1.', PHP_EOL;
    }

}

class Visitor2 implements VisitorInterface
{

    public function execute(ServiceInterface $service)
    {
        echo 'i am visitor2.', PHP_EOL;
    }

}

$service = new MyService();
$service->accept(new Visitor1());
$service->accept(new Visitor2());
$service->sayHi();
