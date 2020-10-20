<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://store.yii.red
 * @document https://document.store.yii.red
 * @contact  8257796@qq.com
 */
namespace App\Constants\Action;

use App\Constants\TraitConstants;
use Hyperf\Constants\AbstractConstants;
use Hyperf\Constants\Annotation\Constants;

/**
 * @Constants()
 */
class ProductAction extends AbstractConstants
{
    use TraitConstants;

    /**
     * @Message("创建规格")
     */
    const SPEC_CREATE = 'spec_create';

    /**
     * @Message("修改规格")
     */
    const SPEC_UPDATE = 'spec_update';

    /**
     * @Message("删除规格")
     */
    const SPEC_DELETE = 'spec_delete';
}
