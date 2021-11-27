<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Core\Tools;

class Validate
{
    public const REGEX_TYPE_MOBILE = 'mobile'; // 手机号码

    public const REGEX_TYPE_TELEPHONE = 'telephone';   // 电话

    public const REGEX_TYPE_ID_CARD = 'id_card';   // 身份证

    public const REGEX_TYPE_QQ = 'qq'; // QQ号码

    public const REGEX_TYPE_DATE = 'date'; // 日期

    public const REGEX_TYPE_DATE_TIME = 'date_time'; // 日期时间

    public const REGEX_TYPE_ZH = 'zh'; // 中文

    public const REGEX_TYPE_ZH_NAME = 'zh_name'; // 中文姓名

    public const REGEX_TYPE_POSTAL_CODE = 'postal_code'; // 邮编

    public const REGEX_TYPE_IDS = 'ids'; // 主键多选

    public const REGEX_TYPE_ATTACHMENT = 'attachment'; // 附件地址

    /**
     * 验证规则，检查对应的模型数据是否存在.
     * @param string $model 对应模型
     * @param string $requestFieldName 验证的字段
     * @param bool $isRequired 是否必填
     * @param string $column 列名
     */
    public static function ruleExistsModel(string $model, string $requestFieldName, bool $isRequired = false, string $column = 'id'): string
    {
        $rule = 'integer';
        $data = request()->all();
        if (isset($data[$requestFieldName]) && $data[$requestFieldName]) {
            $rule .= '|exists:' . (new $model())->getTable() . ',' . $column;
            if ($isRequired) {
                $rule = 'required|' . $rule;
            }
        }
        return $rule;
    }

    /**
     * 验证规则，检查对应的模型某个字段是否唯一
     * @param bool $isExcept 是否排除
     */
    public static function ruleUniqueModel(string $model, string $column, bool $isRequired = false, bool $isExcept = false): string
    {
        $rule = 'unique:' . (new $model())->getTable() . ',' . $column;
        if ($isRequired) {
            $rule = 'required|' . $rule . '';
        }
        if ($isExcept) {
            $data = request()->all();
            $rule = $rule . ',' . $data[$column] . ',' . $column;
        }
        return $rule;
    }

    /**
     * 自定义正则验证
     */
    public static function ruleRegex(string $type = self::REGEX_TYPE_MOBILE, bool $isRequired = false): string
    {
        if ($isRequired) {
            $rule = 'required|';
        } else {
            $rule = '';
        }
        $rule .= match ($type) {
            self::REGEX_TYPE_MOBILE => 'regex:/^1[\d]{10}$/',
            self::REGEX_TYPE_TELEPHONE => 'regex:/^\d{3,4}[- ]\d{7,8}$/',
            self::REGEX_TYPE_ID_CARD => 'regex:/^[1-9]\d{5}[1-3]\d{3}[0-9Xx]{8}$/',
            self::REGEX_TYPE_QQ => 'regex:/^[1-9]\d{4,10}$/',
            self::REGEX_TYPE_DATE => 'regex:/^[1-3]\d{3}(-\d{2}){2}$/',
            self::REGEX_TYPE_DATE_TIME => 'regex:/^[1-3]\d{3}(-\d{2}){2}( \d{2}(:\d{2})*)*$/',
            self::REGEX_TYPE_ZH => 'regex:/^[\x{4e00}-\x{9fa5}]+$/u',
            self::REGEX_TYPE_ZH_NAME => 'regex:/^[\x{4e00}-\x{9fa5}]{2,10}$/u',
            self::REGEX_TYPE_POSTAL_CODE => 'regex:/^[1-9]\d{5}$/',
            self::REGEX_TYPE_ATTACHMENT => 'regex:/^\/\/([\w-]+\.)+[\w]+\/[\/\w\.]+/',
        };
        return $rule;
    }
}
