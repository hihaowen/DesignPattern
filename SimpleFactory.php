<?php

/**
 * 模式名称: 简单工厂 (SimpleFactory)
 * 模式类型: 创建型
 * 模式描述: 将属于同一功能的对象进行静态方法的封装，通过统一方法和参数的形式进行调用
 * 解决的问题: 将同一功能多种方式实现的对象进行统一调用，统一管理
 * 优点: 充当门面的作用，让资源统一
 * 缺点: 违反了开闭原则
 * 和它类似的模式: 门面 (facade)，门面是结构型的模式，它解决的是隐藏的内部实现细节，让调用方使用起来更简洁，它关注的是结果，而简单工厂是创建型的模式，它关注的是对象的创建，结果仍需要继续进一步执行
 */

// zhizhen 短信平台发送
class ZhizhenSmsSender
{
    public function send($mobile, $content)
    {

    }
}

// lanxun 短信平台发送
class LanxunSmsSender
{
    public function send($mobile, $content)
    {

    }
}

class SimpleFactory
{

    /**
     * 根据平台进行短信发送
     *
     * @param $platform
     * @return LanxunSmsSender|ZhizhenSmsSender
     * @throws Exception
     */
    public static function send($platform)
    {
        switch ($platform) {
            case 'zhizhen' :
                $sender = new ZhizhenSmsSender();
                break;
            case 'lanxun' :
                $sender = new LanxunSmsSender();
                break;
            default :
                throw new \Exception('不支持的短信平台', -1);
                break;
        }

        return $sender;
    }
}

SimpleFactory::send('zhizhen')->send('12345', '67890');
