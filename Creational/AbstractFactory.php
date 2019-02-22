<?php

/**
 * 模式名称: 抽象工厂 (AbstractFactory)
 * 模式类型: 创建型
 * 模式描述: 对工厂抽象、对实现对象抽象，完全的多态设计
 * 解决的问题: 将功能聚集，实现功能、调用分离，职责分工
 * 优点: 在遵循原则的基础上互不影响
 * 缺点: 写的类会比较多
 * 和它类似的模式: 暂无
 */

// 发送接口
interface SenderInterface
{
    public function send($userId, $content);
}

// 短信发送
class SmsSender implements SenderInterface
{

    public function send($userId, $content)
    {
        // TODO: Implement send() method.
    }

}

// 邮件发送
class EmailSender implements SenderInterface
{

    public function send($userId, $content)
    {
        // TODO: Implement send() method.
    }

}

// 发送工厂
interface SenderFactory
{
    /**
     * @return SenderInterface
     */
    public function createSender() : SenderInterface;
}

// 短信
class SmsFactory implements SenderFactory
{

    public function createSender() : SenderInterface
    {
        return new SmsSender();
    }

}

// 邮件
class EmailFactory implements SenderFactory
{

    public function createSender() : SenderInterface
    {
        return new EmailSender();
    }

}
