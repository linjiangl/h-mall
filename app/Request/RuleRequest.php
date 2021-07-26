<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Request;

use Hyperf\Contract\ContainerInterface;
use Hyperf\Di\Annotation\Inject;

class RuleRequest
{
    /**
     * @Inject
     */
    protected ContainerInterface $container;

    public function getRule(InterfaceRequest $class, string $key): array
    {
        return (new $class($this->container))->rules($key);
    }
}
