<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAutonomiesBeneficiaires extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('autonomie_beneficiaire', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('beneficiaire_id')->index();
            $table->unsignedInteger('autonomie_id')->index();
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
        Schema::dropIfExists('autonomie_beneficiaire');
    }
}
