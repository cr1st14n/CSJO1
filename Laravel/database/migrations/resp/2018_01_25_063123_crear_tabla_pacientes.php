<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaPacientes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pacientes', function (Blueprint $table) {
            
            $table->integer('pa_hcl');
            $table->integer('pa_ci');
            $table->string('pa_nombre',50);
            $table->string('pa_appaterno',50);
            $table->string('pa_apmaterno',50);
            $table->string('pa_sexo',10);
            $table->date('pa_fechnac');
            $table->string('pa_pais_nac',100);
            $table->string('pa_dep_nac',100);
            $table->string('pa_estado_civil',15);
            $table->integer('pa_telf');
            $table->integer('pa_telfref');
            $table->string('pa_zona',50);
            $table->string('pa_direccion',200);
           
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
         Schema::drop('pacientes');
    }
}
