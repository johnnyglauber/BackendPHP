<?php

namespace Reweb\Job\Backend\Bank;

/**
 * Configuração de parâmetros do sistema
 * Estas informações poderão vir de uma base de dados numa futura implementação
 */
class Config
{
    /**
     * Taxa para cada saque bancário conforme o tipo da conta bancária
     *
     * @var array
     */
    protected $withdrawalRate = [
        'checkingAccount' => 2.5,
        'savingsAccount' => 0.8,
    ];

    /**
     * Limite máximo para cada saque bancário conforme o tipo da conta bancária
     *
     * @var array
     */
    protected $withdrawalLimit = [
        'checkingAccount' => 600,
        'savingsAccount' => 1000,
    ];
}