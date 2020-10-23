<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://store.yii.red
 * @document https://document.store.yii.red
 * @contact  8257796@qq.com
 */
namespace HyperfTest\Backend\Spec;

use App\Core\Dao\Spec\SpecDao;
use App\Model\Spec\Spec;
use HyperfTest\Backend\BackendHttpTestCase;
use HyperfTest\Backend\TraitBackendAuthorize;

class SpecTest extends BackendHttpTestCase
{
    use TraitBackendAuthorize;

    public function testBackendSpecCreate()
    {
        $data = [
            'shop_id' => '0',
            'name' => '颜色',
            'sorting' => '0',
        ];

        $this->url = '/spec';
        $this->data = $data;
        $result = $this->request($this->url, $this->data, 'post', $this->getHeaders());
        var_dump($result);
        // $this->handleHttpCreate();
    }

    public function testBackendSpecUpdate()
    {
        $dao = new SpecDao();
        /** @var Spec $info */
        $info = $dao->getInfoByCondition([['name', '=', '颜色']]);

        $data = [
            'shop_id' => '0',
            'name' => '颜色1',
        ];

        $this->url = '/spec/' . $info->id;
        $this->data = $data;
        $this->handleHttpUpdate();
    }

}
