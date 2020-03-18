<?php

namespace Reweb\Job\Backend\Tests;

use Reweb\Job\Backend;
use Reweb\Job\Backend\Bank\Transaction\CashMachine;
use Reweb\Job\Backend\Bank\Account\CheckingAccount;
use Reweb\Job\Backend\Bank\Account\SavingsAccount;

/**
 * Realiza testes unitários para as transações bancárias
 *
 * TODO: Criar testes para outras features e situações do sistema para deixar mais completo e assertivo o recurso de QA
 */
class CashMachineTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Testa depósito bancário realizado com sucesso em conta corrente através de caixa eletrônico
     *
     * @return void
     */
    public function testCheckingAccountCashMachineDeposit(): void
    {
        $fakeData = [
            'account' => 1111,
            'balance' => 10000,
            'depositAmount' => 5000,
        ];

        $checkingAccount = new CheckingAccount($fakeData['account'], $fakeData['balance']);
        $balanceBeforeTransaction = $checkingAccount->balance;

        $cashMachine = new CashMachine();
        $cashMachine->deposit($fakeData['depositAmount'], $checkingAccount);
        $balanceAfterTransaction = $checkingAccount->balance;

        $this->assertEquals($balanceAfterTransaction, $balanceBeforeTransaction + $fakeData['depositAmount']);
    }

    /**
     * Testa depósito bancário realizado com sucesso em conta poupança através de caixa eletrônico
     *
     * @return void
     */
    public function testSavingsAccountCashMachineDeposit(): void
    {
        $fakeData = [
            'account' => 2222,
            'balance' => 90000,
            'depositAmount' => 9000,
        ];

        $savingsAccount = new SavingsAccount($fakeData['account'], $fakeData['balance']);
        $balanceBeforeTransaction = $savingsAccount->balance;

        $cashMachine = new CashMachine();
        $cashMachine->deposit($fakeData['depositAmount'], $savingsAccount);
        $balanceAfterTransaction = $savingsAccount->balance;

        $this->assertEquals($balanceAfterTransaction, $balanceBeforeTransaction + $fakeData['depositAmount']);
    }

    /**
     * Testa saque bancário realizado com sucesso de conta corrente através de caixa eletrônico
     *
     * @return void
     */
    public function testCheckingAccountCashMachineWithdrawal(): void
    {
        $fakeData = [
            'account' => 3333,
            'balance' => 20000,
            'withdrawalAmount' => 300,
        ];

        $checkingAccount = new CheckingAccount($fakeData['account'], $fakeData['balance']);
        $balanceBeforeTransaction = $checkingAccount->balance;

        $cashMachine = new CashMachine();
        $cashMachine->withdraw($fakeData['withdrawalAmount'], $checkingAccount);
        $balanceAfterTransaction = $checkingAccount->balance;

        $this->assertEquals($balanceAfterTransaction, $balanceBeforeTransaction - ($fakeData['withdrawalAmount'] + $checkingAccount->withdrawalRate));
    }

    /**
     * Testa saque bancário realizado com sucesso de conta poupança através de caixa eletrônico
     *
     * @return void
     */
    public function testSavingsAccountCashMachineWithdrawal(): void
    {
        $fakeData = [
            'account' => 4444,
            'balance' => 100000,
            'withdrawalAmount' => 500,
        ];

        $savingsAccount = new CheckingAccount($fakeData['account'], $fakeData['balance']);
        $balanceBeforeTransaction = $savingsAccount->balance;

        $cashMachine = new CashMachine();
        $cashMachine->withdraw($fakeData['withdrawalAmount'], $savingsAccount);
        $balanceAfterTransaction = $savingsAccount->balance;

        $this->assertEquals($balanceAfterTransaction, $balanceBeforeTransaction - ($fakeData['withdrawalAmount'] + $savingsAccount->withdrawalRate));
    }

    /**
     * Testa transferência bancária realizada com sucesso de uma conta corrente para outra através de caixa eletrônico
     *
     * @return void
     */
    public function testCashMachineTransferBetweenCheckingAccounts(): void
    {
        $fakeData = [
            'sourceAccount' => 5555,
            'sourceBalance' => 40000,
            'targetAccount' => 6666,
            'targetBalance' => 16000,
            'transferAmount' => 800,
        ];

        $sourceAccount = new CheckingAccount($fakeData['sourceAccount'], $fakeData['sourceBalance']);
        $sourceBalanceBeforeTransaction = $sourceAccount->balance;

        $targetAccount = new CheckingAccount($fakeData['targetAccount'], $fakeData['targetBalance']);
        $targetBalanceBeforeTransaction = $targetAccount->balance;

        $cashMachine = new CashMachine();
        $cashMachine->transfer($fakeData['transferAmount'], $sourceAccount, $targetAccount);
        $sourceBalanceAfterTransaction = $sourceAccount->balance;
        $targetBalanceAfterTransaction = $targetAccount->balance;

        $this->assertEquals($sourceBalanceAfterTransaction, $sourceBalanceBeforeTransaction - $fakeData['transferAmount']);
        $this->assertEquals($targetBalanceAfterTransaction, $targetBalanceBeforeTransaction + $fakeData['transferAmount']);
    }

    /**
     * Testa transferência bancária realizada com sucesso de conta poupança para conta corrente através de caixa eletrônico
     *
     * @return void
     */
    public function testCashMachineTransferFromSavingsAccountToCheckingAccount(): void
    {
        $fakeData = [
            'sourceAccount' => 7777,
            'sourceBalance' => 7000,
            'targetAccount' => 8888,
            'targetBalance' => 12000,
            'transferAmount' => 1800,
        ];

        $sourceAccount = new SavingsAccount($fakeData['sourceAccount'], $fakeData['sourceBalance']);
        $sourceBalanceBeforeTransaction = $sourceAccount->balance;

        $targetAccount = new CheckingAccount($fakeData['targetAccount'], $fakeData['targetBalance']);
        $targetBalanceBeforeTransaction = $targetAccount->balance;

        $cashMachine = new CashMachine();
        $cashMachine->transfer($fakeData['transferAmount'], $sourceAccount, $targetAccount);
        $sourceBalanceAfterTransaction = $sourceAccount->balance;
        $targetBalanceAfterTransaction = $targetAccount->balance;

        $this->assertEquals($sourceBalanceAfterTransaction, $sourceBalanceBeforeTransaction - $fakeData['transferAmount']);
        $this->assertEquals($targetBalanceAfterTransaction, $targetBalanceBeforeTransaction + $fakeData['transferAmount']);
    }
}