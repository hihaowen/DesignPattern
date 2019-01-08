<?php

/**
 * 简单工程的意思就是将对象生成的细节隐藏，这也符合最少知道原则
 */

class SmsSender {

}

class EmailSender {

}

class SimpleFactory
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

SimpleFactory::getEmailSender();

SimpleFactory::getSmsSender();
