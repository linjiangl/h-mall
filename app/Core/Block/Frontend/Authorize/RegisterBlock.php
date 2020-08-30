<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://store.yii.red
 * @document https://document.store.yii.red
 * @contact  8257796@qq.com
 */
namespace App\Core\Block\Frontend\Authorize;

use App\Core\Service\Authorize\UserAuthorizationService;
use App\Exception\HttpException;
use Throwable;

class RegisterBlock
{
    public function index(array $data): array
    {
        try {
            $service = new UserAuthorizationService();
            return $service->register($data['username'], $data['password'], $data['password_confirmation']);
        } catch (Throwable $e) {
            throw new HttpException($e->getMessage(), $e->getCode());
        }
    }
}
