<?php

namespace Reweb\Job\Backend\Bank\Transaction;

use Reweb\Job\Backend\Bank\Contracts\Transaction as TransactionInterface;
use Reweb\Job\Backend\Bank\Account\Account;
use Reweb\Job\Backend\Bank\Exception\ExceptionHandler;

/**
 * @inheritDoc
 */
abstract class Transaction implements TransactionInterface
{
    /**
     * Instancia uma nova transação bancária
     * Também define funções customizadas para tratamentos de erros e de exceções
     *
     * @return void
     */
    public function __construct()
    {
        ExceptionHandler::setErrorHandler();
        ExceptionHandler::setErrorException();
    }

    /**
     * @inheritDoc
     */
    abstract function deposit($amount, Account $account): void;

    /**
     * @inheritDoc
     */
    abstract function withdraw($amount, Account $account): void;

    /**
     * @inheritDoc
     */
    abstract function transfer($amount, Account $sourceAccount, Account $targetAccount): void;

    /**
     * @inheritDoc
     */
    abstract function checkAvailableBalance($amount, Account $account): void;

    /**
     * @inheritDoc
     */
    abstract function checkWithdrawalLimit($amount, Account $account): void;
}