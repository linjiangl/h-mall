<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://store.yii.red
 * @document https://document.store.yii.red
 * @contact  8257796@qq.com
 */
namespace App\Core\Block\Common\Admin;

use App\Core\Block\BaseBlock;
use App\Core\Service\Admin\AdminService;
use App\Exception\HttpException;
use Hyperf\HttpServer\Contract\RequestInterface;
use Throwable;

class AdminBlock extends BaseBlock
{
    protected $service = AdminService::class;

    public function store(RequestInterface $request)
    {
        try {
            $post = $request->post();
            $service = new AdminService();
            return $service->createAccount($post['username'], $post['password'], $post);
        } catch (Throwable $e) {
            throw new HttpException($e->getMessage(), $e->getCode());
        }
    }

    public function update(RequestInterface $request)
    {
        try {
            $service = new AdminService();
            return $service->updateAccount($this->getPrimaryKey(), $request->post());
        } catch (Throwable $e) {
            throw new HttpException($e->getMessage(), $e->getCode());
        }
    }
}
