<?php

/**
 * 装饰模式
 *
 * 有个特点是操作对象和被操作对象遵循同一个接口
 *
 * 这个模式我也不太清除它适合什么场景，下面我看的是网上的一个例子
 *
 * 讲的是老王全副武装的操作，如：戴上墨镜、穿上皮夹克、穿上牛仔裤
 */

interface WearInterface
{
    public function process();
}

// 老王
class LaoWang implements WearInterface
{

    public function process()
    {
        echo '我是老王,我要全副武装了 ~', PHP_EOL;
    }

}

abstract class WearDecorator implements WearInterface
{

    protected $decorator;

    public function __construct(WearInterface $decorator)
    {
        $this->decorator = $decorator;
    }

}

// 戴上墨镜
class WearMoJing extends WearDecorator
{

    public function process()
    {
        $this->decorator->process();

        echo '我戴上墨镜了', PHP_EOL;
    }

}

// 穿上皮夹克
class WearPiJiaKe extends WearDecorator
{

    public function process()
    {
        $this->decorator->process();

        echo '我穿上皮夹克了', PHP_EOL;
    }

}

// 穿上牛仔裤
class WearNiuZaiKu extends WearDecorator
{

    public function process()
    {
        $this->decorator->process();

        echo '我穿上牛仔裤了', PHP_EOL;
    }

}

$laowang = new LaoWang();
$wearMoJinga = new WearMoJing($laowang);
$wearPiJiaKe = new WearPiJiaKe($wearMoJinga);
$wearNiuZaiKu = new WearNiuZaiKu($wearPiJiaKe);
$wearNiuZaiKu->process();
