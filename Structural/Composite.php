<?php

/**
 * 模式名称: 组合模式 (Composite)
 * 模式类型: 结构型
 * 模式描述: 官方说法: 在软件工程中，复合模式是一种分区设计模式。复合模式描述了一组对象，这些对象的处理方式与同一类型对象的单个实例相同。组合的目的是将对象“组合”到树结构中，以表示部分整体层次结构。实现复合模式允许客户机统一地处理单个对象和组合
 * 解决的问题: 解决树状结构、并且单节点和整体模型属于同一类型，并且可以进行完全遍历
 * 优点:
 * 缺点:
 */

// 定义共同类型
interface HtmlElement
{
    public function render() : string;
}

// 定义Form，Form可以包含同类元素：文本、input框
class Form implements HtmlElement
{
    protected $elements = [];

    public function render() : string
    {
        $form = '<form>' . PHP_EOL;

        foreach ($this->elements as $element)
        {
            $form .= $element->render() . PHP_EOL;
        }

        $form .= '</form>' . PHP_EOL;

        return $form;
    }

    public function addElement(HtmlElement $element)
    {
        $this->elements[] = $element;
    }
}

// 文本
class Text implements HtmlElement
{
    protected $content = '';

    public function __construct($content)
    {
        $this->content = $content . PHP_EOL;
    }

    public function render() : string
    {
        return $this->content;
    }
}

// Input
class Input implements HtmlElement
{
    protected $inputName;

    public function __construct($inputName)
    {
        $this->inputName = $inputName;
    }

    public function render() : string
    {
        return '<input type="text" name="' . $this->inputName . '" />' . PHP_EOL;
    }
}

$form = new Form();
$form->addElement(new Text('username:'));
$form->addElement(new Input('username'));
$form->addElement(new Text('password:'));
$form->addElement(new Input('password'));

$nestedForm = new Form();
$nestedForm->addElement(new Input('submit'));

$form->addElement($nestedForm);
echo $form->render();
