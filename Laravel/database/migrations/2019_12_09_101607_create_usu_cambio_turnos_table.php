<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsuCambioTurnosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usu_cambio_turnos', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->integer('cod_usu')->nullable();
            $table->integer('cod_usu2')->nullable();
            $table->integer('uct_codDoc')->nullable();
            $table->string('uct_motivo')->nullable();
            $table->date('uct_fecha')->nullable();
            $table->string('uct_horario')->nullable();

             //campos de auditoria 
             $table->integer('ca_usu_cod')->nullable();
             $table->string('ca_tipo', 10)->nullable();
             $table->dateTime('ca_fecha')->nullable();
             $table->integer('ca_estado')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usu_cambio_turnos');
    }
}
