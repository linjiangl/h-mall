<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
use Hyperf\Contract\StdoutLoggerInterface;
use Hyperf\Framework\Logger\StdoutLogger;
use Hyperf\HttpMessage\Stream\SwooleStream;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Contract\ResponseInterface;
use Hyperf\Logger\LoggerFactory;
use Hyperf\Redis\Redis;
use Hyperf\Utils\ApplicationContext;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Log\LoggerInterface;
use Psr\SimpleCache\CacheInterface;

if (! function_exists('container')) {
    /**
     * 容器实例.
     */
    function container(): ContainerInterface
    {
        return ApplicationContext::getContainer();
    }
}

if (! function_exists('redis')) {
    /**
     * redis 客户端实例.
     */
    function redis(): Redis
    {
        return container()->get(Redis::class);
    }
}

if (! function_exists('cache')) {
    /**
     * 缓存实例 简单的缓存.
     */
    function cache(): CacheInterface
    {
        return container()->get(CacheInterface::class);
    }
}

if (! function_exists('stdLog')) {
    /**
     * 控制台日志.
     */
    function stdLog(): StdoutLogger
    {
        return container()->get(StdoutLoggerInterface::class);
    }
}

if (! function_exists('logger')) {
    /**
     * 文件日志.
     */
    function logger(): LoggerInterface
    {
        return container()->get(LoggerFactory::class)->make();
    }
}

if (! function_exists('request')) {
    /**
     * 请求实例.
     */
    function request(): RequestInterface
    {
        return container()->get(ServerRequestInterface::class);
    }
}

if (! function_exists('response')) {
    /**
     * 响应实例.
     */
    function response(): ResponseInterface
    {
        return container()->get(ResponseInterface::class);
    }
}

if (! function_exists('response_json')) {
    /**
     * 接口响应数据格式.
     */
    function response_json(mixed $data, string $message = '', int $code = 200): Psr\Http\Message\ResponseInterface
    {
        $code = $code ?: 500;
        if ($code >= 200 && $code < 300) {
            $data = json_encode($data, JSON_UNESCAPED_UNICODE);
        } else {
            $data = json_encode([
                'code' => $code,
                'error' => $message,
            ], JSON_UNESCAPED_UNICODE);
        }
        return response()->withAddedHeader('Content-Type', 'application/json')->withStatus($code)->withBody(new SwooleStream($data));
    }
}

if (! function_exists('check_production')) {
    /**
     * 检测是否生产环境.
     */
    function check_production(): bool
    {
        return config('app_env') == 'prod';
    }
}

if (! function_exists('get_client_ip')) {
    /**
     * 获取客户端IP地址
     */
    function get_client_ip(): string
    {
        $request = request();
        $ip = '127.0.0.1';
        if ($request) {
            $ip = $request->header('x-real-ip');
            $ip = $ip ? current($ip) : '127.0.0.1';
        }
        return $ip;
    }
}

if (! function_exists('write_logs')) {
    /**
     * 记录日志.
     * @param string $message 日志说明
     * @param mixed $remark 备注
     * @param string $level 日志级别
     */
    function write_logs(string $message, mixed $remark = null, string $level = 'error')
    {
        $backtrace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 2);
        container()->get(LoggerFactory::class)->make('Customize', 'customize')->log($level, $message, [
            'remark' => $remark ?: '',
            'trace' => count($backtrace) === 2 ? $backtrace[1]['class'] . '::' . $backtrace[1]['function'] . ' ' . $backtrace[0]['line'] : '',
        ]);
    }
}

if (! function_exists('database_text')) {
    /**
     * 数据库文本数据.
     * @param array|string $data 要处理的数据
     */
    function database_text(array|string $data, string $schema = 'en'): array|string
    {
        if ($schema == 'en') {
            return empty($data) ? '' : json_encode($data, JSON_UNESCAPED_UNICODE);
        }
        return empty($data) ? [] : json_decode($data, true);
    }
}

if (! function_exists('get_table_name')) {
    /**
     * 获取数据库真实的表名.
     */
    function get_table_name(string $table): string
    {
        return config('databases')['default']['prefix'] . $table;
    }
}
