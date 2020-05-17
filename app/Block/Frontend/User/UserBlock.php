<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://www.doubi.site
 * @document https://doc.doubi.site
 * @contact  8257796@qq.com
 */
namespace App\Block\Frontend\User;

use App\Block\AbstractBlock;
use App\Service\User\UserService;

class UserBlock extends AbstractBlock
{
    protected $with = [];

    protected $query = [
        'like' => ['username']
    ];

    protected $service = UserService::class;
}
