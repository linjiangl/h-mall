<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://store.yii.red
 * @document https://document.store.yii.red
 * @contact  8257796@qq.com
 */
namespace App\Core\Dao;

use App\Model\Attachment;

class AttachmentDao extends AbstractDao
{
    protected $model = Attachment::class;

    protected $noAllowActions = [];

    protected $notFoundMessage = '附件不存在';

    public function getInfoByIndex(string $index): Attachment
    {
        return $this->getInfoByCondition([
            ['index', '=', $index]
        ]);
    }
}
