<?php

namespace Reweb\Job\Backend\Bank\Account;

use Reweb\Job\Backend\Bank\Config;

/**
 * Conta Corrente
 */
class CheckingAccount extends Account
{
    /**
     * @inheritDoc
     */
    public function getWithdrawalRate(): float
    {
        return (new Config)->withdrawalRate['checkingAccount'];
    }

    /**
     * @inheritDoc
     */
    public function getWithdrawalLimit(): float
    {
        return (new Config)->withdrawalLimit['checkingAccount'];
    }
}