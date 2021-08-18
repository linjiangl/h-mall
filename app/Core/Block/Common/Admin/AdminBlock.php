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
use App\Exception\HttpException;
use App\Model\Admin\Admin;
use Throwable;

class AdminBlock extends BaseBlock
{
    protected string $service = AdminService::class;

    protected array $query = [
        '=' => ['username', 'real_name', 'mobile', 'email', 'status'],
    ];

    public function store(): Admin
    {
        try {
            $post = $this->request->post();
            $service = new AdminService();
            return $service->createAccount($post['username'], $post['password'], $post);
        } catch (Throwable $e) {
            throw new HttpException($e->getMessage(), $e->getCode());
        }
    }

    public function update(): Admin
    {
        try {
            $service = new AdminService();
            return $service->updateAccount($this->getPrimaryKey(), $this->request->post());
        } catch (Throwable $e) {
            throw new HttpException($e->getMessage(), $e->getCode());
        }
    }
}
