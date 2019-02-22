<?php

/**
 * 建造者模式，我的自己的理解，乍一看跟抽象工厂非常像，抽象工厂的概念是定义了一个抽象的接口，各个应用去分别实现该接口中的方法，然后有个工厂类去获取各个应用的对象，这样的好处是将应用抽象化，工厂类不去关心应用的具体实现，只需要调用即可，而且工厂类可以随时替换该应用的对象，这样工厂与调用方就可以解耦，提高代码健壮性，而建造者模式跟抽象工厂很像，它有一个导演类，负责具体调配，还有建造者类，他是具体干活儿的，但是具体干什么活儿还得导演说了算，所以建造者要比抽象工厂处理的业务会更复杂，灵活
 *
 * 比如汽车，建造一个汽车需要汽车外壳、汽车轮子、汽车发动机，但是不同类型的汽车外壳、轮子、发动机可能都完全不同，比如大卡车需要6个轮子，轿车需要4个，大卡车的发动机要比小轿车的汽车发动机多一个，轿车的外壳要比大卡车的要小很多，但是它们的创建过程都是一致的，生产汽车外壳，安装轮子、安装发动机
 */

/**
 * 建造者接口 (BuilderInterface)、小轿车建造者 (CarBuilder)、大卡车建造者 (TruckBuilder)
 *
 * 轮子 (Wheel)
 *
 * 发动机 (Engine)
 *
 * 汽车外壳接口 (ShellInterface)、大卡车外壳 (TruckShell)、小轿车外壳 (CarShell)
 *
 * 导演 (Director) (投资人)
 */

// 轮子
class Wheel
{

}

// 发动机
class Engine
{

}

// 汽车外壳接口
interface ShellInterface
{

}

// 大卡车外壳
class TruckShell implements ShellInterface
{

}

// 小轿车外壳
class CarShell implements ShellInterface
{

}

// 汽车建造者接口
interface BuilderInterface
{
    // 生产汽车外壳
    public function produceShell();

    // 安装轮子
    public function installWheel();

    // 安装发动机
    public function installEngine();

    // 出厂
    public function output();
}

// 小轿车建造者
class CarBuilder implements BuilderInterface
{
    protected $parts = [];

    public function produceShell()
    {
        $this->parts['shell'] = new CarShell();
    }

    public function installWheel()
    {
        $this->parts['wheel1'] = new Wheel();
        $this->parts['wheel2'] = new Wheel();
        $this->parts['wheel3'] = new Wheel();
        $this->parts['wheel4'] = new Wheel();
    }

    public function installEngine()
    {
        $this->parts['engine'] = new Engine();
    }

    public function output()
    {
        return $this->parts;
    }
}

// 大卡车建造者
class TruckBuilder implements BuilderInterface
{
    protected $parts = [];

    public function produceShell()
    {
        $this->parts['shell'] = new TruckShell();
    }

    public function installWheel()
    {
        $this->parts['wheel1'] = new Wheel();
        $this->parts['wheel2'] = new Wheel();
        $this->parts['wheel3'] = new Wheel();
        $this->parts['wheel4'] = new Wheel();
        $this->parts['wheel5'] = new Wheel();
        $this->parts['wheel6'] = new Wheel();
    }

    public function installEngine()
    {
        $this->parts['engine'][] = new Engine();
        $this->parts['engine'][] = new Engine();
    }

    public function output()
    {
        return $this->parts;
    }
}

// 导演
class Director
{
    public function build(BuilderInterface $builder)
    {
        $builder->produceShell();
        $builder->installWheel();
        $builder->installEngine();

        return $builder->output();
    }
}

$director = new Director();
$car = $director->build(new CarBuilder());
$truck = $director->build(new TruckBuilder());

echo "小轿车出厂了~", PHP_EOL;
print_r($car);

echo "大卡车出厂了~", PHP_EOL;
print_r($truck);
