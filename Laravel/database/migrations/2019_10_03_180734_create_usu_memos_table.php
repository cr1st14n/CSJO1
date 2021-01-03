<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsuMemosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usu_memos', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('um_usuEncargado')->nullable();
            $table->date('um_fecha')->nullable();
            $table->string('um_motivo')->nullable();
            $table->string('um_codDocRespaldo')->nullable();


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
        Schema::dropIfExists('usu_memos');
    }
}
