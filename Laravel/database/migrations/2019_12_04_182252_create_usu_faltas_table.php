<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsuFaltasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usu_faltas', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->integer('cod_usu')->nullable();
            $table->string('uf_codDoc')->nullable();
            $table->string('uf_motivo')->nullable();
            $table->date('uf_fecha')->nullable();
            $table->string('uf_horario')->nullable();


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
        Schema::dropIfExists('usu_faltas');
    }
}
