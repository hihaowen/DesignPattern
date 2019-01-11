<?php

/**
 * 中介模式
 *
 * 从字面意思来理解，中介就是中间的媒介，起到一个中间沟通的过程，主要是解决了对象之间的相互依赖的问题，并不是完全的没有依赖，而是将依赖转移到了中介类上，由中介来协调，调度功能的实现，比如A、B两个类，都由C中介类来分配，A、B只需要关心自己能做什么，并且自己的修改只需要通知到中介C就可以了，C根据A、B能做的事情来进行调度，缺点也很明显，违背类开闭原则
 *
 * 参考 https://en.wikipedia.org/wiki/Mediator_pattern
 */

interface MediatorInterface
{
    // 商户下单
    public function merchantOrder();

    // 商户退款
    public function merchantRefund();

    // 网关下单
    public function gatewayOrder();

    // 网关退款
    public function gatewayRefund();
}

class OrderMediator implements MediatorInterface
{
    // 商家服务
    protected $merchantService;

    // 支付网关
    protected $payGateway;

    public function __construct(MerchantService $merchantService, PayGateway $payGateway)
    {
        $this->merchantService = $merchantService;

        $this->payGateway = $payGateway;
    }

    public function merchantOrder()
    {
        $this->merchantService->order();
    }

    public function merchantRefund()
    {
        $this->merchantService->updateStatus('退款');

        $this->merchantService->log('用户已退款');
    }

    public function gatewayOrder()
    {
        $this->payGateway->order();
    }

    public function gatewayRefund()
    {
        $this->payGateway->refund();
    }

}

abstract class Colleague
{
    protected $mediator;

    public function __construct(MediatorInterface $mediator)
    {
        $this->mediator = $mediator;
    }
}

class MerchantService extends Colleague
{
    // 下单
    public function order()
    {
        $this->mediator->merchantOrder();

        $this->mediator->gatewayOrder();
    }

    // 变更订单状态
    public function updateStatus($status)
    {

    }

    // 记录
    public function log($message)
    {

    }
}

class PayGateway extends Colleague
{
    // 下单
    public function order()
    {

    }

    // 退款
    public function refund()
    {
        $this->mediator->gatewayRefund();

        $this->mediator->merchantRefund();
    }
}


$orderMediator = new OrderMediator();

