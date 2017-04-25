<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBeneficiairesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('beneficiaires', function (Blueprint $table) {
            $table->increments('id');
            $table->string('prenom');
            $table->string('nom');
            $table->string('adresse');
            $table->string('ville');
            $table->string('province');
            $table->string('code_postal');
            $table->string('quartier')->nullable();
            $table->string('conjoint')->nullable();
            $table->string('telephone')->nullable();
            $table->string('telephone2')->nullable();
            $table->date('naissance')->nullable();
            $table->string('email')->nullable();
            $table->text('remarque')->nullable();
            $table->string('resource_nom')->nullable();
            $table->string('resource_tel_maison')->nullable();
            $table->string('resource_tel_bureau')->nullable();
            $table->string('resource_tel_cel')->nullable();
            $table->string('resource_tel_pager')->nullable();
            $table->string('resource_email')->nullable();
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
        Schema::dropIfExists('beneficiaires');
    }
}
