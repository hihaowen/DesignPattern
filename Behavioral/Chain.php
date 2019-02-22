<?php

/**
 * 责任链模式
 *
 * 这个模式我之前没有用过，看了下介绍，这种很适合类似过滤系统的场景，模型图看起来也比较简单，主要是由一个接口或抽象类来定义设置过滤的类，
 * 还有一个next方法，并通过构造函数的方式注入新的过滤规则类
 *
 * 以下是一个内容过滤系统的例子
 *
 */

interface Content
{
    public function setContent($content);

    public function getContent();
}

// 内容
class PostContent implements Content
{
    private $content;

    public function setContent($content)
    {
        $this->content = $content;
    }

    public function getContent()
    {
        return $this->content;
    }
}

// 定义一个过滤器抽象类
abstract class ContentFilter
{
    protected $filter;

    /**
     * 设置Filter
     *
     * @param ContentFilter $filter
     * @return $this
     */
    public function setFilter(ContentFilter $filter)
    {
        $this->filter = $filter;

        return $this;
    }

    /**
     * 真正处理阶段
     *
     * @param Content $content
     * @return mixed
     */
    public abstract function process(Content $content);

    /**
     * 切换到下一个Filter
     *
     * @param Content $content
     */
    protected function next(Content $content)
    {
        if (! is_null($this->filter)) {
            $this->filter->process($content);
        }
    }

}

// 过滤涉黄文字
class YellowFilter extends ContentFilter
{

    public function process(Content $content)
    {
        $content->setContent(
            str_replace('Sex', '***', $content->getContent())
        );

        $this->next($content);
    }

}

// 过滤政治文字
class ZhengzhiFilter extends ContentFilter
{

    public function process(Content $content)
    {
        $content->setContent(
            str_replace('政治', '***', $content->getContent())
        );

        $this->next($content);
    }

}

// 过滤禁用文字
class ForbiddenFilter extends ContentFilter
{

    public function process(Content $content)
    {
        $content->setContent(
            str_replace('forbidden_words', '***', $content->getContent())
        );

        $this->next($content);
    }

}

$content = new PostContent();
$content->setContent('我说的内容是有关于政治的有：政治，涉黄的有：Sex，禁用的有： forbidden_words，其他的随便说啦 ～');

echo '原文是：', $content->getContent(), PHP_EOL;

$yellowFilter = new YellowFilter();
$zhengzhiFilter = new ZhengzhiFilter();
$forbiddenFilter = new ForbiddenFilter();

$yellowFilter->setFilter($zhengzhiFilter);
$forbiddenFilter->setFilter($yellowFilter);
$forbiddenFilter->process($content);

echo '过滤后：', $content->getContent(), PHP_EOL;
