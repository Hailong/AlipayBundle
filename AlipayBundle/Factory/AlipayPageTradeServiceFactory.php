<?php

namespace Orinoco\AlipayBundle\Factory;

class AlipayPageTradeServiceFactory
{
    public static function createAlipayTradeService($arguments)
    {
        $alipay_config = [
            'gatewayUrl'           => $arguments['gateway_url'],
            'app_id'               => $arguments['app_id'],
            'merchant_private_key' => $arguments['rsa_private_key'],
            'alipay_public_key'    => $arguments['rsa_public_key'],
            'charset'              => $arguments['charset'],
            'sign_type'            => $arguments['sign_type'],
        ];

        if ($arguments['class_name'] == 'AlipayTradeService') {
            require dirname(__FILE__).'/../../AlipaySDK/alipay.trade.page.pay-PHP-UTF-8/pagepay/service/AlipayTradeService.php';
        }

        return new $arguments['class_name']($alipay_config);
    }
}
