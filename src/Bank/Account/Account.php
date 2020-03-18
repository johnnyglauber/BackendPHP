<?php

namespace Reweb\Job\Backend\Bank\Account;

use Reweb\Job\Backend\Bank\Config;
use Reweb\Job\Backend\Bank\Contracts\Account as AccountInterface;
use Reweb\Job\Backend\Bank\Exception\ExceptionHandler;

/**
 * @inheritDoc
 */
abstract class Account extends Config implements AccountInterface
{
    /**
     * O número da conta bancária
     *
     * @var integer
     */
    public $number;

    /**
     * O saldo da conta bancária
     *
     * @var float
     */
    public $balance;

    /**
     * A taxa para cada saque bancário
     *
     * @var float
     */
    public $withdrawalRate;

    /**
     * O limite máximo para cada saque bancário
     *
     * @var float
     */
    public $withdrawalLimit;

    /**
     * Instancia uma nova conta bancária
     * Também define função customizada para tratamento de exceções
     *
     * @param integer $number
     * @param float $balance
     * @return void
     */
    public function __construct($number, $balance)
    {
        ExceptionHandler::setErrorException();

        $this->number = $number;
        $this->balance = $balance;
        $this->withdrawalRate = $this->getWithdrawalRate();
        $this->withdrawalLimit = $this->getWithdrawalLimit();
    }

    /**
     * @inheritDoc
     */
    abstract function getWithdrawalRate(): float;

    /**
     * @inheritDoc
     */
    abstract function getWithdrawalLimit(): float;
}