<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://store.yii.red
 * @document https://document.store.yii.red
 * @contact  8257796@qq.com
 */
namespace HyperfTest\Backend\Admin;

use App\Core\Dao\Admin\AdminDao;
use HyperfTest\Backend\BackendHttpTestCase;
use HyperfTest\Backend\TraitBackendAuthorize;

class AdminTest extends BackendHttpTestCase
{
    use TraitBackendAuthorize;

    public function testBackendAdminIndex()
    {
        $this->url = '/admin/list';
        $this->handleHttpIndex();
    }

    public function testBackendAdminShow()
    {
        $this->url = '/admin/detail';
        $this->data = [
            'id' => 2
        ];
        $this->handleHttpShow();
    }

    public function testBackendAdminStore()
    {
        $this->url = '/admin/create';
        $this->data = [
            'username' => 'xiaomi',
            'password' => 'xiaomi',
            'password_confirmation' => 'xiaomi',
            'avatar' => 'https://up.enterdesk.com/edpic/31/c3/fd/31c3fdc63511cabedd6415d121fa2d58.jpg',
            'real_name' => '小米',
            'mobile' => '18600001111',
            'email' => 'xiaomi@qq.com',
        ];
        $this->handleHttpCreate();
    }

    public function testBackendAdminUpdate()
    {
        $adminDao = new AdminDao();
        $admin = $adminDao->getInfoByUsername('xiaomi');

        $this->url = '/admin/update';
        $this->data = [
            'id' => $admin->id,
            'avatar' => 'https://up.enterdesk.com/edpic/31/c3/fd/31c3fdc63511cabedd6415d121fa2d58.jpg',
            'real_name' => '小米22',
            'role_id' => 2
        ];
        $this->handleHttpUpdate();
    }
}
