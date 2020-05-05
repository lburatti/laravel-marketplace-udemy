<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user1 = User::create([
            'name' => 'João dos Santos',
            'cpf' => '55544433322',
            'date_birth' => '01/02/1970',
            'email' => 'joaodossantos@email.com',
            'email_verified_at' => now(),
            'password' => password_hash('12345678', PASSWORD_BCRYPT),
            'remember_token' => Str::random(10),
            'profile' => 'PROFILE_USER',
            'mobile_phone' => '11988889999',
            'cep' => '01501-000',
            'address' => 'Rua XYZ',
            'number' => '200',
            'complement' => 'Casa',
            'city' => 'São Paulo',
            'uf' => 'SP'
        ]);

        $user2 = User::create([
            'name' => 'Maria Aparecida da Silva',
            'cpf' => '44455566677',
            'date_birth' => '10/05/1970',
            'email' => 'mariaaparecida@email.com',
            'email_verified_at' => now(),
            'password' => password_hash('12345678', PASSWORD_BCRYPT),
            'remember_token' => Str::random(10),
            'profile' => 'PROFILE_USER',
            'mobile_phone' => '11989898989',
            'cep' => '01500-000',
            'address' => 'Rua dos Jardins',
            'number' => '2500',
            'complement' => 'Apto 125',
            'city' => 'São Paulo',
            'uf' => 'SP'
        ]);

        $user3 = User::create([
            'name' => 'José da Costa',
            'cpf' => '11122233344',
            'date_birth' => '19/10/1970',
            'email' => 'josecosta@email.com',
            'email_verified_at' => now(),
            'password' => password_hash('12345678', PASSWORD_BCRYPT),
            'remember_token' => Str::random(10),
            'profile' => 'PROFILE_STORE',
            'mobile_phone' => '11977778888',
            'cep' => '01530-000',
            'address' => 'Rua do Comércio',
            'number' => '2210',
            'complement' => 'Loja 02',
            'city' => 'São Paulo',
            'uf' => 'SP'
        ]);

        $user4 = User::create([
            'name' => 'Luana Barbosa',
            'cpf' => '22233344455',
            'date_birth' => '25/12/1980',
            'email' => 'luanabarbosa@email.com',
            'email_verified_at' => now(),
            'password' => password_hash('12345678', PASSWORD_BCRYPT),
            'remember_token' => Str::random(10),
            'profile' => 'PROFILE_STORE',
            'mobile_phone' => '11995959595',
            'cep' => '01836-000',
            'address' => 'Rua das Rosas',
            'number' => '610',
            'city' => 'São Paulo',
            'uf' => 'SP'
        ]);

        $user5 = User::create([
            'name' => 'Joaquim da Silva',
            'cpf' => '66655544433',
            'date_birth' => '22/02/1978',
            'email' => 'joaquimsilva@email.com',
            'email_verified_at' => now(),
            'password' => password_hash('12345678', PASSWORD_BCRYPT),
            'remember_token' => Str::random(10),
            'profile' => 'PROFILE_USER',
            'mobile_phone' => '11955665566',
            'cep' => '01521-000',
            'address' => 'Rua XPTO',
            'number' => '190',
            'complement' => 'Casa',
            'city' => 'São Paulo',
            'uf' => 'SP'
        ]);

        $user6 = User::create([
            'name' => 'Jaqueline Souza',
            'cpf' => '11144466688',
            'date_birth' => '20/12/1983',
            'email' => 'jaquelinesouza@email.com',
            'email_verified_at' => now(),
            'password' => password_hash('12345678', PASSWORD_BCRYPT),
            'remember_token' => Str::random(10),
            'profile' => 'PROFILE_STORE',
            'mobile_phone' => '11988779988',
            'cep' => '01836-002',
            'address' => 'Rua das Pedras',
            'number' => '1230',
            'city' => 'São Paulo',
            'uf' => 'SP'
        ]);

        // criando factory com fk (each: a cada user criará uma store)
        // factory(App\User::class, 10)->create()->each(function($user) {
        //     $user->store()->save(factory(App\Store::class)->make());
        // });
    }
}
