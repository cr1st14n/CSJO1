<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonalSalud extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personalSalud', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->integer('ps_cod')->nullable();
            $table->string('ps_ci',11)->nullable();
            $table->string('ps_nombre',30)->nullable();
            $table->string('ps_appaterno',30)->nullable();
            $table->string('ps_apmaterno',30)->nullable();
            $table->string('ps_sexo',10)->nullable();
            $table->integer('ps_telf')->nullable();
            //datos de area
            $table->string('ps_tipo',20)->nullable();
            $table->string('ps_area',20)->nullable();
            $table->string('ps_especialidad',50)->nullable();
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
        Schema::dropIfExists('personalSalud');
    }
}
