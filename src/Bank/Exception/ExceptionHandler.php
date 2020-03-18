<?php

namespace Reweb\Job\Backend\Bank\Exception;

use Reweb\Job\Backend\Bank\Message;

/**
 * Tratamento de exceções e erros
 */
class ExceptionHandler extends \Exception
{
    /**
     * Dispara mensagem de erro
     *
     * @param string $message
     * @return void
     */
    public function triggerError($message): void
    {
        set_error_handler(function ($errno, $errstr) {
            echo Message::$generalError . "[$errno]: $errstr". "\n";
            die();
        }, E_USER_WARNING);
        trigger_error($message, E_USER_WARNING);
    }

    /**
     * Define função customizada para tratamento de erros
     *
     * @return void
     */
    public static function setErrorHandler(): void
    {
        set_error_handler(function ($errno, $errstr, $errfile, $errline) {
            throw new \ErrorException($errstr, 0, $errno, $errfile, $errline);
        });
    }

    /**
     * Define função customizada para tratamento de exceções
     * TODO: Implementar log para exibição e registro das exceções do PHP com as mensagens padrão
     *
     * @return void
     */
    public static function setErrorException(): void
    {
        set_exception_handler(function () {
            echo Message::$generalException. "\n";
            die();
        });
    }
}