<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // criando factory com fk (each: a cada user criará uma store)
        factory(App\User::class, 20)->create()->each(function($user) {
            $user->store()->save(factory(App\Store::class)->make());
        });
    }
}
