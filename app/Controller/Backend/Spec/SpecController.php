<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://store.yii.red
 * @document https://document.store.yii.red
 * @contact  8257796@qq.com
 */
namespace App\Controller\Backend\Spec;

use App\Controller\BackendController;
use App\Core\Block\Common\Spec\SpecBlock;
use App\Request\Backend\Spec\SpecRequest;

class SpecController extends BackendController
{
    public function storeRequest(SpecRequest $request): int
    {
        $request->validated();
        return $this->store();
    }

    protected function block(): SpecBlock
    {
        return new SpecBlock();
    }
}
