<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://www.doubi.site
 * @document https://doc.doubi.site
 * @contact  8257796@qq.com
 */
namespace App\Block\Backend\Auth;

use App\Exception\HttpException;
use App\Request\Backend\Auth\RegisterRequest;
use App\Service\Auth\AdminAuthorizationService;

class RegisterBlock extends AbstractAuthBlock
{
    public function index(RegisterRequest $request)
    {
        $post = $request->validated();
        try {
            $service = new AdminAuthorizationService($this->jwt);
            return $service->register($post['username'], $post['password'], $post['confirm_password'], $post);
        } catch (\Throwable $e) {
            throw new HttpException($e->getMessage(), $e->getCode());
        }
    }
}
