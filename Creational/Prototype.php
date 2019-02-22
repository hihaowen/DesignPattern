<?php

/**
 * 模式名称: 原型模式 (Prototype)
 * 模式类型: 创建型
 * 模式描述: 通过对实体的抽象，抽象类中有个__clone来实现对象的生成，从而代替 new 操作
 * 解决的问题: 大量具有相同属性的对象数据生成，代替 new 操作
 * 优点: 节省 new 对象开销、抽象画数据构成
 * 缺点: 感觉有时其实没必要对数据生成对象
 * 和它类似的模式: 暂无
 */

abstract class ProductPrototype
{
    // 商品类别
    protected $category;

    // 商品名称
    private $title;

    public abstract function __clone();

    public function __construct()
    {
        $this->category = static::class;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getTitle()
    {
        return $this->title;
    }
}

// 课程
class CourseProduct extends ProductPrototype
{
    public function __clone()
    {
        // TODO: Implement __clone() method.
    }
}

// 书籍
class BookProduct extends ProductPrototype
{
    public function __clone()
    {
        // TODO: Implement __clone() method.
    }
}

$courseProduct = new CourseProduct();

$dataSet = [];

foreach (range(1, 5) as $title)
{
    $courseProduct = clone $courseProduct;
    $courseProduct->setTitle('title - ' . $title);

    $dataSet[] = $courseProduct;
}

print_r($dataSet);
