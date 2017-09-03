<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBeneficiaireTourneeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('beneficiaire_tournee', function (Blueprint $table) {
            $table->unsignedInteger('tournee_id');
            $table->unsignedInteger('beneficiaire_id');
            $table->unsignedInteger('priorite')->nullable()->index();
            $table->boolean('payee')->nullable()->default(0);
            $table->text('note')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('beneficiaire_tournee');
    }
}
