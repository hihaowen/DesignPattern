<?php

/**
 * 策略模式
 *
 * 按专业的话说就是可以将可以定义多个算法簇，并且各个算法之间互不影响，可以互相替换
 *
 * 我自己的理解就是遵循了开闭、单一职责的原则
 */

interface WorkInterface
{
    public function process();
}

class Work
{
    private $work;

    /**
     * Work constructor.
     *
     * @param WorkInterface $work
     */
    public function __construct(WorkInterface $work)
    {
        $this->work = $work;
    }

    /**
     * 执行业务
     */
    public function process()
    {
        $this->work->process();
    }
}

// 写代码
class ProgramWork implements WorkInterface
{

    public function process()
    {
        echo '为了升职加薪，我要编程了 ～', PHP_EOL;
    }

}

// Code Review
class CodeReviewWork implements WorkInterface
{

    public function process()
    {
        echo '为了提高代码质量，我要 Code Review ～', PHP_EOL;
    }

}

(new Work(new ProgramWork()))->process();

(new Work(new CodeReviewWork()))->process();
