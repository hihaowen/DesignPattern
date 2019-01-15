<?php

/**
 * 模式名称: 适配器模式 (Adapter)
 * 模式类型: 结构型
 * 模式描述: 对于不同的类遵循遵循不同的规范，这时候适配器就是基于两个不同规范的类之外的第三个类
 * 解决的问题: 不同规范的类下的折中处理
 * 优点: 没啥优点
 * 缺点: 多了第三个冗余类
 * 和它类似的模式: 暂无
 */

// 消息发送类
interface MessageSenderInterface
{
    /**
     * @param int $userId
     * @param string $content
     * @return void
     */
    public function send(int $userId, string $content);
}

// 发送短信消息
class SmsSender implements MessageSenderInterface
{

    public function send(int $userId, string $content)
    {
        echo '给用户: ' . $userId . ' 发送了短信: ' . $content;
    }

}

// 发送邮件消息 (历史遗留)
interface EmailSenderInterface
{
    public function setContent($content);

    public function sendEmail($email);
}

class EmailSender implements EmailSenderInterface
{
    private $content = '';

    public function setContent($content)
    {
        $this->content = $content;
    }

    public function sendEmail($email)
    {
        echo '给用户: ' . $email . ' 发送了邮箱: ' . $this->content;
    }

}

// 发送邮件消息适配类
class EmailSenderAdapter implements MessageSenderInterface
{
    private $emailSender;

    public function __construct(EmailSenderInterface $emailSender)
    {
        $this->emailSender = $emailSender;
    }

    public function send(int $userId, string $content)
    {
        $email = $this->getEmailByUserId($userId);

        $this->emailSender->setContent($content);

        return $this->emailSender->sendEmail($email);
    }

    /**
     * 根据用户ID获取邮箱
     *
     * @param int $userId
     * @return string
     */
    private function getEmailByUserId(int $userId)
    {
        return 'test@gmail.com';
    }
}
