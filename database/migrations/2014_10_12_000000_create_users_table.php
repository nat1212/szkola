<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->integer('email_number')->nullable()->default(1);
            $table->string('password')->nullable()->default(null);
            $table->string('idu_create', 45)->nullable()->default(null);
            $table->string('idu_mod', 45)->nullable()->default(null);
            $table->string('idu_delete', 45)->nullable()->default(null);
            $table->rememberToken();
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable()->default(null);
            $table->timestamp('last_login')->nullable();
            $table->timestamp('last_logout')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
