<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Controller;

use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpMessage\Stream\SwooleStream;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Contract\ResponseInterface;
use Hyperf\Utils\Context;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ServerRequestInterface;

abstract class AbstractController
{
    /**
     * @Inject
     */
    protected ContainerInterface $container;

    /**
     * @Inject
     */
    protected RequestInterface $request;

    /**
     * @Inject
     */
    protected ResponseInterface $response;

    protected function returnResponseCreate($id): \Psr\Http\Message\ResponseInterface
    {
        return response_json($id, '', 201);
    }

    protected function returnResponseDelete(): \Psr\Http\Message\ResponseInterface
    {
        return response_json(true, '', 204);
    }

    protected function returnResponseSourceData(array $response): \Psr\Http\Message\ResponseInterface
    {
        return response()->withAddedHeader('Content-Type', 'application/json')->withStatus(200)->withBody(new SwooleStream(json_encode($response, JSON_UNESCAPED_UNICODE)));
    }

    /**
     * 设置方法的执行名称.
     */
    protected function setActionName(string $actionName, mixed $response = null)
    {
        $request = Context::get(ServerRequestInterface::class);
        $request = $request->withAttribute('action_name', $actionName);
        Context::set(ServerRequestInterface::class, $request);

        return $response;
    }
}
