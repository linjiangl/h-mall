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

use App\Core\Block\BaseBlock;
use App\Core\Service\Authorize\UserAuthorizationService;
use App\Exception\HttpException;
use Throwable;

class AuthorizeBlock extends BaseBlock
{
    public function show(): array
    {
        try {
            $service = new UserAuthorizationService();
            return $service->authorize();
        } catch (Throwable $e) {
            throw new HttpException($e->getMessage(), $e->getCode());
        }
    }
}
