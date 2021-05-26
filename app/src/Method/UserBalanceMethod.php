<?php

namespace App\Method;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Constraints\Choice;
use Symfony\Component\Validator\Constraints\Collection;
use Symfony\Component\Validator\Constraints\Composite;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Optional;
use Symfony\Component\Validator\Constraints\Positive;
use Symfony\Component\Validator\Constraints\Required;
use Symfony\Component\Validator\Constraints\ZeroComparisonConstraintTrait;
use Yoanm\JsonRpcParamsSymfonyValidator\Domain\MethodWithValidatedParamsInterface;
use Yoanm\JsonRpcServer\Domain\JsonRpcMethodInterface;
use App\Repository\BalanceHistoryRepository;
use App\Service\BalanceService;

class UserBalanceMethod implements JsonRpcMethodInterface, MethodWithValidatedParamsInterface
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

    public function getParamsConstraint() : Constraint
    {
        return new Collection(['fields' => [
            'user_id' => new Required([
                    new Positive()
                ]),
        ]]);
    }
}
