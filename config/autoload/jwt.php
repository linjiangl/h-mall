<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */

use App\Constants\JwtSinceConstants;

return [
    // 非对称加密使用字符串,请使用自己加密的字符串
    'secret' => env('JWT_SECRET', 'U2FsdGVkX1+5a0PASn7USXRvQm71'),

    // token过期时间，单位为秒
    'ttl' => env('JWT_TTL', 86400 * 15),

    // 签发人
    'issued' => env('JWT_ISSUED', 'http://xcmei.com'),

    // 请求header参数
    'header' => env('JWT_HEADER', 'Authorization'),

    'scene' => [
        JwtSinceConstants::SINCE_DEFAULT => [],
        JwtSinceConstants::SINCE_BACKEND => [
            'secret' => 'U2FsdGVkX1/Yrvu0ss0KUQ8PnCWGdSEQ',
            'ttl' => 86400,
            'header' => 'Authorization',
            'issued' => 'http://xcmei.com',
        ],
    ],
];
