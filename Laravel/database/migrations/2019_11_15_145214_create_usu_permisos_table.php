<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsuPermisosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usu_permisos', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->integer('cod_usu')->nullable();
            $table->string('up_motivo')->nullable();
            $table->string('up_remplazo')->nullable();
            $table->string('up_fechaSolicitud')->nullable();
            $table->string('up_fechaPermiso')->nullable();
            $table->string('up_horaInicio')->nullable();
            $table->string('up_horaFinal')->nullable();
            $table->string('up_codRespaldoDoc')->nullable();

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
        Schema::dropIfExists('usu_permisos');
    }
}
