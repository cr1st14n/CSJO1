<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsuVacacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usu_vacacions', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->integer('cod_usu')->nullable();
            $table->integer('cod_usu2')->nullable();
            $table->date('uv_fechaSoli')->nullable();
            $table->date('uv_fecha1')->nullable();
            $table->date('uv_fecha2')->nullable();
            $table->integer('uv_diasVac')->nullable();
            $table->string('uv_obs')->nullable();
            $table->string('uv_codDocResp')->nullable();

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
        Schema::dropIfExists('usu_vacacions');
    }
}
