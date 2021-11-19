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
            'sku_id' => 1,
            'quantity' => 1,
        ];
        $this->handleHttpCreate();
    }
}
