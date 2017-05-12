<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBenevolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('benevoles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('prenom');
            $table->string('nom');
            $table->unsignedInteger('adress_id')->nullable();
            $table->date('naissance')->nullable();
            $table->text('remarque')->nullable();
            $table->text('antecedents')->nullable();
            $table->text('enquete_sociale')->nullable();
            $table->date('inscription')->nullable();
            $table->date('integration')->nullable();
            $table->date('suivi')->nullable();
            $table->date('accepte_ca')->nullable();
            $table->unsignedInteger('benevole_type_id')->index();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('benevoles');
    }
}
