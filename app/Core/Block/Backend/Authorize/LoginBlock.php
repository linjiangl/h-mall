<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Core\Block\Backend\Authorize;

use App\Core\Block\BaseBlock;
use App\Core\Service\Authorize\AdminAuthorizationService;

class LoginBlock extends BaseBlock
{
    public function login(): array
    {
        $data = $this->request->post();
        $service = new AdminAuthorizationService();

        return $service->login($data['username'], $data['password']);
    }
}
