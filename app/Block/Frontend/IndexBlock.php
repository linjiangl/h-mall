<?php


namespace App\Block\Frontend;


use App\Block\AbstractBlock;
use Hyperf\HttpServer\Contract\RequestInterface;

class IndexBlock extends AbstractBlock
{
    protected $page = 1;

    public function index(RequestInterface $request)
    {
        $page = $request->query('page', 1);
        $this->page = $this->page + $page;

        return $this->page;
    }
}