<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://store.yii.red
 * @document https://document.store.yii.red
 * @contact  8257796@qq.com
 */
namespace App\Block\Frontend\Authorize;

use App\Exception\HttpException;
use App\Core\Service\Authorize\UserAuthorizationService;
use Throwable;

class LoginBlock
{
    public function index(array $data): array
    {
        try {
            $service = new UserAuthorizationService();
            return $service->login($data['username'], $data['password']);
        } catch (Throwable $e) {
            throw new HttpException($e->getMessage(), $e->getCode());
        }
    }
}
