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
use App\Exception\HttpException;
use Throwable;

class LoginBlock extends BaseBlock
{
    public function login(): array
    {
        try {
            $data = $this->request->post();
            $service = new UserAuthorizationService();
            return $service->login($data['username'], $data['password']);
        } catch (Throwable $e) {
            throw new HttpException($e->getMessage(), $e->getCode());
        }
    }
}
