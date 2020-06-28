<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://store.yii.red
 * @document https://document.store.yii.red
 * @contact  8257796@qq.com
 */
namespace App\Controller;

use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Contract\ResponseInterface;
use Hyperf\Utils\Context;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ServerRequestInterface;

abstract class AbstractController
{
    /**
     * @Inject
     * @var ContainerInterface
     */
    protected $container;

    /**
     * @Inject
     * @var RequestInterface
     */
    protected $request;

    /**
     * @Inject
     * @var ResponseInterface
     */
    protected $response;

    protected function created($id)
    {
        return response_json($id, '', 201);
    }

    protected function deleted()
    {
        return response_json(true, '', 204);
    }

    protected function setActionName(string $actionName)
    {
        $request = Context::get(ServerRequestInterface::class);
        $request = $request->withAttribute('action_name', $actionName);
        Context::set(ServerRequestInterface::class, $request);
    }
}
