<?php

namespace App\Payment\PagSeguro;

class Notification
{
    public function getTransaction()
    {
        // verifica se é uma requisição POST
        if (!\PagSeguro\Helpers\Xhr::hasPost()) {
            throw new \InvalidArgumentException($_POST);
        }

        $response = \PagSeguro\Services\Transactions\Notification::check(
            \PagSeguro\Configuration\Configure::getAccountCredentials()
        );

        // através do response conseguimos pegar o code, status...
        return $response;
    }
}
