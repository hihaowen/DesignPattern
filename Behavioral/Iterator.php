<?php

/**
 * 迭代器
 *
 * 借用 HEAD FIRST 书中的例子：
 *
 * 有两个餐饮店要合并，一个是煎饼屋，一个是午餐厅，合并后这两个店原来的菜单需要整合在一起，但是有个问题，煎饼屋和午餐厅的菜单结构完全不一样，一个是普通的数组结构，一个是ArrayList结构，所以通过迭代器模式进行统一整合
 *
 * 由于PHP没有 ArrayList 动态数组类型，下面均用数组代替了
 */

// 菜单
class Menu
{
    private $title;

    private $description;

    private $price;

    /**
     * @return mixed
     */
    public function getDescription()
    {

        return $this->description;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {

        return $this->price;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {

        return $this->title;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {

        $this->description = $description;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price)
    {

        $this->price = $price;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {

        $this->title = $title;
    }
}

// 煎饼屋菜单
class JianBingWuMenu
{
    private $menus = [];

    public function __construct()
    {
        $menus = [
            [
                'title' => '煎饼1',
                'description' => '煎饼1描述',
                'price' => 1,
            ],
            [
                'title' => '煎饼2',
                'description' => '煎饼2描述',
                'price' => 2,
            ],
            [
                'title' => '煎饼3',
                'description' => '煎饼3描述',
                'price' => 3,
            ],
        ];

        foreach ($menus as $menu) {
            $menuObj = new Menu();
            $menuObj->setTitle($menu['title']);
            $menuObj->setDescription($menu['description']);
            $menuObj->setPrice($menu['price']);

            $this->menus[] = $menuObj;
        }
    }

    public function createIterator()
    {
        return new CommonMenuIterator($this->menus);
    }
}

// 菜单迭代器
interface MenuIterator
{
    public function next();

    public function hasNext();
}

// 煎饼屋菜单迭代器
class CommonMenuIterator implements MenuIterator
{
    private $menus;

    private $position;

    public function __construct(array $menus)
    {
        $this->menus = $menus;
    }

    public function next()
    {
        $this->position = ! isset($this->position) ? 0 : $this->position + 1;

        return $this->menus[$this->position];
    }

    public function hasNext()
    {
        $nextPosition = ! isset($this->position) ? 0 : $this->position + 1;

        return isset($this->menus[$nextPosition]);
    }
}

class WuCanTingMenu
{
    private $menus = [];

    public function __construct()
    {
        $menus = [
            [
                'title' => '宫保鸡丁',
                'description' => '宫保鸡丁描述',
                'price' => 18,
            ],
            [
                'title' => '鱼香肉丝',
                'description' => '鱼香肉丝描述',
                'price' => 21,
            ],
            [
                'title' => '水煮肉片',
                'description' => '水煮肉片描述',
                'price' => 56,
            ],
        ];

        foreach ($menus as $menu) {
            $menuObj = new Menu();
            $menuObj->setTitle($menu['title']);
            $menuObj->setDescription($menu['description']);
            $menuObj->setPrice($menu['price']);

            $this->menus[] = $menuObj;
        }
    }

    public function createIterator()
    {
        return new CommonMenuIterator($this->menus);
    }
}

// 测试
$jianbingwuIterator = (new JianBingWuMenu())->createIterator();
$wucantingIterator = (new WuCanTingMenu())->createIterator();

$menus = [
    $jianbingwuIterator, $wucantingIterator,
];

echo '合并后的菜单为:', PHP_EOL;

foreach ($menus as $menuIterator) {
    while ($menuIterator->hasNext()) {
        $menu = $menuIterator->next();
        echo "菜名: {$menu->getTitle()}, 单价: {$menu->getPrice()} 描述: {$menu->getDescription()}", PHP_EOL;
    }
}
