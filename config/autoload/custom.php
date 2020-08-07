<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://store.yii.red
 * @document https://document.store.yii.red
 * @contact  8257796@qq.com
 */
return [
    // 七牛存储配置
    'qn' => [
        'access_key' => env('QN_ACCESS_KEY'),
        'secret_key' => env('QN_SECRET_KEY'),
        'bucket_name' => env('QN_BUCKET_NAME'),
        'cdn' => env('QN_CDN'),
        'pipeline' => env('QN_PIPELINE'),
    ]
];
