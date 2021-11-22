<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace HyperfTest\Frontend\Order;

use HyperfTest\Frontend\FrontendHttpTestCase;
use HyperfTest\Frontend\TraitFrontendAuthorize;

/**
 * @internal
 * @coversNothing
 */
class CartTest extends FrontendHttpTestCase
{
    use TraitFrontendAuthorize;

    public function testFrontendCartCreate()
    {
        $this->url = '/cart/create';
        $this->data = [
            'sku_id' => 2,
            'quantity' => 1,
        ];
        $this->handleHttpCreate();
    }

    public function testFrontendCartUpdate()
    {
        $this->url = '/cart/update';
        $this->data = [
            'id' => 5,
            'quantity' => 1,
        ];
        $this->handleHttpUpdate();
    }

    public function testFrontendCartDelete()
    {
        $this->url = '/cart/delete';
        $this->data = [
            'id' => 6,
        ];
        $this->handleHttpDelete();
    }

    public function testFrontendCartClear()
    {
        $this->url = '/cart/clear';
        $result = $this->getHttpResponse();

        $this->assertTrue($result);
    }

    public function testFrontendCartMy()
    {
        $this->url = '/cart/my';
        $result = $this->getHttpResponse();

        $this->assertIsArray($result);
    }

    public function testFrontendCartCount()
    {
        $this->url = '/cart/count';
        $result = $this->getHttpResponse();

        $this->assertIsNumeric($result);
    }
}
