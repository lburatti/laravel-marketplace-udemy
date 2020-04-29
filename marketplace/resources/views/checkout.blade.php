@extends('layouts.front')

@section('stylesheets')
<!-- Toaster CSS -->
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
@endsection

@section('content')

<div class="container">
    <div class="col-md-6">
        <div class="row">
            <h2>Dados para pagamento:</h2>
        </div>
        <div class="row mt-2">
            <form action="" method="POST">
                <div class="row">
                    <div class="col-md-12 form-group">
                        <label for="">Nome no Cartão</label>
                        <input type="text" class="form-control" name="card_name">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 form-group">
                        <label for="">Número do Cartão <span class="brand"></span></label>
                        <input type="text" class="form-control" name="card_number">
                        <input type="hidden" name="card_brand">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label for="">Mês de vencimento</label>
                        <input type="text" class="form-control" name="card_month">
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="">Ano de vencimento</label>
                        <input type="text" class="form-control" name="card_year">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label for="">Código de Segurança</label>
                        <input type="text" class="form-control" name="card_cvv">
                    </div>
                    <div class="col-md-12 installments form-group">

                    </div>
                </div>
                <button class="btn btn-lg btn-success proccessCheckout">Finalizar Pagamento</button>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<!-- lib do PagSeguro para pegar bandeira do cartão -->
<script src="https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js"></script>
<!-- Toaster JS -->
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<!-- pegando id da sessão que está sendo usada -->
<script>
    const sessionId = '{{ session()->get("pagseguro_session_code") }}';
    const urlThanks = '{{ route("checkout.thanks") }}';
    const urlProccess = '{{ route("checkout.proccess") }}';
    const amountTransaction = '{{ $cartItens }}';
    const csrf = '{{ csrf_token() }}';

    PagSeguroDirectPayment.setSessionId(sessionId);
</script>

<script src="{{ asset('js/pagseguro_functions.js') }}"></script>
<script src="{{ asset('js/pagseguro_events.js') }}"></script>

@endsection