<?php

/**
 * 门面模式 （也叫外观模式），这个看了下wiki百科的定义，它属于结构型的模式，它隐藏了组合类的实现细节，只是提供给调用方很简单的调用方法
 *
 * （弦外音：应该是最简单的模式了）
 *
 * 栗子：如果媳妇让我去挣钱，她不需要知道我具体怎么做，她只要发号施令就可以了
 *
 * 参考: https://en.wikipedia.org/wiki/Facade_pattern
 */

// 丈夫
class HusbandFacade
{
    public function makeMoney()
    {
        new GetUp();
        new Eat();
        new WorkHard();
    }
}

// 起床
class GetUp
{

}

// 吃饭
class Eat
{

}

// 工作
class WorkHard
{

}

// 媳妇
(new HusbandFacade())->makeMoney();
(new HusbandFacade())->makeMoney();
(new HusbandFacade())->makeMoney();
