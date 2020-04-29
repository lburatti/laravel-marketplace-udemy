<h1>Olá, {{ $user->name }}, tudo bem? Esperamos que sim! </h1>

<h3>Obrigada por se cadastrar conosco!</h3>

<p>
    Aproveite sua compras em nosso Marketplace <br>
    Seu email de cadastro é: <strong>{{ $user->email }}</strong> <br>
</p>
<hr>

Email enviado em {{ date('d/m/Y H:i:s') }}

