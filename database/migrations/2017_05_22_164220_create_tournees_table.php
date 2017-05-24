<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTourneesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tournees', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nom');
            $table->string('telephone')->nullable();
            $table->timestamps();
        });

        Schema::create('day_tournee', function (Blueprint $table) {
            $table->unsignedInteger('day_id')->index();
            $table->unsignedInteger('tournee_id')->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tournees');
        Schema::dropIfExists('day_tournee');
    }
}
