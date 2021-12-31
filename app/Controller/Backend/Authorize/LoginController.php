<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Controller\Backend\Authorize;

use App\Controller\BackendController;
use App\Core\Block\Backend\Authorize\LoginBlock;
use App\Core\Block\BaseBlock;
use App\Request\Backend\Authorize\LoginRequest;
use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\RateLimit\Annotation\RateLimit;

/**
 * @Controller(prefix="rate-limit")
 * @RateLimit
 */
class LoginController extends BackendController
{
    public function login(LoginRequest $request): array
    {
        $request->validated();
        return $this->getBlock()->login();
    }

    protected function setBlock(): LoginBlock
    {
        return new LoginBlock();
    }

    /**
     * @return LoginBlock
     */
    protected function getBlock(): BaseBlock
    {
        return parent::getBlock();
    }
}
