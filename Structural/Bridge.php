<?php

/**
 * 模式名称: 桥接 (Bridge)
 * 模式类型: 结构型
 * 模式描述: 将实现与抽象完全分离 (实现是针对抽象的实现)
 * 解决的问题: 实现与抽象分离，这样实现与抽象可以单独变化而不会互相造成影响
 * 优点: 实现与抽象分离，完全遵循开闭原则
 * 缺点: 多了很多中间实现类
 * 和它类似的模式: 策略、门面、抽象工厂，策略的意思是依赖抽象，算法集可以随时替换，实现类充当门面，很像抽象工厂了，不过工厂注重成产对象，并不注重实现，这也就是它作为创造型模式的原因吧
 */

interface Formatter
{
    public function format($content);
}

class JsonFormatter implements Formatter
{

    public function format($content)
    {
        if (is_array($content)) {
            return json_encode($content);
        }

        return false;
    }

}

class TextFormatter implements Formatter
{

    public function format($content)
    {
        return strval($content);
    }

}

// 格式化桥接类
abstract class FormatterBridge
{
    protected $formatter;

    public function __construct(Formatter $formatter)
    {
        $this->formatter = $formatter;
    }

    public function setFormatter(Formatter $formatter)
    {
        $this->formatter = $formatter;
    }

    // 获取格式化之后的内容
    abstract function getFormattedContent();
}

class AppFirst extends FormatterBridge
{

    function getFormattedContent()
    {
        return $this->formatter->format('我是应用1的数据');
    }

}

class AppSecond extends FormatterBridge
{

    function getFormattedContent()
    {
        return $this->formatter->format('我是应用2的数据');
    }

}
