<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://www.doubi.site
 * @document https://doc.doubi.site
 * @contact  8257796@qq.com
 */
namespace App\Service;

use App\Dao\MenuDao;

class MenuService extends AbstractService
{
    protected $dao = MenuDao::class;
}
