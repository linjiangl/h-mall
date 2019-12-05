<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://www.doubi.site
 * @document https://doc.doubi.site
 * @contact  8257796@qq.com
 */

namespace App\Model\Service;

use App\Exception\CacheErrorException;
use Psr\SimpleCache\InvalidArgumentException;

class CacheService
{
    public static function get($key, $default = null)
    {
        try {
            return cache()->get($key, $default);
        } catch (InvalidArgumentException $e) {
            throw new CacheErrorException();
        }
    }

    public static function set($key, $value, $ttl = null)
    {
        try {
            return \cache()->set($key, $value, $ttl);
        } catch (InvalidArgumentException $e) {
            throw new CacheErrorException();
        }
    }

    public static function delete($key)
    {
        try {
            return cache()->delete($key);
        } catch (InvalidArgumentException $e) {
            throw new CacheErrorException();
        }
    }

    public static function clear()
    {
        return cache()->clear();
    }

    public static function getMultiple($keys, $default = null)
    {
        try {
            return cache()->getMultiple($keys, $default);
        } catch (InvalidArgumentException $e) {
            throw new CacheErrorException();
        }
    }

    public static function setMultiple($values, $ttl = null)
    {
        try {
            return cache()->setMultiple($values, $ttl);
        } catch (InvalidArgumentException $e) {
            throw new CacheErrorException();
        }
    }

    public static function deleteMultiple($keys)
    {
        try {
            return cache()->deleteMultiple($keys);
        } catch (InvalidArgumentException $e) {
            throw new CacheErrorException();
        }
    }

    public static function has($key)
    {
        try {
            return cache()->has($key);
        } catch (InvalidArgumentException $e) {
            throw new CacheErrorException();
        }
    }
}
