<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
           
            $table->integer('usu_cod')->nullable();
            $table->integer('usu_ci')->nullable();
            $table->string('usu_nombre',50)->nullable();
            $table->string('usu_appaterno',50)->nullable();
            $table->string('usu_apmaterno',50)->nullable();
            $table->string('usu_sexo',10)->nullable();
            $table->date('usu_fechnac')->nullable();
            $table->string('usu_paisnac',50)->nullable();
            $table->string('usu_depnac',50)->nullable();
            $table->string('usu_estadocivil',10)->nullable();
            $table->integer('usu_telf')->nullable();
            $table->integer('usu_telfref')->nullable();
            $table->string('usu_zona',50)->nullable();
            $table->string('usu_domicilio',200)->nullable();

            //datos de area
            $table->string('usu_tipo',20)->nullable();
            $table->string('usu_area',20)->nullable();
            $table->string('usu_cargo',20)->nullable();
            $table->string('usu_contrato',20)->nullable();
            $table->string('usu_especialidad',50)->nullable();
            
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
        Schema::table('users',function(Blueprint $table){
            

            
            $table->dropColumn('usu_cod');
            $table->dropColumn('usu_ci');
            $table->dropColumn('usu_nombre');
            $table->dropColumn('usu_appaterno');
            $table->dropColumn('usu_apmaterno');
            $table->dropColumn('usu_sexo');
            $table->dropColumn('usu_fechnac');
            $table->dropColumn('usu_paisnac');
            $table->dropColumn('usu_depnac');
            $table->dropColumn('usu_estadocivil');
            $table->dropColumn('usu_telf');
            $table->dropColumn('usu_telfref');
            $table->dropColumn('usu_zona');
            $table->dropColumn('usu_domicilio');

            //datos de area
            $table->dropColumn('usu_tipo');
            $table->dropColumn('usu_area');
            $table->dropColumn('usu_cargo');
            $table->dropColumn('usu_contrato');
            $table->dropColumn('usu_especialidad');
            
             //campos de auditoria 
            $table->dropColumn('ca_usu_cod');
            $table->dropColumn('ca_tipo');
            $table->dropColumn('ca_fecha');
            $table->dropColumn('ca_estado');

        });
    }
}
