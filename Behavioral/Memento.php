<?php

/**
 * 模式名称: 纪念品模式 (Memento)
 * 模式类型: 行为模式
 * 模式描述: 该模式适合带有状态机类型的场景，类似于MySQL中的事务阶段提交特性，方便随时回滚到上一阶段状态
 * 解决的问题: 恢复对象在不同阶段的变更
 * 优点: 暂无
 * 缺点: 多了不少状态保存的代码
 * 和它类似的模式: 暂无
 */

// 状态类
class State
{
    const CHECK = 1;
    const DONE = 2;
    const DELETE = 3;

    private $state;

    public function __construct($state)
    {
        if (! in_array($state, [self::CHECK, self::DONE, self::DELETE]))
        {
            throw new \InvalidArgumentException('不存在的状态');
        }

        $this->state = $state;
    }

    public function __toString()
    {
        return $this->state;
    }
}

// 记录当前状态
class Memento
{
    private $state;

    public function __construct(State $state)
    {
        $this->state = $state;
    }

    public function getState()
    {
        return $this->state;
    }
}

// 下单流程
class Order
{
    private $currentState;

    // 创建
    public function create()
    {
        $this->currentState = new State(State::CHECK);
    }

    // 处理完成
    public function done()
    {
        $this->currentState = new State(State::DONE);
    }

    // 删除
    public function delete()
    {
        $this->currentState = new State(State::DELETE);
    }

    // 保存当前阶段状态
    public function saveCurrentState()
    {
        return new Memento($this->currentState);
    }

    // 重置当前阶段状态
    public function resetCurrentState(Memento $memento)
    {
        $this->currentState = $memento->getState();
    }
}

$order = new Order();

// 下单
$order->create();

$memento = $order->saveCurrentState();

// 删除
$order->delete();

// 恢复
$order->resetCurrentState($memento);
