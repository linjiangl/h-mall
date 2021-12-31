<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Controller\Frontend\Authorize;

use App\Controller\FrontendController;
use App\Core\Block\BaseBlock;
use App\Core\Block\Frontend\Authorize\RegisterBlock;
use App\Request\Frontend\Authorize\RegisterRequest;
use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\RateLimit\Annotation\RateLimit;

/**
 * @Controller(prefix="rate-limit")
 * @RateLimit
 */
class RegisterController extends FrontendController
{
    public function register(RegisterRequest $request): array
    {
        $request->validated();
        return $this->getBlock()->register();
    }

    protected function setBlock(): RegisterBlock
    {
        return new RegisterBlock();
    }

    /**
     * @return RegisterBlock
     */
    protected function getBlock(): BaseBlock
    {
        return parent::getBlock();
    }
}
