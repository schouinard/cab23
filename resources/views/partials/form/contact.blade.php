<?php
$attributes = ["class" => "form-control"];
if ($readonly) {
    array_push($attributes, 'disabled');
}
?>

<div class="row">
    <!--- adresse form input ---->
    <div class="form-group col-md-8 {{ $errors->first("{$adress}.adresse", "has-error") }}">
        {{ Form::label("{$adress}[adresse]", "Adresse (*):") }}
        {{ Form::text("{$adress}[adresse]", $model->adresse, $attributes) }}
    </div>
    <!--- ville form input ---->
    <div class="form-group col-md-4 {{ $errors->first($adress . ".ville", "has-error") }}">
        {{ Form::label("{$adress}[ville]", "Ville (*):") }}
        {{ Form::text("{$adress}[ville]", $model->ville, $attributes) }}
    </div>
</div>
<div class="row">
    <!--- secteur form input ---->
    <div class="form-group col-md-4 {{ $errors->first("{$adress}.secteur_id", "has-error") }}">
        {{ Form::label("{$adress}[secteur_id]", "Secteur:") }}
        {{ Form::select("{$adress}[secteur_id]", $secteurs->pluck("nom", "id"), $model->secteur_id, array_merge($attributes, ['placeholder' => ''])) }}
    </div>
    <!--- province form input ---->
    <div class="form-group col-md-4 {{ $errors->first("{$adress}.province", "has-error") }}">
        {{ Form::label("{$adress}[province]", "Province (*):") }}
        {{ Form::text("{$adress}[province]", $model->province, $attributes) }}
    </div>
    <!--- code_postal form input ---->
    <div class="form-group col-md-4 {{ $errors->first("{$adress}.code_postal", "has-error") }}">
        {{ Form::label("{$adress}[code_postal]", "Code postal (*):") }}
        {{ Form::text("{$adress}[code_postal]", $model->code_postal, $attributes) }}
    </div>
</div>
<div class="row">
    <!--- telephone form input ---->
    <div class="form-group col-md-6">
        {{ Form::label("{$adress}[telephone]", "Téléphone:") }}
        <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-phone"></i></span>
            {{ Form::text("{$adress}[telephone]", $model->telephone, $attributes) }}
        </div>
    </div>
    <!--- telephone2 form input ---->
    <div class="form-group col-md-6 {{ $errors->first("{$adress}.telephone2", "has-error") }}">
        {{ Form::label("{$adress}[telephone2]", "Autre téléphone:") }}
        <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-phone"></i></span>
            {{ Form::text("{$adress}[telephone2]", $model->telephone2, $attributes) }}
        </div>
    </div>
</div>
<div class="row">
    <!--- cellulaire form input ---->
    <div class="form-group col-md-6">
        <label for="{$adress}[cellulaire]">Cellulaire:</label>
        <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-mobile-phone"></i></span>
            {{ Form::text("{$adress}[cellulaire]", $model->cellulaire, $attributes) }}
        </div>
    </div>
    <!--- email form input ---->
    <div class="form-group col-md-6 {{ $errors->first("{$adress}.email", "has-error") }}">
        <label for="{$adress}[email]">Courriel:</label>
        <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
            {{ Form::text("{$adress}[email]", $model->email, $attributes) }}
        </div>
    </div>
</div>