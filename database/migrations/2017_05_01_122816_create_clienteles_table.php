<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientelesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clienteles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nom');
            $table->timestamps();
        });

        Schema::create('benevole_clientele', function (Blueprint $table) {
            $table->unsignedInteger('clientele_id')->index();
            $table->unsignedInteger('benevole_id')->index();
            $table->timestamps();
            $table->primary(['clientele_id', 'benevole_id']);
        });

        Artisan::call('db:seed', [
            '--class' => ClientelesSeeder::class,
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clienteles');
        Schema::dropIfExists('benevole_clientele');
    }
}
