<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaAtencion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('atencion', function (Blueprint $table) {
            
            $table->increments('ate_id');
            $table->integer('ate_cod');
            $table->dateTime('ate_fecha');
            $table->string('ate_turno',10);
            $table->integer('ate_numatencion');
            $table->string('ate_descripcion',200);

            //primari key
            $table->integer('pa_cod');
            $table->integer('area_cod');
            $table->integer('med_usu_cod');

            //campos de auditoria 
            $table->integer('ca_usu_cod');
            $table->string('ca_tipo',10);
            $table->dateTime('ca_fecha');
            $table->integer('ca_estado');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('atencion');
    }
}
