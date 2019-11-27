<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://www.doubi.site
 * @document https://doc.doubi.site
 * @contact  8257796@qq.com
 */

return [
    'frontend' => [
        'key' => 'kvRHkeRCl12vlNDFu3oQtHIJhJbQLAiu',
        'issuer' => 'frontend',
        'audience' => 'frontend',
        'subject' => 'frontend',
        'id' => 'frontend',
        'expire' => 864000,
        'header' => 'Access-Token',
    ],
    'backend' => [
        'key' => 'eatE9gNotDuKACbm2oaXoDQzR6PGDrJlVq',
        'issuer' => 'backend',
        'audience' => 'backend',
        'subject' => 'backend',
        'id' => 'backend',
        'expire' => 86400,
        'header' => 'Access-Token',
    ],
];
