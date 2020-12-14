<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://store.yii.red
 * @document https://document.store.yii.red
 * @contact  8257796@qq.com
 */
namespace App\Controller\Backend\Log;

use App\Controller\BackendController;
use App\Core\Block\Common\Log\LogAdminActionBlock;

class LogAdminActionController extends BackendController
{
    protected function block(): LogAdminActionBlock
    {
        return new LogAdminActionBlock();
    }
}
