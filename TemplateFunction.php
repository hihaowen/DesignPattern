<?php

/**
 * 模版方法
 *
 * 主要是用于将内部一些固有的并且存在规律的方法进行抽象出来，这也遵循了面向对象设计中的开闭原则
 */

Abstract class DriveCarAbstract
{
    /**
     * 上车
     *
     * @return mixed
     */
    abstract function getOn();

    /**
     * 打开开关
     *
     * @return mixed
     */
    abstract function switchOn();

    /**
     * 行驶
     */
    public final function drive()
    {
        $this->getOn();

        $this->switchOn();

        echo '我开车玩儿去喽～', PHP_EOL;
    }
}

// 奥迪
class DriveAodi extends DriveCarAbstract
{
    function getOn()
    {
        echo '我上了奥迪车', PHP_EOL;
    }

    function switchOn()
    {
        echo '我按下了启动键', PHP_EOL;
    }
}

// 帕萨特
class DrivePassat extends DriveCarAbstract
{
    function getOn()
    {
        echo '我上了帕萨特', PHP_EOL;
    }

    function switchOn()
    {
        echo '我拧开了车钥匙', PHP_EOL;
    }
}

(new DriveAodi())->drive();

echo PHP_EOL;

(new DrivePassat())->drive();
