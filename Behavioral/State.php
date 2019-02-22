<?php

/**
 * 状态模式
 *
 * 据说是根策略模式很像的一种模式，但是我总觉得不像，我觉得像的地方仅仅是因为算法集的替换，其实就是遵循了设计原则
 *
 * 状态模式我的理解是，状态是独立出来的算法簇，而操作行为是固定的，这样的效果是，会有很多对象、抽象的存在
 *
 * 举个例子，有一个饮水机，下面有个开关，有个按压(press)的操作，然后饮水机其实有两个状态，一个是有水，一个是没水
 *
 * 根据这个按压的操作，两个状态，我们就可以通过状态模式来实现一下，饮水机其实是我们的上下文
 */

interface StateContext
{
    public function setState(StateInterface $state);

    public function getState();
}

// 两个状态其实都包含 press 操作
interface StateInterface
{
    public function press(StateContext $stateContext);
}

// 有水的状态
class FullState implements StateInterface
{
    // 剩余按压次数
    private $count = 3;

    public function press(StateContext $stateContext)
    {
        if (-- $this->count >= 0) {
            echo '水流出来了 ...', PHP_EOL;
        } else {
            $stateContext->setState(new EmptyState());
            echo '水没有了 ...', PHP_EOL;
        }
    }

}

// 没水的状态
class EmptyState implements StateInterface
{

    public function press(StateContext $stateContext)
    {
        echo '别按了，水真的没有了 ...', PHP_EOL;
    }

}

// 饮水机
class YinShuiJiContext implements StateContext
{
    private $state;

    public function __construct()
    {
        // 初始化是有水的
        $this->setState(new FullState());
    }

    public function setState(StateInterface $state)
    {
        $this->state = $state;
    }

    public function getState()
    {
        return $this->state;
    }

    public function press()
    {
        $this->getState()->press($this);
    }

}

$yinshuiji = new YinShuiJiContext();
$yinshuiji->press();
$yinshuiji->press();
$yinshuiji->press();
$yinshuiji->press();
$yinshuiji->press();
