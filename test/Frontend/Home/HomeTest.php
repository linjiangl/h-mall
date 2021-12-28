<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace HyperfTest\Frontend\Home;

use HyperfTest\Frontend\FrontendHttpTestCase;
use HyperfTest\Frontend\TraitFrontendAuthorize;

/**
 * @internal
 * @coversNothing
 */
class HomeTest extends FrontendHttpTestCase
{
    use TraitFrontendAuthorize;

    public function testFrontendHomeCategoryRecommend()
    {
        $this->url = '/home/category/recommend';
        $list = $this->getHttpResponse();

        $this->assertIsArray($list);

        foreach ($list as $item) {
            $this->assertArrayHasKey('children', $item);
        }
    }
}
