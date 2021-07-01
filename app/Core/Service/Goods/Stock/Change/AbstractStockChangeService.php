<?php


namespace App\Core\Service\Goods\Stock\Change;


abstract class AbstractStockChangeService implements InterfaceStockChangeService
{
    protected array $append = [];

    public function __construct(array $append = [])
    {
        $this->append = $append;
    }
}
