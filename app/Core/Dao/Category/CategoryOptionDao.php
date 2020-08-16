<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://store.yii.red
 * @document https://document.store.yii.red
 * @contact  8257796@qq.com
 */
namespace App\Core\Dao\Category;

use App\Core\Dao\AbstractDao;
use App\Model\Category\CategoryOption;

class CategoryOptionDao extends AbstractDao
{
    protected $model = CategoryOption::class;

    protected $noAllowActions = [];

    protected $notFoundMessage = '分类规格不存在或已删除';
}
