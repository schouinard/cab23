@php
    $attributes = ["class" => "form-control"];
    if (isset($readonly)) {
        array_push($attributes, 'disabled');
    }
@endphp

<div class="box box-primary">
    <div class="box-header">
        <h2 class="box-title">Identification</h2>
    </div>
    <div class="box-body row">
        <!--- nom form input ---->
        <div class="form-group col-md-6 {{ $errors->first('nom', 'has-error') }}">
            {{ Form::label('nom', 'Nom de l\'organisme:') }}
            {{ Form::text('nom', null, $attributes) }}
        </div>
        <!--- organisme_type_id form input ---->
        <div class="form-group col-md-6 {{ $errors->first('organisme_type_id', 'has-error') }}">
            {{ Form::label('type_id', 'Type:') }}
            {{ Form::select('type_id', $type->pluck("nom", "id"), null, $attributes) }}
        </div>
        <div class="col-md-12">
            @include('partials.form.contact')
        </div>
    </div>
</div>

<div class="box box-primary">
    <div class="box-header">
        <h2 class="box-title">Employé</h2>
    </div>
    <div class="box-body row">
        <div class="form-group col-md-6 {{ $errors->first("employe[nom]", "has-error") }}">
            {{ Form::label("employe[nom]", "Nom:") }}
            {{ Form::text("employe[nom]", null, $attributes) }}
        </div>
        {{ Form::hidden('employe[lien]', 'Employé') }}

        <div class="col-md-12">
            @include("partials.form.contact", ["adress" => "employe[adress]"])
        </div>
    </div>
</div>

<div class="box box-primary">
    <div class="box-header">
        <h2 class="box-title">Président</h2>
    </div>
    <div class="box-body row">
        <div class="form-group col-md-6 {{ $errors->first("president[nom]", "has-error") }}">
            {{ Form::label("president[nom]", "Nom:") }}
            {{ Form::text("president[nom]", null, $attributes) }}
        </div>
        {{ Form::hidden('president[lien]', 'Président') }}
        <div class="col-md-12">
            @include("partials.form.contact", ["adress" => "president[adress]"])
        </div>
    </div>
</div>

<div class="form-group">
    {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Créer', ['class' => 'btn btn-primary']) !!}
</div>

