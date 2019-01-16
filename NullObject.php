<?php

/**
 * 模式名称: 空对象模式 (NullObject)
 * 模式类型: 行为型
 * 模式描述: 使系统代码结构更健壮、完善
 * 解决的问题: 减少空指针异常
 * 优点: 暂无
 * 缺点: 多了些空类型的代码
 * 和它类似的模式: 暂无
 */

interface Logger
{
    public function log($message);
}

class ConsoleLogger implements Logger
{

    public function log($message)
    {
        echo 'hi, i am Console Logger.', PHP_EOL;
    }

}

class NullLogger implements Logger
{

    public function log($message)
    {
        // Do no thing ...
    }

}
