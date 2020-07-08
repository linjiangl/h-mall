<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://store.yii.red
 * @document https://document.store.yii.red
 * @contact  8257796@qq.com
 */
namespace App\Core\Block\Backend\System;

use App\Core\Block\AbstractBlock;
use App\Exception\HttpException;
use App\Core\Service\Role\RoleMenuService;
use App\Core\Service\Role\RoleService;
use Throwable;

class RoleBlock extends AbstractBlock
{
    protected $service = RoleService::class;

    public function changeRoleMenu(array $data): bool
    {
        try {
            $service = new RoleMenuService();
            return $service->changeRoleMenu((int)$data['role_id'], (int)$data['menu_id'], $data['check'] ? true : false);
        } catch (Throwable $e) {
            throw new HttpException($e->getMessage(), $e->getCode());
        }
    }
}