<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://www.doubi.site
 * @document https://doc.doubi.site
 * @contact  8257796@qq.com
 */
namespace App\Controller\Mobile\v1;

use App\Block\Frontend\IndexBlock;
use App\Controller\AbstractController;
use App\Request\UserRequest;
use Carbon\Carbon;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\RateLimit\Annotation\RateLimit;
use Hyperf\Snowflake\IdGenerator;

/**
 * @Controller(prefix="rate-limit")
 * @RateLimit
 */
class IndexController extends AbstractController
{
    public function index(UserRequest $request)
    {
        return 'v1版接口';
    }

}
