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

use App\Core\Block\BaseBlock;
use App\Core\Service\Authorize\AdminAuthorizationService;
use App\Exception\HttpException;
use Throwable;

class RegisterBlock extends BaseBlock
{
    public function register(): array
    {
        try {
            $data = $this->request->post();
            $service = new AdminAuthorizationService();
            return $service->register($data['username'], $data['password'], $data['password_confirmation']);
        } catch (Throwable $e) {
            throw new HttpException($e->getMessage(), $e->getCode());
        }
    }
}
