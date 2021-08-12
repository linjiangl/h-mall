<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Request\Common;

use App\Core\Tools\Validate;
use App\Request\AbstractRequest;

class BatchOperationRequest extends AbstractRequest
{
    public function rules(string $ruleKey = ''): array
    {
        return [
            'select_ids' => Validate::ruleRegex(Validate::REGEX_TYPE_IDS, true),
        ];
    }

    public function attributes(): array
    {
        return [
            'select_ids' => '所选择的操作ID',
        ];
    }
}
