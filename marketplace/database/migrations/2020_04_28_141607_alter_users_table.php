<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('profile')->default('PROFILE_USER');
            $table->string('cpf')->unique()->after('name');
            $table->string('date_birth')->after('cpf');
            $table->string('mobile_phone');
            $table->string('cep');
            $table->string('address');
            $table->string('number');
            $table->string('complement')->nullable();
            $table->string('city');
            $table->string('uf');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('profile');
            $table->dropColumn('cpf');
            $table->dropColumn('date_birth');
            $table->dropColumn('mobile_phone');
            $table->dropColumn('cep');
            $table->dropColumn('address');
            $table->dropColumn('number');
            $table->dropColumn('complement');
            $table->dropColumn('city');
            $table->dropColumn('state');
        });
    }
}
