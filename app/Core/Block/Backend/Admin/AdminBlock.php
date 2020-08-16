<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://store.yii.red
 * @document https://document.store.yii.red
 * @contact  8257796@qq.com
 */
namespace App\Core\Block\Backend\Admin;

use App\Core\Block\Backend\BackendBlock;
use App\Exception\HttpException;
use App\Core\Service\Admin\AdminService;
use Throwable;

class AdminBlock extends BackendBlock
{
    protected $service = AdminService::class;

    public function store(array $post)
    {
        try {
            $service = new AdminService();
            return $service->createAccount($post['username'], $post['password'], $post);
        } catch (Throwable $e) {
            throw new HttpException($e->getMessage(), $e->getCode());
        }
    }

    public function update(array $post, int $id)
    {
        try {
            $service = new AdminService();
            return $service->updateAccount($id, $post);
        } catch (Throwable $e) {
            throw new HttpException($e->getMessage(), $e->getCode());
        }
    }
}
