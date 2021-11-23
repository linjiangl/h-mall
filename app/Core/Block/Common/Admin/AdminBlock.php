<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Core\Block\Common\Admin;

use App\Core\Block\BaseBlock;
use App\Core\Service\Admin\AdminService;
use App\Model\Admin\Admin;

class AdminBlock extends BaseBlock
{
    protected string $service = AdminService::class;

    protected array $query = [
        '=' => ['username', 'real_name', 'mobile', 'email', 'status'],
    ];

    public function create(): Admin
    {
        $post = $this->request->post();
        $service = new AdminService();

        return $service->createAccount($post['username'], $post['password'], $post);
    }

    public function update(): Admin
    {
        $service = new AdminService();

        return $service->updateAccount($this->getPrimaryKey(), $this->request->post());
    }
}
