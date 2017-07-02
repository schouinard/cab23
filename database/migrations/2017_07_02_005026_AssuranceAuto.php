<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AssuranceAuto extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('benevoles', function (Blueprint $table) {
            $table->string('no_permis')->nullable();
            $table->string('no_police')->nullable();
            $table->date('exp_permis')->nullable();
            $table->date('exp_police')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
