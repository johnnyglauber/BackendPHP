<?php

namespace Reweb\Job\Backend\Bank;

/**
 * Tratamento de mensagens de retorno ao usuário
 */
class Message
{
    /**
     * Mensagem de sucesso ao realizar depósito bancário
     *
     * @var string
     */
    static public $successfulDeposit = 'Depósito realizado com sucesso.';

    /**
     * Mensagem de sucesso ao realizar saque bancário
     *
     * @var string
     */
    static public $successfulWithdrawal = 'Saque realizado com sucesso.';

    /**
     * Mensagem de sucesso ao realizar transferência bancária
     *
     * @var string
     */
    static public $successfulTransfer = 'Transferência realizada com sucesso.';

    /**
     * Mensagem genérica de erro
     *
     * @var string
     */
    static public $generalError = 'Erro ';

    /**
     * Mensagem genérica de exceção
     *
     * @var string
     */
    static public $generalException = 'Erro ao tentar executar a ação desejada.';

    /**
     * Mensagem genérica de falha ao tentar realizar depósito bancário
     *
     * @var string
     */
    static public $failedDeposit = 'Erro ao tentar realizar depósito.';

    /**
     * Mensagem genérica de falha ao tentar realizar saque bancário
     *
     * @var string
     */
    static public $failedWithdrawal = 'Erro ao tentar realizar saque.';

    /**
     * Mensagem genérica de falha ao tentar realizar transferência bancária
     *
     * @var string
     */
    static public $failedTransfer = 'Erro ao tentar realizar transferência.';

    /**
     * Mensagem de falha por saldo insuficiente ao tentar realizar saque bancário
     *
     * @var string
     */
    static public $unavailableBalance = 'Saldo insuficiente na conta.';

    /**
     * Mensagem de falha por limite excedido ao tentar realizar saque bancário
     *
     * @var string
     */
    static public $exceededLimit = 'Limite excedido por saque.';

    /**
     * Exibe uma mensagem
     *
     * @param mixed $message
     * @return void
     */
    static public function displayMessage($message): void
    {
        echo $message . "\n";
    }
}