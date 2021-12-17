<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Core\Block\Common\User;

use App\Constants\BlockSinceConstants;
use App\Core\Block\BaseBlock;
use App\Core\Service\User\UserService;

class UserBlock extends BaseBlock
{
    protected string $service = UserService::class;

    protected array $query = [
        '=' => ['id'],
        'like' => ['username'],
        'in' => ['status'],
        'between' => ['created_time'],
    ];

    protected array $defaultSinceWith = [
        BlockSinceConstants::SINCE_BACKEND => [
            'paginate' => ['wallet'],
            'info' => ['wallet', 'vipCard'],
        ],
        BlockSinceConstants::SINCE_FRONTEND => [
            'paginate' => ['wallet'],
            'info' => ['wallet'],
        ],
    ];
}
