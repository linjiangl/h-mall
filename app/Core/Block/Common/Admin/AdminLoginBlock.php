<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Core\Block\Common\Admin;

use App\Core\Block\BaseBlock;
use App\Core\Service\Admin\AdminLoginService;

class AdminLoginBlock extends BaseBlock
{
    protected string $service = AdminLoginService::class;

    protected array $query = [
        '=' => ['username'],
        'between' => ['created_time'],
        'in' => ['status'],
    ];
}
