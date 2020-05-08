<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Hash;
use App\Mail\UserRegisteredEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\User;

class RegisterStoreController extends Controller
{
    public function index()
    {
        return view('register-store');
    }

    public function create(RegisterRequest $request)
    {
        $chars = array(".", "-", "(", ")", " ");

        $store = User::create([
            'name' => $request['name'],
            'cpf' => str_replace($chars, "", $request['cpf']),
            'date_birth' => $request['date_birth'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'profile' => 'PROFILE_STORE',
            'mobile_phone' => str_replace($chars, "", $request['mobile_phone']),
            'cep' => $request['cep'],
            'address' => $request['address'],
            'number' => $request['number'],
            'complement' => $request['complement'],
            'neighborhood' => $request['neighborhood'],
            'city' => $request['city'],
            'uf' => $request['uf']
        ]);

        flash('Cadastro criado com sucesso')->success();
        return redirect('/admin/stores');
    }

    // após registro do usuário, se tiver carrinho de compras -> ir pro checkout
    protected function registered(RegisterRequest $request, $user)
    {
        Mail::to($user->email)->send(new UserRegisteredEmail($user));

        if ($user->profile == 'PROFILE_STORE') {
            return redirect()->route('stores.index');
        }

        if ($user->profile == 'PROFILE_USER' && session()->has('cart')) {
            return redirect()->route('checkout.index');
        } else {
            return redirect()->route('home');
        }

        return null;
    }
}
