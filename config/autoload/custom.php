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
    // 店铺
    'shop' => [
        'system_shop_id' => 1,
    ],

    // 附件配置
    'attachment' => [
        'encrypt_limit_size' => 1024 * 1024 * 10, // 小于等于该值时,检查文件的 MD5 散列值
    ],

    // 七牛存储配置
    'qn' => [
        'access_key' => env('QN_ACCESS_KEY'),
        'secret_key' => env('QN_SECRET_KEY'),
        'bucket_name' => env('QN_BUCKET_NAME'),
        'cdn' => env('QN_CDN'),
        'pipeline' => env('QN_PIPELINE'),
    ],

    // 百度富文本编辑器配置
    'ueditor' => [
        'imageActionName' => 'uploadimage', /* 执行上传图片的action名称 */
        'imageFieldName' => 'image', /* 提交的图片表单名称 */
        'imageMaxSize' => 3072000, /* 上传大小限制，单位B */
        'imageAllowFiles' => ['.png', '.jpg', '.jpeg', '.gif'], /* 上传图片格式显示 */
        'imageCompressEnable' => false, /* 是否压缩图片,默认是true */
        'imageCompressBorder' => 1600, /* 图片压缩最长边限制 */
        'imageInsertAlign' => 'none', /* 插入的图片浮动方式 */
        'imageUrlPrefix' => '', /* 图片访问路径前缀 */
        'imagePathFormat' => '/ueditor/php/upload/image/{yyyy}{mm}{dd}/{time}{rand:6}', /* 上传保存路径,可以自定义保存路径和文件名格式 */
        /* {filename} 会替换成原文件名,配置这项需要注意中文乱码问题 */
        /* {rand:6} 会替换成随机数,后面的数字是随机数的位数 */
        /* {time} 会替换成时间戳 */
        /* {yyyy} 会替换成四位年份 */
        /* {yy} 会替换成两位年份 */
        /* {mm} 会替换成两位月份 */
        /* {dd} 会替换成两位日期 */
        /* {hh} 会替换成两位小时 */
        /* {ii} 会替换成两位分钟 */
        /* {ss} 会替换成两位秒 */
        /* 非法字符 \ =>* ? " < > | */
        /* 具请体看线上文档=>fex.baidu.com/ueditor/#use-format_upload_filename */

        /* 涂鸦图片上传配置项 */
        'scrawlActionName' => 'uploadscrawl', /* 执行上传涂鸦的action名称 */
        'scrawlFieldName' => 'image', /* 提交的图片表单名称 */
        'scrawlPathFormat' => '/ueditor/php/upload/image/{yyyy}{mm}{dd}/{time}{rand:6}', /* 上传保存路径,可以自定义保存路径和文件名格式 */
        'scrawlMaxSize' => 3072000, /* 上传大小限制，单位B */
        'scrawlUrlPrefix' => '', /* 图片访问路径前缀 */
        'scrawlInsertAlign' => 'none',

        /* 截图工具上传 */
        'snapscreenActionName' => 'uploadimage', /* 执行上传截图的action名称 */
        'snapscreenPathFormat' => '/ueditor/php/upload/image/{yyyy}{mm}{dd}/{time}{rand:6}', /* 上传保存路径,可以自定义保存路径和文件名格式 */
        'snapscreenUrlPrefix' => '', /* 图片访问路径前缀 */
        'snapscreenInsertAlign' => 'none', /* 插入的图片浮动方式 */

        /* 抓取远程图片配置 */
        'catcherLocalDomain' => ['127.0.0.1', 'localhost', 'img.baidu.com'],
        'catcherActionName' => 'catchimage', /* 执行抓取远程图片的action名称 */
        'catcherFieldName' => 'imag', /* 提交的图片列表表单名称 */
        'catcherPathFormat' => '/ueditor/php/upload/image/{yyyy}{mm}{dd}/{time}{rand:6}', /* 上传保存路径,可以自定义保存路径和文件名格式 */
        'catcherUrlPrefix' => '', /* 图片访问路径前缀 */
        'catcherMaxSize' => 2048000, /* 上传大小限制，单位B */
        'catcherAllowFiles' => ['.png', '.jpg', '.jpeg', '.gif', '.bmp'], /* 抓取图片格式显示 */
    ],
];
