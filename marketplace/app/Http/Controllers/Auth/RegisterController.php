<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Mail\UserRegisteredEmail;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    protected $redirectTo = '/admin/stores';

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $request)
    {
        return Validator::make($request, RegisterRequest::$rules);
    }

    protected function create(array $request)
    {
        $user = User::create([
            'name' => $request['name'],
            'cpf' => $request['cpf'],
            'date_birth' => $request['date_birth'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'profile' => 'PROFILE_USER',
            'mobile_phone' => $request['mobile_phone'],
            'cep' => $request['cep'],
            'address' => $request['address'],
            'number' => $request['number'],
            'complement' => $request['complement'],
            'city' => $request['city'],
            'uf' => $request['uf']
        ]);

        flash('Cadastro criado com sucesso')->success();
        return redirect()->route('home');
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
