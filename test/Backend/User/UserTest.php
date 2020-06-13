<?php


namespace HyperfTest\Backend\User;


use HyperfTest\Backend\BackendHttpTestCase;
use HyperfTest\Backend\TraitBackendAuthorize;

class UserTest extends BackendHttpTestCase
{
    use TraitBackendAuthorize;

    public function testBackendUserIndex()
    {
        $result = $this->request('/user', [], 'get', $this->getHeaders());

        $this->assertSame(200, $result['code']);
        $this->assertArrayHasKey('current_page', $result['data']);
    }

    public function testBackendUserShow()
    {
        $result = $this->request('/user/1', [], 'get', $this->getHeaders());

        $this->assertSame(200, $result['code']);
        $this->assertArrayHasKey('id', $result['data']);
    }
}
