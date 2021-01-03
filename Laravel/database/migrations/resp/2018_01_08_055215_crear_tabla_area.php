<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaArea extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('area', function (Blueprint $table) {
            $table->increments('area_id');
            $table->integer('area_cod');
            $table->string('area_nombre',50);
            $table->string('area_tipo',50);
            $table->string('area_descripcion',200);
            //campos de auditoria
            $table->integer('ca_usu_cod');
            $table->string('ca_tipo',20);
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
        Schema::drop('area');
    }
}
