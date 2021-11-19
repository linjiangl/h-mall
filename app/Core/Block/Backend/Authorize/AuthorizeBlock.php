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
use App\Exception\HttpException;
use Throwable;

class AuthorizeBlock extends BaseBlock
{
    public function info(): array
    {
        try {
            $service = new AdminAuthorizationService();
            return $service->authorize();
        } catch (Throwable $e) {
            throw new HttpException($e->getMessage(), $e->getCode());
        }
    }
}
