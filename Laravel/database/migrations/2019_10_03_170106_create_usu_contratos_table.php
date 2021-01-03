<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsuContratosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usu_contratos', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            
            $table->integer('cod_usu')->nullable();
            $table->date('uc_fechaInicio')->nullable();
            $table->date('uc_fechafinal')->nullable();
            $table->integer('uc_nroContrato')->nullable();
            $table->string('uc_tipoContrato')->nullable();
            $table->string('uc_estado')->nullable();
            $table->string('uc_area')->nullable();
            $table->string('uc_cargoDesignado')->nullable();


             //campos de auditoria 
             $table->integer('ca_usu_cod')->nullable();
             $table->string('ca_tipo',10)->nullable();
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
        Schema::dropIfExists('usu_contratos');
    }
}
