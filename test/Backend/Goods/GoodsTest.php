<?php


namespace HyperfTest\Backend\Goods;


use HyperfTest\Backend\BackendHttpTestCase;
use HyperfTest\Backend\TraitBackendAuthorize;

class GoodsTest extends BackendHttpTestCase
{
    use TraitBackendAuthorize;

    public function testBackendGoodsCreate()
    {
        $this->debug = true;
        $this->url = '/goods/create';
        $this->data = [];
        $this->handleHttpCreate();
    }
}
