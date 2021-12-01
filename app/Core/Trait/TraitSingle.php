<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Core\Trait;

/**
 * 单例抽象类.
 */
trait TraitSingle
{
    protected static self|null $instance = null;

    final protected function __construct()
    {
    }

    final protected function __clone()
    {
    }

    public static function getInstance(): ?static
    {
        if (self::$instance == null) {
            self::$instance = new self();
        }
        return self::$instance;
    }
}
