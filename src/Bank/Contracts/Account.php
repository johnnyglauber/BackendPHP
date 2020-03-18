<?php

namespace Reweb\Job\Backend\Bank\Contracts;

/**
 * Conta Bancária
 */
interface Account
{
    /**
     * Obtém a taxa para cada saque bancário
     *
     * @return float
     */
    public function getWithdrawalRate(): float;

    /**
     * Obtém o limite máximo para cada saque bancário
     *
     * @return float
     */
    public function getWithdrawalLimit(): float;
}