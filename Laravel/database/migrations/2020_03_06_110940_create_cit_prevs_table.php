<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCitPrevsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cit_prevs', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->string('pa_id', 20);
            $table->integer('ate_especialidad');
            $table->string('ate_procedimiento', 50);
            $table->string('ate_med', 50);
            $table->string('ate_descripcion', 200)->nullable();
            $table->string('ate_turno', 10);
            $table->integer('ate_num_ticked');
            $table->datetime('ate_fecha');

            //campos de auditoria 
            $table->integer('ca_usu_id')->nullable();
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
        Schema::dropIfExists('cit_prevs');
    }
}
