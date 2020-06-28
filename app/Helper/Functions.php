<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://store.yii.red
 * @document https://document.store.yii.red
 * @contact  8257796@qq.com
 */

use Hyperf\Contract\StdoutLoggerInterface;
use Hyperf\Framework\Logger\StdoutLogger;
use Hyperf\HttpMessage\Stream\SwooleStream;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Contract\ResponseInterface;
use Hyperf\Logger\LoggerFactory;
use Hyperf\Utils\ApplicationContext;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Log\LoggerInterface;
use Swoole\WebSocket\Server as WebSocketServer;
use Psr\SimpleCache\CacheInterface;
use Hyperf\Redis\Redis;

/*
 * 容器实例
 */
if (! function_exists('container')) {
    function container(): ContainerInterface
    {
        return ApplicationContext::getContainer();
    }
}

/*
 * redis 客户端实例
 */
if (! function_exists('redis')) {
    function redis(): Redis
    {
        return container()->get(Redis::class);
    }
}

/*
 * websocket 实例
 */
if (! function_exists('websocket')) {
    function websocket(): WebSocketServer
    {
        return container()->get(WebSocketServer::class);
    }
}

/*
 * 缓存实例 简单的缓存
 */
if (! function_exists('cache')) {
    function cache(): CacheInterface
    {
        return container()->get(CacheInterface::class);
    }
}

/*
 * 控制台日志
 */
if (! function_exists('stdLog')) {
    function stdLog(): StdoutLogger
    {
        return container()->get(StdoutLoggerInterface::class);
    }
}

/*
 * 文件日志
 */
if (! function_exists('logger')) {
    function logger(): LoggerInterface
    {
        return container()->get(LoggerFactory::class)->make();
    }
}

if (! function_exists('request')) {
    function request(): RequestInterface
    {
        return container()->get(ServerRequestInterface::class);
    }
}

if (! function_exists('response')) {
    function response(): ResponseInterface
    {
        return container()->get(ResponseInterface::class);
    }
}

if (! function_exists('response_json')) {
    function response_json($data, $message = '', $code = 200): ResponseInterface
    {
        $code = $code ?: 500;
        $message = $message ?: 'ok';
        $data = json_encode([
            'code' => $code,
            'message' => $message,
            'data' => $data,
        ], JSON_UNESCAPED_UNICODE);
        return response()->withAddedHeader('Content-Type', 'application/json')->withStatus($code)->withBody(new SwooleStream($data));
    }
}
