<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Core\Dao\System;

use App\Core\Dao\AbstractDao;
use App\Model\Attachment;

class AttachmentDao extends AbstractDao
{
    protected string $model = Attachment::class;

    protected array $noAllowActions = [];

    protected string $notFoundMessage = '附件不存在';

    public function getInfoByIndex(string $index): Attachment
    {
        return $this->getInfoByCondition([['index', '=', $index]]);
    }

    public function getInfoByEncrypt(string $encrypt): Attachment
    {
        return $this->getInfoByCondition([['encrypt', '=', $encrypt]]);
    }
}
