<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
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
        'default' => [],
        'admin' => [
            'secret' => 'U2FsdGVkX1/Yrvu0ss0KUQ8PnCWGdSEQ',
            'ttl' => env('JWT_TTL', 86400),
            'header' => env('JWT_HEADER', 'Authorization'),
            'issued' => env('JWT_ISSUED', 'http://xcmei.com'),
        ]
    ],
];
