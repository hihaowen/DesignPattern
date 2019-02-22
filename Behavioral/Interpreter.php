<?php

/**
 * 模式名称: 解释器模式 (Interpreter)
 * 模式类型: 行为型
 * 模式描述: 主要包含解释抽象接口 (AbstractExpression) ,该接口是终结符 (TerminalExpression, 比如加减乘除) 和非终结符 (NonterminalExpression, 比如数字) 的抽象，还有一个是 Context 包含所有解释器相关的信息，Client 为调用方
 * 解决的问题: 简单的文法解析
 * 优点: 可扩展、维护性高
 * 缺点: 暂无
 * 和它类似的模式: 暂无
 */

// 符号接口
interface Symbol
{
    public function getSymbol() : string;
}

// 解释器抽象接口
interface AbstractExpression
{
    public function interpret();
}

// 定义非终结符（值）
class IntNode implements AbstractExpression
{
    private $int;

    public function __construct($int)
    {
        $this->int = $int;
    }

    public function interpret()
    {
        return (int) $this->int;
    }
}

// 定义非终结符 (*)
class MulNode implements AbstractExpression, Symbol
{
    private $left;

    private $right;

    public function __construct(AbstractExpression $left, AbstractExpression $right)
    {
        $this->left = $left;

        $this->right = $right;
    }

    public function getSymbol() : string
    {
        return '*';
    }

    public function interpret()
    {
        return $this->left->interpret() * $this->right->interpret();
    }
}

// 定义非终结符 (/)
class DivNode implements AbstractExpression, Symbol
{
    private $left;

    private $right;

    public function __construct(AbstractExpression $left, AbstractExpression $right)
    {
        $this->left = $left;

        $this->right = $right;
    }

    public function getSymbol() : string
    {
        return '/';
    }

    public function interpret()
    {
        return $this->left->interpret() / $this->right->interpret();
    }
}

// 定义解释器上下文
class CalculatorContext
{
    public function cal($content)
    {
        $segments = explode(' ', $content);

        $segmentsCount = count($segments);

        $stacks = [];

        for ($i = 0; $i < $segmentsCount; $i ++) {
            $symbol = $segments[$i];

            if ($symbol == '*') {
                // 取出栈中的一个作为左侧节点值
                $leftNode = array_pop($stacks);

                $rightNode = new IntNode($segments[++ $i]);

                array_push($stacks, new MulNode($leftNode, $rightNode));
            } elseif ($symbol == '/') {
                // 取出栈中的一个作为左侧节点值
                $leftNode = array_pop($stacks);

                $rightNode = new IntNode($segments[++ $i]);

                array_push($stacks, new DivNode($leftNode, $rightNode));
            } else {
                array_push($stacks, new IntNode($symbol));
            }
        }

        return (array_pop($stacks))->interpret();
    }
}

var_dump((new CalculatorContext())->cal('10 * 20 / 5'));
