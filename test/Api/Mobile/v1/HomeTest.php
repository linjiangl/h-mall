<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://store.yii.red
 * @document https://document.store.yii.red
 * @contact  8257796@qq.com
 */
namespace HyperfTest\Api\Mobile\v1;

use HyperfTest\AbstractHttpTestCase;

class HomeTest extends AbstractHttpTestCase
{
    public function testMobileHome()
    {
        $result = $this->request('/v1/home', [], 'get');

        $this->handelError($result);
        $this->assertSame('rest_v1', $result);
    }
}
