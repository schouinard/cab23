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
            $table->string('telephone');
            $table->string('telephone2');
            $table->string('addresse');
            $table->string('ville');
            $table->string('codePostal');
            $table->string('province');
            $table->date('naissance');
            $table->string('email');
            $table->string('contactUrgenceNom');
            $table->string('contactUrgenceTel');
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
