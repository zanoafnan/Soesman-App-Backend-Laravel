<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewKurirTable extends Migration
{
    public function up()
    {
        Schema::create('kurir', function (Blueprint $table) {
            $table->increments('kurir_id');
            $table->string('nama', 50);
            $table->string('no_telp', 50);
            $table->string('alamat', 100)->nullable();
            $table->string('email', 50);
            $table->string('password', 255);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('kurir');
    }
}
