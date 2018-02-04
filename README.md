# AlipayBundle
Symfony bundle wrapper for Alipay SDK and demo library.

把阿里支付 SDK 和 demo 库包装为 Symfony Bundle.

### Parts of this bundle / 这个 bundle 的组成

1. The `AlipayBundle` folder / `AlipayBundle` 目录

    This is the Symfony bundle code to define the configs required by this bundle and to instantiate the service instances to use Alipay SDK.

    这里是 Symfony bundle 的代码，定义了所需的配置信息以及构建用于调用 Alipay SDK 的服务对象的代码。

1. The `AlipaySDK` folder / `AlipaySDK` 目录

    Here is the SDK and demo code downloaded from Alipay developer website.

    这里是从阿里支付开发人员站点下载的 SDK 代码以及官方的 demo 代码。

    Download path of the libraries / 代码的下载路径如下：

    > 服务端SDK
    > `alipay-sdk-PHP-20180104135052`
    > https://docs.open.alipay.com/54/103419
    >
    > 电脑网站支付demo
    > `alipay.trade.page.pay-PHP-UTF-8`
    > https://docs.open.alipay.com/270/106291/
    >
    > 手机网站支付DEMO
    > `alipay.trade.wap.pay-PHP-UTF-8`
    > https://docs.open.alipay.com/54/106682/

### Why use the demo library / 为什么引用 demo 库
This underlying service instance that instantiated by the bundle is `AlipayTradeService.php` provided by the demo library by default. While you could define your own service to replace the default and give the class name through config.

默认情况下这个 bundle 底层实例化的类是 demo 库提供的 `AlipayTradeService.php`。然而你可以提供自己的类，然后在配置里面指定即可。

### Usage / 用法
Once the bundle been successfully loaded into your Symfony application, the following service instances would be ready to use:

在 Bundle 成功加载到你的 Symfony 应用程序之后，以下的2个服务对象就可以使用了：

  - orinoco_alipay.trade_service.page
  - orinoco_alipay.trade_service.wap

For example:

例如：
```php
// in controller class
// 在 controller 类中使用
$this->get('orinoco_alipay.trade_service.page')
```
```xml
<!-- inject it into other services -->
<!-- 注入到需要使用的服务类中 -->
<service id="..." class="..." public="true">
    <argument>...</argument>
    <argument type="service" id="orinoco_alipay.trade_service.page" />
    <tag name="..." />
</service>
```
### Config / 配置
```yml
# app/config/config.yml
orinoco_alipay:
    page_trade:
        class_name: AlipayTradeService
        gateway_url: '%alipay_gatewayUrl%'
        app_id: '%alipay_app_id%'
        rsa_private_key: '%alipay_rsa_private_key%'
        rsa_public_key: '%alipay_rsa_private_key%'
        charset: '%alipay_charset%'
        sign_type: '%alipay_sign_type%'
    wap_trade:
        class_name: AlipayTradeService
        gateway_url: '%alipay_gatewayUrl%'
        app_id: '%alipay_app_id%'
        rsa_private_key: '%alipay_rsa_private_key%'
        rsa_public_key: '%alipay_rsa_private_key%'
        charset: '%alipay_charset%'
        sign_type: '%alipay_sign_type%'
```
