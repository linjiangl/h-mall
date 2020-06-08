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
use App\Request\Frontend\Auth\LoginRequest;
use App\Service\Authorize\UserAuthorizationService;
use Throwable;

class LoginBlock
{
    public function index(LoginRequest $request)
    {
        $post = $request->validated();
        try {
            $service = new UserAuthorizationService();
            return $service->login($post['username'], $post['password']);
        } catch (Throwable $e) {
            throw new HttpException($e->getMessage(), $e->getCode());
        }
    }
}
