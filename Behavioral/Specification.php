<?php

/**
 * 模式名称: 规格模式 (Specification)
 * 模式类型: 行为型
 * 模式描述: 组成由一个规格接口（里面主要由一个 isSatisfiedBy 组成），一个属性类 (主要包含待校验的数据)，一个规格要求类（实现规格接口），一个或多个规格校验类
 * 解决的问题: 避免不可扩展的规格设定
 * 优点: 灵活、可扩展的规格设定
 * 缺点: 类比较多，简单的格式不如硬编码效率高
 * 和它类似的模式: 依赖注入
 */

// 属性类
class Item
{
    protected $price;

    public function __construct($price)
    {
        $this->price = $price;
    }

    public function getPrice()
    {
        return $this->price;
    }
}

// 规格接口
interface SpecificationInterface
{
    public function isSatisfiedBy(Item $item);
}

// 规格要求类
class PriceRequired implements SpecificationInterface
{
    private $min;

    private $max;

    public function __construct($min, $max)
    {
        $this->min = $min;

        $this->max = $max;
    }

    public function isSatisfiedBy(Item $item)
    {
        $inputPrice = $item->getPrice();

        if (($inputPrice <= $this->max) &&
            ($inputPrice >= $this->min))
        {
            return true;
        }

        return false;
    }

}

// 规格校验类 (或的关系)
class OrPriceRequired implements SpecificationInterface
{
    protected $specifications;

    public function __construct(SpecificationInterface ... $specifications)
    {
        $this->specifications = $specifications;
    }

    public function isSatisfiedBy(Item $item)
    {
        foreach ($this->specifications as $specification)
        {
            if ($specification->isSatisfiedBy($item)) return true;
        }

        return false;
    }

}

// 规格校验类 (And的关系)
class AndPriceRequired implements SpecificationInterface
{
    protected $specifications;

    public function __construct(SpecificationInterface ... $specifications)
    {
        $this->specifications = $specifications;
    }

    public function isSatisfiedBy(Item $item)
    {
        foreach ($this->specifications as $specification)
        {
            if (! $specification->isSatisfiedBy($item)) return false;
        }

        return true;
    }

}

// 定义规格
$specificationRequired1 = new PriceRequired(100, 200);
$specificationRequired2 = new PriceRequired(400, 500);

var_dump(
    (new OrPriceRequired($specificationRequired1, $specificationRequired2))->isSatisfiedBy(new Item(450))
);

var_dump(
    (new AndPriceRequired($specificationRequired1, $specificationRequired2))->isSatisfiedBy(new Item(450))
);
