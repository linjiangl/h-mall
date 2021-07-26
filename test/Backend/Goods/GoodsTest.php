<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace HyperfTest\Backend\Goods;

use HyperfTest\Backend\BackendHttpTestCase;
use HyperfTest\Backend\TraitBackendAuthorize;

/**
 * @internal
 * @coversNothing
 */
class GoodsTest extends BackendHttpTestCase
{
    use TraitBackendAuthorize;

    public function testBackendGoodsIndex()
    {
        $this->url = '/goods/list';
        $this->handleHttpIndex();
    }

    public function testBackendGoodsCreate()
    {
        $this->debug = true;
        $this->url = '/goods/create';
        $this->data = [];
        $this->handleHttpCreate();
    }
}
