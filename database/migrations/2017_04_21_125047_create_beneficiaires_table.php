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
            $table->string('addresse');
            $table->string('ville');
            $table->string('province');
            $table->string('codePostal');
            $table->string('quartier');
            $table->string('conjoint');
            $table->string('telephone');
            $table->string('telephone2');
            $table->date('naissance');
            $table->string('email');
            $table->text('remarque');
            $table->string('resource_nom');
            $table->string('resource_tel_maison');
            $table->string('resource_tel_bureau');
            $table->string('resource_tel_cel');
            $table->string('resource_tel_pager');
            $table->string('resource_email');
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
