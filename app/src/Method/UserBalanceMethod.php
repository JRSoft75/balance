<?php

namespace App\Method;

use App\Repository\BalanceHistoryRepository;
use Yoanm\JsonRpcServer\Domain\JsonRpcMethodInterface;
use App\Service\BalanceService;

class UserBalanceMethod implements JsonRpcMethodInterface
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
        if($paramList && $paramList['user_id']) {
            return $this->bs->getBalance((int)$paramList['user_id'], $this->bhr);
        } else {
            return '';
        }
    }
}
