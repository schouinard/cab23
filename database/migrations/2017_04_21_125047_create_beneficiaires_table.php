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
            $table->string('conjoint')->nullable();
            $table->date('naissance')->nullable();
            $table->unsignedInteger('adress_id')->nullable();
            $table->unsignedInteger('facturation_id')->nullable();
            $table->text('remarque')->nullable();

            // statut
            $table->string('residence')->nullable();
            $table->string('occupation')->nullable();
            $table->date('evaluation_domicile')->nullable();
            $table->date('premiere_demande')->nullable();
            $table->unsignedInteger('income_source_id')->nullable();
            $table->boolean('contribution_volontaire')->default(false);
            $table->boolean('visite_medicale')->default(false);
            $table->boolean('gratuite')->default(false);
            $table->boolean('accepte_sollicitation')->default(false);
            $table->string('securite_sociale')->nullable();
            $table->string('curateur_public')->nullable();
            $table->string('autre_revenu')->nullable();

            // etat de sante
            $table->text('etat_sante_autre')->nullable();
            $table->text('autonomie_autre')->nullable();
            $table->text('support_familial')->nullable();

            // facturation
            $table->string('facturation_nom')->nullable();

            // popotte roulante
            $table->unsignedInteger('tournee_id')->nullable();
            $table->unsignedInteger('tournee_priorite')->nullable()->index();
            $table->boolean('tournee_payee')->nullable()->default(0);
            $table->text('tournee_note')->nullable();

            $table->timestamps();
            $table->softDeletes();
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
