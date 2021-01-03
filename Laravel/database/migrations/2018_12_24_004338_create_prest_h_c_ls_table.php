<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrestHCLsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('presthcl', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->string('cod_hcl');
            $table->string('prest_usuEntrega');
            $table->string('prest_area',100);
            $table->integer('prest_estado');
            $table->integer('prest_dias');
            $table->dateTime('prest_fechaEntrega');


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
        Schema::dropIfExists('presthcl');
    }
}
