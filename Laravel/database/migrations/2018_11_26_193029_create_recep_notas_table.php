<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecepNotasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recep_notas', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->integer('rn_cod_usu');
            $table->dateTime('rn_fecha');
            $table->string('rn_nota');


            //campos de auditoria 
            $table->integer('ca_cod_usu');
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
        Schema::dropIfExists('recep_notas');
    }
}
