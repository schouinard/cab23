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
            $table->string('facturation_adresse')->nullable();
            $table->string('facturation_ville')->nullable();
            $table->string('facturation_province')->nullable();
            $table->string('facturation_code_postal')->nullable();
            $table->unsignedInteger('secteur_id')->nullable();
            $table->string('conjoint')->nullable();
            $table->string('telephone')->nullable();
            $table->string('telephone2')->nullable();
            $table->string('cellulaire')->nullable();
            $table->date('naissance')->nullable();
            $table->string('email')->nullable();
            $table->text('remarque')->nullable();
            $table->string('resource_nom')->nullable();
            $table->string('resource_tel_maison')->nullable();
            $table->string('resource_tel_bureau')->nullable();
            $table->string('resource_tel_cel')->nullable();
            $table->string('resource_tel_pager')->nullable();
            $table->string('resource_email')->nullable();
            $table->string('resource_lien')->nullable();
            $table->string('resource2_nom')->nullable();
            $table->string('resource2_tel_maison')->nullable();
            $table->string('resource2_tel_bureau')->nullable();
            $table->string('resource2_tel_cel')->nullable();
            $table->string('resource2_tel_pager')->nullable();
            $table->string('resource2_email')->nullable();
            $table->string('resource2_lien')->nullable();
            $table->string('resource3_nom')->nullable();
            $table->string('resource3_tel_maison')->nullable();
            $table->string('resource3_tel_bureau')->nullable();
            $table->string('resource3_tel_cel')->nullable();
            $table->string('resource3_tel_pager')->nullable();
            $table->string('resource3_email')->nullable();
            $table->string('resource3_lien')->nullable();

            // statut
            $table->string('residence')->nullable();
            $table->string('occupation')->nullable();
            $table->date('evaluation_domicile')->nullable();
            $table->date('premiere_demande')->nullable();
            $table->unsignedInteger('income_source_id');
            $table->boolean('contribution_volontaire')->default(false);
            $table->boolean('visite_medicale')->default(false);
            $table->boolean('gratuite')->default(false);
            $table->boolean('accepte_sollicitation')->default(false);
            $table->string('securite_sociale')->nullable();
            $table->string('curateur_public')->nullable();
            $table->string('autre_revenu')->nullable();

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
