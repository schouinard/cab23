<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEtatSantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('etat_santes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nom');
            $table->timestamps();
        });

        Schema::create('beneficiaire_etat_sante', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('beneficiaire_id');
            $table->unsignedInteger('etat_sante_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('etat_santes');
        Schema::dropIfExists('beneficiaire_etat_sante');
    }
}
