<?php

/**
 * 抽象工厂
 *
 * 在简单工厂的基础上增加了抽象的概念
 */

interface sendInterface
{
    public function send();
}

class SmsSender implements sendInterface
{

    public function send()
    {
        // TODO: Implement send() method.
    }

}

class EmailSender implements sendInterface
{

    public function send()
    {
        // TODO: Implement send() method.
    }

}

class SenderFactory
{
    public static function getSmsSender()
    {
        return new SmsSender();
    }

    public static function getEmailSender()
    {
        return new EmailSender();
    }
}
