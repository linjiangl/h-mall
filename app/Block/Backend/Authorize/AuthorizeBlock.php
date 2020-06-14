<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://www.doubi.site
 * @document https://doc.doubi.site
 * @contact  8257796@qq.com
 */
namespace App\Block\Backend\Authorize;

use App\Exception\HttpException;
use App\Service\Authorize\AdminAuthorizationService;
use Hyperf\HttpServer\Contract\RequestInterface;
use Throwable;

class AuthorizeBlock
{
    public function index(RequestInterface $request)
    {
        try {
            $service = new AdminAuthorizationService();
            return $service->authorize();
        } catch (Throwable $e) {
            throw new HttpException($e->getMessage(), $e->getCode());
        }
    }
}