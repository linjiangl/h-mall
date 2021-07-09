<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
use App\Exception\InternalException;
use Hyperf\Contract\StdoutLoggerInterface;
use Hyperf\DbConnection\Db;
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
use Swoole\WebSocket\Server as WebSocketServer;

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
    function response_json($data, string $message = '', int $code = 200): Psr\Http\Message\ResponseInterface
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

if (! function_exists('general_regex')) {
    /**
     * 通用正则表达式.
     * @param string $option 选项
     */
    function general_regex(string $option = 'mobile'): string
    {
        switch ($option) {
            case 'mobile':
                $regex = '/^1\d{10}$/';
                break;
            case 'ids':
                $regex = '/^\d+(,\d+)*$/';
                break;
            default:
                throw new InternalException("{$option}未定义表达式");
        }
        return $regex;
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
     * @param null $remark 备注
     * @param string $level 日志级别
     */
    function write_logs(string $message, $remark = null, string $level = 'error')
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
     * @param mixed $data 要处理的数据
     * @return array|false|mixed|string
     */
    function database_text($data, string $schema = 'en')
    {
        if ($schema == 'en') {
            return empty($data) ? '' : json_encode($data, JSON_UNESCAPED_UNICODE);
        }
        return empty($data) ? [] : json_decode($data, true);
    }
}

if (! function_exists('create_table_comment')) {
    /**
     * 创建表注释.
     */
    function create_table_comment(string $table, string $comment): void
    {
        $tableName = get_table_name($table);
        Db::statement("ALTER TABLE `{$tableName}` COMMENT '{$comment}'");
    }
}

if (! function_exists('get_table_name')) {
    /**
     * 获取数据库真实的表名.
     */
    function get_table_name(string $table): string
    {
        return $tableName = config('databases')['default']['prefix'] . $table;
    }
}
