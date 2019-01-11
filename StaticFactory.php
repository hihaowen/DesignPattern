<?php

/**
 * 模式名称: 静态工厂 (StaticFactory)
 * 模式类型: 创建型
 * 模式描述: 静态工厂充当了门面的作用，它将功能聚集起来，并且抽象化了对象的功能职责，通过一个静态方法、通过参数进行区分
 * 解决的问题: 将功能聚集，方便调用
 * 优点: 功能聚集，类似门面
 * 缺点: 后续功能的变化会对静态方法进行变更、破坏了开闭原则
 */

interface ThirdPartPayGateway
{
    // 下单
    public function order(string $outOrderNo);
}

// wechat
class WechatPayGateway implements ThirdPartPayGateway
{

    public function order(string $outOrderNo)
    {
        // TODO: Implement order() method.
    }

}

// alipay
class AlipayPayGateway implements ThirdPartPayGateway
{

    public function order(string $outOrderNo)
    {
        // TODO: Implement order() method.
    }

}

class PayGatewayFactory
{
    /**
     * 创建支付网关
     *
     * @param $gateway
     * @return ThirdPartPayGateway
     */
    public static function createGateway($gateway) : ThirdPartPayGateway
    {
        switch ($gateway)
        {
            case 'alipay' :
                $gateway = new AlipayPayGateway();
                break;
            case 'wechat' :
                $gateway = new AlipayPayGateway();
                break;
            default :
                throw new \InvalidArgumentException('不支持的第三方支付网关: ' . $gateway, -1);
                break;
        }

        return $gateway;
    }
}
