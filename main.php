<?php

require_once __DIR__ . '/vendor/autoload.php';

use Reweb\Job\Backend;

/*
 * Exemplos de transações bancárias realizadas em caixa eletrônico 
 * Para simular diferentes situações, basta alterar os dados fictícios (p.ex. exceder o saldo ou limite para saque)
 * 
 * */

//Instancia uma Conta Corrente com dados fictícios
$checkingAccountNumber = 1111;
$checkingAccountBalance = 100;
$checkingAccount = new Backend\Bank\Account\CheckingAccount($checkingAccountNumber, $checkingAccountBalance);

//Instancia uma Conta Poupança com dados fictícios
$savingsAccountNumber = 2222;
$savingsAccountBalance = 20000;
$savingsAccount = new Backend\Bank\Account\SavingsAccount($savingsAccountNumber, $savingsAccountBalance);

//Define valores fictícios para serem utilizados nos exemplos de Transação Bancária
$amount1 = 50;
$amount2 = 5;
$amount3 = 300;

//Instancia uma Transação Bancária em Caixa Eletrônico
$cashMachine = new Backend\Bank\Transaction\CashMachine();

//Exibe informações das Contas instanciadas antes de sofrerem Transação Bancária
var_dump($checkingAccount);
var_dump($savingsAccount);

//Realiza um Depósito em Conta Corrente e exibe as informações da Conta após a Transação
$cashMachine->deposit($amount3, $checkingAccount);
var_dump($checkingAccount);

//Realiza um Saque de Conta Corrente e exibe as informações da Conta após a Transação
$cashMachine->withdraw($amount2, $checkingAccount);
var_dump($checkingAccount);

//Realiza um Saque de Conta Poupança e exibe as informações da Conta após a Transação
$cashMachine->withdraw($amount2, $savingsAccount);
var_dump($savingsAccount);

//Realiza um Transferência de uma Conta Poupança para uma Conta Corrente
// Após, exibe as informações das Contas após a Transação
$cashMachine->transfer($amount1, $savingsAccount, $checkingAccount);
var_dump($checkingAccount);
var_dump($savingsAccount);

unset(
    $checkingAccountNumber,
    $checkingAccountBalance,
    $checkingAccount,
    $savingsAccountNumber,
    $savingsAccountBalance,
    $savingsAccount,
    $amount1,
    $amount2,
    $amount3,
    $cashMachine
);