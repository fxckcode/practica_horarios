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
        Schema::create('personas', function (Blueprint $table) {
            $table->increments('id_persona')->unsigned(false);
            $table->string('identificacion');
            $table->string('nombres');
            $table->string('email')->nullable();
            $table->string('telefono')->nullable();
            $table->enum('rol', ['instructor', 'instructor lider', 'coordinador']);
            $table->enum('cargo', ['instructor', 'instructor lider', 'coordinador']);
            $table->integer('fk_municipio')->unsigned(false)->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('personas');
    }
};
