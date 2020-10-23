<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://store.yii.red
 * @document https://document.store.yii.red
 * @contact  8257796@qq.com
 */
namespace App\Core\Block\Backend\Authorize;

use App\Core\Block\RestBlock;
use App\Core\Service\Authorize\AdminAuthorizationService;
use App\Exception\HttpException;
use Hyperf\HttpServer\Contract\RequestInterface;
use Throwable;

class RegisterBlock extends RestBlock
{
    public function register(RequestInterface $request): array
    {
        try {
            $data = $request->post();
            $service = new AdminAuthorizationService();
            return $service->register($data['username'], $data['password'], $data['password_confirmation']);
        } catch (Throwable $e) {
            throw new HttpException($e->getMessage(), $e->getCode());
        }
    }
}
