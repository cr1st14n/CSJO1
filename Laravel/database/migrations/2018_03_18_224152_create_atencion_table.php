<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAtencionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('atencion', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->integer('usu_ci');
            $table->string('ate_cod',20);
            $table->string('pa_hcl',20);
            $table->integer('ate_especialidad');
            $table->string('ate_procedimiento',50);
            $table->string('ate_med',50);
            $table->string('ate_descripcion',200)->nullable();
            $table->string('ate_turno',10);
            $table->integer('ate_num_ticked');
            $table->datetime('ate_fecha');
            $table->string('ate_pago',20);

             //campos de auditoria 
            $table->integer('ca_usu_ci')->nullable();
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
        Schema::dropIfExists('atencion');
    }
}
