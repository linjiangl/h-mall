<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Constants\Action;

use App\Constants\TraitConstants;
use Hyperf\Constants\AbstractConstants;
use Hyperf\Constants\Annotation\Constants;

/**
 * @Constants
 */
class SystemAction extends AbstractConstants
{
    use TraitConstants;

    /**
     * @Message("创建幻灯片")
     */
    public const SLIDE_CREATE = 'slide_create';

    /**
     * @Message("修改幻灯片")
     */
    public const SLIDE_UPDATE = 'slide_update';

    /**
     * @Message("创建广告")
     */
    public const ADVERTISEMENT_CREATE = 'advertisement_create';

    /**
     * @Message("修改广告")
     */
    public const ADVERTISEMENT_UPDATE = 'advertisement_update';
}
