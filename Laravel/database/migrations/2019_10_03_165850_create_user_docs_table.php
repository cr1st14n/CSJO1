<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserDocsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_docs', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            
            $table->integer('cod_usu')->nullable();
            $table->integer('ud_certNacimiento')->nullable();
            $table->integer('ud_certProvicion')->nullable();
            $table->integer('ud_factAgua')->nullable();
            $table->integer('ud_factLuz')->nullable();
            $table->integer('ud_crokis')->nullable();
            $table->string('ud_direccinoRespaldo')->nullable();

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
        Schema::dropIfExists('user_docs');
    }
}
