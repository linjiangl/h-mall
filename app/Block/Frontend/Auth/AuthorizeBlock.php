<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://www.doubi.site
 * @document https://doc.doubi.site
 * @contact  8257796@qq.com
 */
namespace App\Block\Frontend\Auth;

use App\Exception\HttpException;
use App\Service\Auth\AuthService;
use Hyperf\HttpServer\Contract\RequestInterface;

class AuthorizeBlock extends AbstractAuthBlock
{
    public function index(RequestInterface $request)
    {
        try {
            $service = new AuthService($this->jwt);
            return $service->user();
        } catch (\Throwable $e) {
            throw new HttpException($e->getMessage(), $e->getCode());
        }
    }
}
