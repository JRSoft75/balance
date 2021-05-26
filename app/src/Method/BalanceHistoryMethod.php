<?php

namespace App\Method;

use App\Repository\BalanceHistoryRepository;
use Yoanm\JsonRpcServer\Domain\JsonRpcMethodInterface;
use App\Service\BalanceService;

class BalanceHistoryMethod implements JsonRpcMethodInterface
{
    private $bhr;
    private $bs;

    public function __construct(BalanceHistoryRepository $bhr, BalanceService $bs)
    {
        $this->bhr = $bhr;
        $this->bs = $bs;
    }
    public function apply(array $paramList = null)
    {
        if($paramList && $paramList['limit']) {
            return $this->bs->getHistory($this->bhr, $paramList['limit']);
        } else {
            return '';
        }
    }
}
