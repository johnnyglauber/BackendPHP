<?php

namespace Reweb\Job\Backend\Bank\Account;

use Reweb\Job\Backend\Bank\Config;

/**
 * Conta Poupança
 */
class SavingsAccount extends Account
{
    /**
     * @inheritDoc
     */
    public function getWithdrawalRate(): float
    {
        return (new Config)->withdrawalRate['savingsAccount'];
    }

    /**
     * @inheritDoc
     */
    public function getWithdrawalLimit(): float
    {
        return (new Config)->withdrawalLimit['savingsAccount'];
    }
}