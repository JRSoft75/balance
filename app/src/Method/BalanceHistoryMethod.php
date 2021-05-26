<?php

namespace App\Method;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Constraints\Choice;
use Symfony\Component\Validator\Constraints\Collection;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Optional;
use Symfony\Component\Validator\Constraints\Positive;
use Symfony\Component\Validator\Constraints\Required;
use Yoanm\JsonRpcParamsSymfonyValidator\Domain\MethodWithValidatedParamsInterface;
use Yoanm\JsonRpcServer\Domain\JsonRpcMethodInterface;
use App\Repository\BalanceHistoryRepository;
use App\Service\BalanceService;

class BalanceHistoryMethod implements JsonRpcMethodInterface, MethodWithValidatedParamsInterface
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

    public function getParamsConstraint() : Constraint
    {
        return new Collection(['fields' => [
            'limit' => new Required([
                  new Positive()
              ]),
        ]]);
    }
}
