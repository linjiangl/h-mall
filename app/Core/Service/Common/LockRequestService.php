<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Core\Service\Common;

use App\Exception\RequestLockException;

class LockRequestService
{
    /**
     * 开启请求锁机制.
     * @param array $params 其他参数
     * @param int $ttl 有效期
     */
    public static function open(array $params = [], int $ttl = 10, bool $isLock = true)
    {
        $key = '';
        if (! empty($params)) {
            $data = [];
            foreach ($params as $key => $val) {
                $data[] = sprintf('%d:%s', $key, $val);
            }
            $key = implode(':', $data);
            if (strlen($key) > 64) {
                $key = 'hash:' . md5($key);
            }
            $key = ':' . $key;
        }

        if ($isLock) {
            $request = request();
            $lockIndex = $request->getMethod() . ':' . $request->getUri()->getPath() . $key;
            $userId = $request->getAttribute('user_id', 0);
            if ($userId) {
                $lockIndex = sprintf('%s:user_id:%d', $lockIndex, $userId);
            }
            if (redis()->get($lockIndex)) {
                throw new RequestLockException();
            }
            redis()->set($lockIndex, 1, $ttl);
        }
    }
}
