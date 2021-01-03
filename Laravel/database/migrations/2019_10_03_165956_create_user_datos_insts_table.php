<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserDatosInstsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_datos_insts', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            
            $table->integer('cod_usu')->nullable();
            $table->string('di_titulo')->nullable();
            $table->string('di_profecion')->nullable();
            $table->string('di_especialidad')->nullable();
            $table->string('di_seguroNombre')->nullable();
            $table->string('di_seguroNua')->nullable();
            $table->string('di_seguroCns')->nullable();

            $table->integer('ud_carnet')->nullable();
            $table->integer('ud_crokis')->nullable();
            $table->integer('ud_factLuz')->nullable();
            $table->integer('ud_factAgua')->nullable();
            $table->integer('ud_certProvicion')->nullable();
            $table->integer('ud_certNacimiento')->nullable();

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
        Schema::dropIfExists('user_datos_insts');
    }
}
