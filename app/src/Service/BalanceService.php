<?php

namespace App\Service;

use App\Repository\BalanceHistoryRepository;


class BalanceService
{
    public function getBalance(int $userId, BalanceHistoryRepository $bhr): float
    {
        $balance = $bhr->findOneBy(
            ['user_id' => $userId],
            ['created_at' => 'DESC']
        );

        return $balance->getBalance();
    }

    public function getHistory(BalanceHistoryRepository $bhr, int $limit = 10): array
    {
        return  $bhr->getHistory(
            $limit
        );

    }
}

