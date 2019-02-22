<?php

/**
 * 命令模式
 *
 * 主要是将具体的操作转换为对象
 *
 * 适应场景我也不熟悉，目前我是通过例子来加深理解
 *
 * 借用 HEAD FIRST 例子来理解：
 *
 * 我们需要为一个遥控器编写一个程序，这个遥控器上面有两列按钮、一列是开、一列是关，一开一关就是控制一个应用的所有操作了，但是这个遥控器可能有很多应用，有空调控制、有电视控制、有洗衣机控制等等，除了这两列，还有一个撤销操作，可以撤销遥控器最后一次点击操作
 *
 * 分析：
 *  1、需要这个遥控器可以很轻易的添加、删除其中的一个或多个应用
 *  2、每个应用提供的接口可能都不一样
 *  3、如何去撤销最后的一次操作？
 */

// 空调
class KongTiao
{
    public function on()
    {
        echo '开启了空调～', PHP_EOL;
    }

    public function off()
    {
        echo '关闭了空调～', PHP_EOL;
    }
}

// 电视
class DianShi
{
    public function turnOn()
    {
        echo '打开了电视机～', PHP_EOL;
    }

    public function turnOff()
    {
        echo '关闭了电视机～', PHP_EOL;
    }
}

// 洗衣机
class XiYiJi
{
    public function start()
    {
        echo '洗衣机开始洗衣服了～', PHP_EOL;
    }

    public function stop()
    {
        echo '洗衣机停止运行了～', PHP_EOL;
    }
}

// 遥控器操作接口
interface RemoteControlInterface
{
    public function execute();

    public function revert();
}

// 遥控器
class RemoteControl
{
    private $app;

    public function __construct(RemoteControlInterface $app)
    {
        $this->app = $app;
    }

    public function press()
    {
        $this->app->execute();
    }

    public function revert()
    {
        $this->app->revert();
    }
}

// 开启空调对象
class KongTiaoTurnOn implements RemoteControlInterface
{
    private $kongtiao;

    public function __construct()
    {
        $this->kongtiao = new KongTiao();
    }

    public function execute()
    {
        $this->kongtiao->on();
    }
}

/// 关闭空调对象
class KongTiaoTurnoff implements RemoteControlInterface
{
    private $kongtiao;

    public function __construct()
    {
        $this->kongtiao = new KongTiao();
    }

    public function execute()
    {
        $this->kongtiao->off();
    }

    public function revert()
    {
        $this->kongtiao->on();
    }

}

// 开启电视
class DianshiTurnOn implements RemoteControlInterface
{
    private $dianshi;

    public function __construct()
    {
        $this->dianshi = new DianShi();
    }

    public function execute()
    {
        $this->dianshi->turnOn();
    }

    public function revert()
    {
        $this->dianshi->turnOff();
    }
}

// 关闭电视
class DianshiTurnOff implements RemoteControlInterface
{
    private $dianshi;

    public function __construct()
    {
        $this->dianshi = new DianShi();
    }

    public function execute()
    {
        $this->dianshi->turnOff();
    }

    public function revert()
    {
        $this->dianshi->turnOn();
    }
}

// 开启洗衣机
class XiYiJiTrueOn implements RemoteControlInterface
{
    private $xiyiji;

    public function __construct()
    {
        $this->xiyiji = new XiYiJi();
    }

    public function execute()
    {
        $this->xiyiji->start();
    }

    public function revert()
    {
        $this->xiyiji->stop();
    }
}

// 关闭洗衣机
class XiYiJiTrueOff implements RemoteControlInterface
{
    private $xiyiji;

    public function __construct()
    {
        $this->xiyiji = new XiYiJi();
    }

    public function execute()
    {
        $this->xiyiji->stop();
    }

    public function revert()
    {
        $this->xiyiji->start();
    }
}

// 测试
(new RemoteControl(new KongTiaoTurnOn))->press();
(new RemoteControl(new KongTiaoTurnOff))->press();
(new RemoteControl(new DianshiTurnOn()))->press();
(new RemoteControl(new DianshiTurnOff()))->press();
(new RemoteControl(new XiYiJiTrueOn()))->press();
(new RemoteControl(new XiYiJiTrueOff()))->press();

