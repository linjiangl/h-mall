<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://store.yii.red
 * @document https://document.store.yii.red
 * @contact  8257796@qq.com
 */
namespace HyperfTest\Backend\User;

use HyperfTest\Backend\BackendHttpTestCase;
use HyperfTest\Backend\TraitBackendAuthorize;

class UserTest extends BackendHttpTestCase
{
    use TraitBackendAuthorize;

    public function testBackendUserIndex()
    {
        $this->url = '/user/list';
        $this->handleHttpIndex();
    }

    public function testBackendUserShow()
    {
        $this->url = '/user/detail';
        $this->data = [
            'id' => 1
        ];
        $this->handleHttpShow();
    }
}
