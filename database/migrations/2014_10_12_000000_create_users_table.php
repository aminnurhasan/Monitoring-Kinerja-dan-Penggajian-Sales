<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Artisan;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->char('jenisKelamin');
            $table->string('alamat');
            $table->date('tglLahir');
            $table->string('email')->unique();
            $table->string('password');
            $table->integer('gajiPokok')->default(0);
            $table->tinyInteger('role')->nullable();
            $table->string('foto')->nullable();
            $table->boolean('status')->default(1);
            $table->rememberToken();
            $table->timestamps();
        });
        // Artisan::call('db.seed', [
        //     '--class'=>'UserSeerder'
        // ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user');
    }
};
