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

use App\Core\Dao\Goods\Spec\SpecDao;
use App\Model\Spec\Spec;
use HyperfTest\Backend\BackendHttpTestCase;
use HyperfTest\Backend\TraitBackendAuthorize;

/**
 * @internal
 * @coversNothing
 */
class SpecTest extends BackendHttpTestCase
{
    use TraitBackendAuthorize;

    public function testBackendSpecCreate()
    {
        $this->debug = true;
        $this->url = '/spec/create';
        $this->data = [
            'shop_id' => '0',
            'name' => '颜色',
            'sorting' => '0',
        ];
        $this->handleHttpCreate();
    }

    public function testBackendSpecUpdate()
    {
        $dao = new SpecDao();
        /** @var Spec $info */
        $info = $dao->getInfoByCondition([['name', '=', '颜色']]);

        $this->url = '/spec/update';
        $this->data = [
            'id' => $info->id,
            'shop_id' => '0',
            'name' => '颜色1',
        ];
        $this->handleHttpUpdate();
    }
}
