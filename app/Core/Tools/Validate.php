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
    const REGEX_TYPE_MOBILE = 'mobile'; // 手机号码
    const REGEX_TYPE_TELEPHONE = 'telephone';   // 电话
    const REGEX_TYPE_ID_CARD = 'id_card';   // 身份证
    const REGEX_TYPE_QQ = 'qq'; // QQ号码
    const REGEX_TYPE_DATE = 'date'; // 日期
    const REGEX_TYPE_DATE_TIME = 'date_time'; // 日期时间
    const REGEX_TYPE_ZH = 'zh'; // 中文
    const REGEX_TYPE_ZH_NAME = 'zh_name'; // 中文姓名
    const REGEX_TYPE_POSTAL_CODE = 'postal_code'; // 邮编

    /**
     * 验证规则，检查对应的模型数据是否存在
     * @param string $model 对应模型
     * @param string $requestFieldName 验证的字段
     * @param bool $isRequired 是否必填
     * @param string $column 列名
     * @return string
     */
    public static function ruleExistsModel(string $model, string $requestFieldName, bool $isRequired = false, string $column = 'id'): string
    {
        $rule = 'integer';
        $data = request()->all();
        if (isset($data[$requestFieldName]) && $data[$requestFieldName]) {
            $rule .= '|exists:' . (new $model)->getTable() . ',' . $column;
            if ($isRequired) {
                $rule = 'required|' . $rule;
            }
        }
        return $rule;
    }

    /**
     * 验证规则，检查对应的模型某个字段是否唯一
     * @param string $model
     * @param string $column
     * @param bool $isRequired
     * @param bool $isExcept 是否排除
     * @return string
     */
    public static function ruleUniqueModel(string $model, string $column, bool $isRequired = false, bool $isExcept = false): string
    {
        $rule = 'unique:' . (new $model)->getTable() . ',' . $column;
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
     * @param string $type
     * @param bool $isRequired
     * @return string
     */
    public static function ruleRegex(string $type = self::REGEX_TYPE_MOBILE, bool $isRequired = false): string
    {
        if ($isRequired) {
            $rule = 'required|';
        } else {
            $rule = '';
        }
        switch ($type) {
            case self::REGEX_TYPE_MOBILE:
                $rule .= 'regex:/^1[\d]{10}$/';
                break;
            case self::REGEX_TYPE_TELEPHONE:
                // $rule .= 'regex:/^\d{3,4}-\d{7,8}$/';
                $rule .= 'string|min:7|max:50';
                break;
            case self::REGEX_TYPE_ID_CARD:
                $rule .= 'regex:/^[1-9]\d{5}[1-3]\d{3}[0-9Xx]{8}$/';
                break;
            case self::REGEX_TYPE_QQ:
                $rule .= 'regex:/^[1-9]\d{4,10}$/';
                break;
            case self::REGEX_TYPE_DATE:
                $rule .= 'regex:/^[1-3]\d{3}(-\d{2}){2}$/';
                break;
            case self::REGEX_TYPE_DATE_TIME:
                $rule .= 'regex:/^[1-3]\d{3}(-\d{2}){2}( \d{2}(:\d{2})*)*$/';
                break;
            case self::REGEX_TYPE_ZH:
                $rule .= 'regex:/^[\x{4e00}-\x{9fa5}]+$/u';
                break;
            case self::REGEX_TYPE_ZH_NAME:
                $rule .= 'regex:/^[\x{4e00}-\x{9fa5}]{2,10}$/u';
                break;
            case self::REGEX_TYPE_POSTAL_CODE:
                $rule .= 'regex:/^[1-9]\d{5}$/';
                break;
        }
        return $rule;
    }
}
