<?php

namespace App\Payment\PagSeguro;

class CreditCard
{
    private $items;
    private $user;
    private $cardInfo;
    private $reference;

    public function __construct($items, $user, $cardInfo, $reference)
    {
        $this->items = $items;
        $this->user = $user;
        $this->cardInfo = $cardInfo;
        $this->reference = $reference;
    }

    public function doPayment()
    {
        // chamando do SDK o objeto CreditCard
        $creditCard = new \PagSeguro\Domains\Requests\DirectPayment\CreditCard();

        $creditCard->setReceiverEmail(env('PAGSEGURO_EMAIL'));
        $creditCard->setReference(base64_encode($this->reference));
        $creditCard->setCurrency("BRL");

        // adicionando itens para a solicitação de pagamentos
        foreach ($this->items as $item) {
            $creditCard->addItems()->withParameters(
                $item['id'],
                $item['name'],
                $item['amount'],
                $item['price'],
            );
        }

        // ADICIONANDO DADOS DO COMPRADOR
        $user = $this->user;
        // se tiver em ambiente sandbox usará email sandbox, se não o do usuário mesmo
        $email = env('PAGSEGURO_ENV') == 'sandbox' ? 'test@sandbox.pagseguro.com.br' : $user->email;

        $creditCard->setSender()->setName($user->name);
        
        $creditCard->setSender()->setEmail($email);

        $creditCard->setSender()->setPhone()->withParameters(
            substr($user->mobile_phone, 0, 2),
            substr($user->mobile_phone, 2)
        );
        
        $creditCard->setSender()->setDocument()->withParameters('CPF', $user->cpf);
        
        $creditCard->setSender()->setHash($this->cardInfo['hash']);
        
        $creditCard->setSender()->setIp('127.0.0.0');
        
        $creditCard->setShipping()->setAddress()->withParameters( // depois incluir END p/ user
            $user->address,
            $user->number,
            $user->neighborhood,
            $user->cep,
            $user->city,
            $user->uf,
            'BRA',
            $user->complement
        );
        
        $creditCard->setBilling()->setAddress()->withParameters( //  depois incluir END p/ user
            $user->address,
            $user->number,
            $user->neighborhood,
            $user->cep,
            $user->city,
            $user->uf,
            'BRA',
            $user->complement
        );
        
        $creditCard->setToken($this->cardInfo['card_token']);
        
        list($quantity, $installmentAmount) = explode('|', $this->cardInfo['installment']);
        $installmentAmount = number_format($installmentAmount, 2, '.', '');
        $creditCard->setInstallment()->withParameters($quantity, $installmentAmount);

        $creditCard->setHolder()->setBirthdate($user->date_birth); // deve ser no formato (DD/MM/YYYY)

        $creditCard->setHolder()->setName($this->cardInfo['card_name']);

        $creditCard->setHolder()->setPhone()->withParameters(
            substr($user->mobile_phone, 0, 2),
            substr($user->mobile_phone, 2)
        );

        $creditCard->setHolder()->setDocument()->withParameters('CPF', $user->cpf);

        $creditCard->setMode('DEFAULT');

        // registrando esse pagamento
        $result = $creditCard->register(
            \PagSeguro\Configuration\Configure::getAccountCredentials()
        );

        return $result;
    }


}
