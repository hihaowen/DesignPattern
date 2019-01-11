<?php

/**
 * 模式名称: 工厂方法 (FactoryMethod)
 * 模式类型: 创建型
 * 模式描述: 主要是依赖抽象 (工厂类、功能实现类) 来生产出符合标准的对象
 * 解决的问题: 将实现类的实现及调用标准化、大大提高可扩展性
 * 优点: 完全符合开闭原则
 * 缺点: 功能职责分的会比较细、类会比较多
 * 和它类似的模式: 暂无
 */

// 还是以短信发送的栗子来实现、之不过不是区分平台的栗子、而是区分类型 (文本、语音) 的栗子了

// 短信发送接口
interface SmsSenderInterface
{
    public function send(int $mobile, $content);
}

// 文本形式短信发送
class TextSmsSender implements SmsSenderInterface
{

    public function send(int $mobile, $content)
    {
        // ...
    }

}

// 语音形式短信发送
class VoiceSmsSender implements SmsSenderInterface
{

    public function send(int $mobile, $content)
    {
        // ...
    }

}

// 短信发送工厂接口
interface SmsSenderFactoryInterface
{
    public function createSender() : SmsSenderInterface;
}

// 文案形式的短信工厂
class TextSmsSenderFactory implements SmsSenderFactoryInterface
{

    public function createSender() : SmsSenderInterface
    {
        return new TextSmsSender();
    }

}

// 语音形式的短信工厂
class VoiceSmsSenderFactory implements SmsSenderFactoryInterface
{

    public function createSender() : SmsSenderInterface
    {
        return new VoiceSmsSender();
    }

}
