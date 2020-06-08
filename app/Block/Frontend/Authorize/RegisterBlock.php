<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://www.doubi.site
 * @document https://doc.doubi.site
 * @contact  8257796@qq.com
 */
namespace App\Block\Frontend\Authorize;

use App\Exception\HttpException;
use App\Request\Frontend\Authorize\RegisterRequest;
use App\Service\Authorize\UserAuthorizationService;
use Throwable;

class RegisterBlock
{
    public function index(RegisterRequest $request)
    {
        $post = $request->validated();
        try {
            $service = new UserAuthorizationService();
            return $service->register($post['username'], $post['password'], $post['confirm_password']);
        } catch (Throwable $e) {
            throw new HttpException($e->getMessage(), $e->getCode());
        }
    }
}
