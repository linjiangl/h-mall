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

use App\Core\Service\Authorize\AdminAuthorizationService;
use App\Exception\HttpException;
use Throwable;

class LoginBlock
{
    public function index(array $data): array
    {
        try {
            $service = new AdminAuthorizationService();
            return $service->login($data['username'], $data['password']);
        } catch (Throwable $e) {
            throw new HttpException($e->getMessage(), $e->getCode());
        }
    }
}
