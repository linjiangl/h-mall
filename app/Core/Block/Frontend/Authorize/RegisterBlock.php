<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Core\Block\Frontend\Authorize;

use App\Core\Block\BaseBlock;
use App\Core\Service\Authorize\UserAuthorizationService;

class RegisterBlock extends BaseBlock
{
    public function register(): array
    {
        $data = $this->request->post();
        $service = new UserAuthorizationService();

        return $service->register($data['username'], $data['password'], $data['password_confirmation']);
    }
}
