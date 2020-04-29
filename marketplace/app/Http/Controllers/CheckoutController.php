<?php

namespace App\Http\Controllers;

use App\Payment\PagSeguro\CreditCard;
use App\Payment\PagSeguro\Notification;
use Illuminate\Http\Request;
use App\Store;
use App\UserOrders;
use Ramsey\Uuid\Uuid;

class CheckoutController extends Controller
{
    public function index()
    {
        // verifica se usuário não está logado
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        if (!session()->has('cart')) {
            return redirect()->route('home');
        }

        // inclui sessão do PagSeguro na nossa sessão
        $this->makePagSeguroSession();

        $cartItens = array_map(function ($line) {
            return $line['amount'] * $line['price'];
        }, session()->get('cart'));

        $cartItens = array_sum($cartItens);

        return view('checkout', compact('cartItens'));
    }

    public function proccess(Request $request)
    {
        try {
            // trazendo todos os dados vindo da requisição
            $dataPost = $request->all();
            $user = auth()->user();
            $cartItens = session()->get('cart');
            $stores = array_unique(array_column($cartItens, 'store_id'));
            $reference = Uuid::uuid4();

            $creditCardPayment = new CreditCard($cartItens, $user, $dataPost, $reference);

            $result = $creditCardPayment->doPayment();

            $userOrder = [
                'reference' => $reference,
                'pagseguro_code' => $result->getCode(),
                'pagseguro_status' => $result->getStatus(),
                'items' => serialize($cartItens)
            ];

            $userOrder = $user->orders()->create($userOrder);
            $userOrder->stores()->sync($stores);

            // Notificar loja de novo pedido
            $store = (new Store())->nofityStoreOwners($stores);

            // após criado o pedido, remover da sessão
            session()->forget('cart');
            session()->forget('pagseguro_session_code');

            return response()->json([
                'data' => [
                    'status' => true,
                    'message' => 'Pedido criado com sucesso!',
                    'order' => $reference,
                ],
            ]);
        } catch (\Exception $e) {
            // se estiver em ambiente de desenvolvimento mostrará mensagem real
            $message = env('APP_DEBUG') ? $e->getMessage() : 'Erro ao processar o pedido';
            return response()->json([
                'data' => [
                    'status' => false,
                    'message' => $message,
                ],
            ], 401);
        }
    }

    public function thanks()
    {
        return view('thanks');
    }

    public function notification()
    {
        try {
            $notification = new Notification();
            $notification = $notification->getTransaction();

            // PESQUISAR BASE64_ENCODE + DECODE
            $reference = base64_decode($notification->getReference());
            // atualizar pedido do usuário
            $userOrder = UserOrders::whereReference($reference);
            $userOrder->update([
                'pagseguro_status' => $notification->getStatus()
            ]);

            if ($notification->getStatus() == 3) {
                // notificar loja sobre pagamento aprovado p/ liberação do produto p/ usuário
                // atualizar status do pedido p/ "em separação" (SE PRODUTO FÍSICO)
                // notificar usuário que o pedido foi pago
            }

            return response()->json([], 204);
        } catch (\Exception $e) {
            // quando em desenvolvimento, mostra mensagem real do erro
            $message = env('APP_DEBUG') ? $e->getMessage() : [''];
            return response()->json(['error' => $message], 500);
        }
    }

    private function makePagSeguroSession()
    {
        // criando sessão do PagSeguro -> verifica se não existe sessão iniciada, e cria uma
        if (!session()->has('pagseguro_session_code')) {
            $sessionCode = \PagSeguro\Services\Session::create(
                \PagSeguro\Configuration\Configure::getAccountCredentials()
            );
            return session()->put('pagseguro_session_code', $sessionCode->getResult());
        }
    }
}
