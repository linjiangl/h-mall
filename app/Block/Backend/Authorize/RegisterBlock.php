<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://store.yii.red
 * @document https://document.store.yii.red
 * @contact  8257796@qq.com
 */
namespace App\Block\Backend\Authorize;

use App\Exception\HttpException;
use App\Service\Authorize\AdminAuthorizationService;
use Throwable;

class RegisterBlock
{
    public function index(array $data): array
    {
        try {
            $service = new AdminAuthorizationService();
            return $service->register($data['username'], $data['password'], $data['password_confirmation']);
        } catch (Throwable $e) {
            throw new HttpException($e->getMessage(), $e->getCode());
        }
    }
}
