<?php

namespace Reweb\Job\Backend\Bank\Transaction;

use Reweb\Job\Backend\Bank\Account\Account;
use Reweb\Job\Backend\Bank\Exception\ExceptionHandler;
use Reweb\Job\Backend\Bank\Message;

/**
 * Caixa Eletrônico
 */
class CashMachine extends Transaction
{
    /**
     * @inheritDoc
     */
    public function deposit($amount, Account $account): void
    {
        try {
            $account->balance += $amount;
        } catch (\ErrorException $e) {
            Message::displayMessage(Message::$failedDeposit);
            die();
        }
        Message::displayMessage(Message::$successfulDeposit);
    }

    /**
     * @inheritDoc
     */
    public function withdraw($amount, Account $account): void
    {
        try {
            $this->checkWithdrawalLimit($amount, $account);
            $total = $amount + $account->withdrawalRate;
            $this->checkAvailableBalance($total, $account);
            $account->balance -= $total;
        } catch (\ErrorException $e) {
            Message::displayMessage(Message::$failedWithdrawal);
            die();
        }
        Message::displayMessage(Message::$successfulWithdrawal);
    }

    /**
     * @inheritDoc
     */
    public function transfer($amount, Account $sourceAccount, Account $targetAccount): void
    {
        try {
            $this->checkAvailableBalance($amount, $sourceAccount);
            $sourceAccount->balance -= $amount;
            $targetAccount->balance += $amount;
        } catch (\ErrorException $e) {
            Message::displayMessage(Message::$failedTransfer);
            die();
        }
        Message::displayMessage(Message::$successfulTransfer);
    }

    /**
     * @inheritDoc
     */
    public function checkAvailableBalance($amount, Account $account): void
    {
        if ($account->balance < $amount) {
            (new ExceptionHandler)->triggerError(Message::$unavailableBalance);
        }
    }

    /**
     * @inheritDoc
     */
    public function checkWithdrawalLimit($amount, Account $account): void
    {
        if ($amount > $account->withdrawalLimit) {
            (new ExceptionHandler)->triggerError(Message::$exceededLimit);
        }
    }
}