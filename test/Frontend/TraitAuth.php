<?php


namespace HyperfTest\Frontend;


trait TraitAuth
{
    protected $token;

    protected $filename = '/runtime/testing_token.txt';

    public function setToken($token)
    {
        file_put_contents(BASE_PATH . $this->filename, $token);
    }

    public function getToken()
    {
        return file_get_contents(BASE_PATH. $this->filename);
    }

    public function getHeaders()
    {
        return [
            'Authorization' => $this->getToken()
        ];
    }
}
