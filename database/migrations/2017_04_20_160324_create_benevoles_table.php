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
            $table->string('addresse');
            $table->string('ville');
            $table->string('province');
            $table->string('codePostal');
            $table->string('quartier');
            $table->string('telephone');
            $table->string('telephone2');
            $table->date('naissance');
            $table->date('inscription');
            $table->date('accepte_ca');
            $table->text('remarque');
            $table->string('email');
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
        Schema::dropIfExists('benevoles');
    }
}
