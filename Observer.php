<?php

/**
 * 观察者
 *
 * 我给它又叫做：订阅者和被订阅者，很形象的例子是订阅报纸的人和报社之间的关系，报社发布新一期的报纸，订阅报纸的人都会收到这个发布的消息
 *
 * 这个模式的特点就是批量通知，遵循了开闭原则
 */

interface SubscriberInterface
{
    public function notice();
}

class NewspaperOffice
{
    private $subscribers = [];

    public function register(SubscriberInterface $subscriber)
    {
        $this->subscribers[] = $subscriber;
    }

    public function notice()
    {
        foreach ($this->subscribers as $subscriber) {
            $subscriber->notice();
        }
    }
}

class Wife implements SubscriberInterface
{

    public function notice()
    {
        echo '我是妻子，我收到报纸了 ～', PHP_EOL;
    }

}

class Daughter implements SubscriberInterface
{

    public function notice()
    {
        echo '我是女儿，我收到报纸了 ～', PHP_EOL;
    }

}

$newspaperOffice = new NewspaperOffice();
$newspaperOffice->register(new Wife());
$newspaperOffice->register(new Daughter());
$newspaperOffice->notice();
