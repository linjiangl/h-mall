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
        $this->url = '/admin';
        $this->handleHttpIndex();
    }

    public function testBackendAdminShow()
    {
        $this->url = '/admin/2';
        $this->handleHttpShow();
    }

    public function testBackendAdminStore()
    {
        $data = [
            'username' => 'xiaomi',
            'password' => 'xiaomi',
            'password_confirmation' => 'xiaomi',
            'avatar' => 'https://up.enterdesk.com/edpic/31/c3/fd/31c3fdc63511cabedd6415d121fa2d58.jpg',
            'real_name' => '小米',
            'mobile' => '18600001111',
            'email' => 'xiaomi@qq.com',
        ];
        $this->url = '/admin';
        $this->data = $data;
        $this->handleHttpCreate();
    }

    public function testBackendAdminUpdate()
    {
        $adminDao = new AdminDao();
        $admin = $adminDao->getInfoByUsername('xiaomi');
        $data = [
            'avatar' => 'https://up.enterdesk.com/edpic/31/c3/fd/31c3fdc63511cabedd6415d121fa2d58.jpg',
            'real_name' => '小米22',
            'role_id' => 2
        ];
        $this->url = '/admin/' . $admin->id;
        $this->data = $data;
        $this->handleHttpUpdate();
    }
}
