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
        Schema::create('ambientes', function (Blueprint $table) {
            $table->increments('id_ambiente')->unsigned(false);
            $table->string('nombre_amb');
            $table->integer('fk_municipio')->index();
            $table->enum('sede', ['centro', 'yamboro']);
            $table->enum('estado', ['activo', 'inactivo']);
            $table->foreign('fk_municipio')->references('id_municipio')->on('municipios');
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
        Schema::dropIfExists('ambientes');
    }
};
