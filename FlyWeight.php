<?php

/**
 * 模式名称: 享元模式 (FlyWeight)
 * 模式类型: 结构型
 * 模式描述:
 * 解决的问题: 对于大量的重复调用相同对象、相同属性的场景来说，会节省内存的开销
 * 优点: 节省内存
 * 缺点:
 * 和它类似的模式: 对象池，单例，都是将对象进行保存，都适用于频繁重复使用的场景，但是单例或者对象池都只是是针对具体的某一个对象进行保存，而享元也是针对同一个对象，区别是享元是根据该对象其中某一属性或者参数不同而进行了区分，本质上是一样的，只不过通过属性或参数进行了分别保存
 */

// 享元接口
interface FlyWeight
{
    public function render($fontName) : string;
}

// 字符
class CharacterFlyWeight implements FlyWeight
{
    protected $character;

    public function __construct($character)
    {
        $this->character = $character;
    }

    public function render($fontName) : string
    {
        return sprintf('character: %s with font: %s', $this->character, $fontName);
    }
}

// 享元获取
class CharacterFactory implements \Countable
{
    private $pool = [];

    public function get($character) : CharacterFlyWeight
    {
        if (! isset($this->pool[$character])) {
            $this->pool[$character] = new CharacterFlyWeight($character);
        }

        return $this->pool[$character];
    }

    public function count()
    {
        return count($this->pool);
    }
}

$characters = range('a', 'z');
$fonts = ['font1', 'font2', 'font3'];

$factory = new CharacterFactory();

foreach ($characters as $character)
{
    $characterObj = $factory->get($character);

    foreach ($fonts as $font)
    {
        echo $characterObj->render($font), PHP_EOL;
    }
}

var_dump($factory->count());
