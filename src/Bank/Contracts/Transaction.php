<?php

namespace Reweb\Job\Backend\Bank\Contracts;

use Reweb\Job\Backend\Bank\Account\Account;

/**
 * Transação Bancária
 */
interface Transaction
{
    /**
     * Realiza depósito bancário
     *
     * @param float $amount
     * @param Account $account
     * @return void
     */
    public function deposit($amount, Account $account): void;

    /**
     * Realiza saque bancário
     *
     * @param float $amount
     * @param Account $account
     * @return void
     */
    public function withdraw($amount, Account $account): void;

    /**
     * Realiza transferência bancária
     *
     * @param float $amount
     * @param Account $sourceAccount
     * @param Account $targetAccount
     * @return void
     */
    public function transfer($amount, Account $sourceAccount, Account $targetAccount): void;

    /**
     * Valida se há saldo na conta para realização de saque bancário
     *
     * @param float $amount
     * @param Account $account
     * @return void
     */
    public function checkAvailableBalance($amount, Account $account): void;

    /**
     * Valida o limite máximo para cada realização de saque bancário
     *
     * @param float $amount
     * @param Account $account
     * @return void
     */
    public function checkWithdrawalLimit($amount, Account $account): void;
}