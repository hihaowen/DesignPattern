<?php

/**
 * 代理模式的意思就是代替我去干什么事情，生活中的例子比如火车票代售点，主要遵循了开闭吧
 */

interface buyTicketInterface
{
    public function buyTicket();
}

class TrainStation
{
    public function buyTicket()
    {
        echo '我买了火车票', PHP_EOL;
    }
}

class TrainProxyStation implements buyTicketInterface
{
    private $station;

    public function __construct()
    {
        $this->station = new TrainStation();
    }

    public function buyTicket()
    {
        echo '我在火车站代售点', PHP_EOL;

        $this->station->buyTicket();
    }

}

(new TrainProxyStation)->buyTicket();
