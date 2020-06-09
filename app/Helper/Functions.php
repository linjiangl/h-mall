<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://www.doubi.site
 * @document https://doc.doubi.site
 * @contact  8257796@qq.com
 */

use Hyperf\Contract\StdoutLoggerInterface;
use Hyperf\Framework\Logger\StdoutLogger;
use Hyperf\HttpMessage\Stream\SwooleStream;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Contract\ResponseInterface;
use Hyperf\Logger\LoggerFactory;
use Hyperf\Utils\ApplicationContext;
use Psr\Http\Message\ServerRequestInterface;
use Swoole\WebSocket\Server as WebSocketServer;

/*
 * 容器实例
 */
if (! function_exists('container')) {
    function container()
    {
        return ApplicationContext::getContainer();
    }
}

/*
 * redis 客户端实例
 */
if (! function_exists('redis')) {
    /**
     * @return Redis
     */
    function redis()
    {
        return container()->get(Redis::class);
    }
}

/*
 * websocket 实例
 */
if (! function_exists('websocket')) {
    /**
     * @return Swoole\WebSocket\Server
     */
    function websocket()
    {
        return container()->get(WebSocketServer::class);
    }
}

/*
 * 缓存实例 简单的缓存
 */
if (! function_exists('cache')) {
    function cache()
    {
        return container()->get(Psr\SimpleCache\CacheInterface::class);
    }
}

/*
 * 控制台日志
 */
if (! function_exists('stdLog')) {
    /**
     * @return StdoutLogger
     */
    function stdLog()
    {
        return container()->get(StdoutLoggerInterface::class);
    }
}

/*
 * 文件日志
 */
if (! function_exists('logger')) {
    /**
     * @return LoggerFactory
     */
    function logger()
    {
        return container()->get(LoggerFactory::class)->make();
    }
}

if (! function_exists('request')) {
    /**
     * @return RequestInterface
     */
    function request()
    {
        return container()->get(ServerRequestInterface::class);
    }
}

if (! function_exists('response')) {
    /**
     * @return ResponseInterface
     */
    function response()
    {
        return container()->get(ResponseInterface::class);
    }
}

if (! function_exists('response_json')) {
    function response_json($data, $message = '', $code = 200)
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
