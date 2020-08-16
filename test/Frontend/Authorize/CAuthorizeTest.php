<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://store.yii.red
 * @document https://document.store.yii.red
 * @contact  8257796@qq.com
 */
namespace HyperfTest\Frontend\Authorize;

use HyperfTest\Frontend\FrontendHttpTestCase;
use HyperfTest\Frontend\TraitFrontendAuthorize;

class CAuthorizeTest extends FrontendHttpTestCase
{
    use TraitFrontendAuthorize;

    public function testFrontendAuthorize()
    {
        $result = $this->request('/authorize', [], 'post', $this->getHeaders());

        $this->handelError($result);
        $this->assertArrayHasKey('id', $result);
        $this->assertSame('test001', $result['username']);
        $this->assertArrayNotHasKey('password', $result);
    }
}
