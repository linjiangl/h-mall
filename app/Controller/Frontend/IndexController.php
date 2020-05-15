<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://www.doubi.site
 * @document https://doc.doubi.site
 * @contact  8257796@qq.com
 */

namespace App\Controller\Frontend;

use App\Controller\AbstractController;
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
    /**
     * @Inject
     * @var IdGenerator\SnowflakeIdGenerator
     */
    protected $idGenerator;

    public function index()
    {
        $user = $this->request->input('user', 'Hyperf');
        $method = $this->request->getMethod();

        return [
            'method' => $method,
            'message' => "Hello {$user}.",
            'id' => $this->idGenerator->generate(),
            'now' => Carbon::now()->toDateTimeString(),
        ];
    }

    public function test()
    {
        return $this->request->getAttribute('user_id');
    }

    public function show(RequestInterface $request, $id)
    {
        return $id;
    }
}
