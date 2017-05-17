<?php
$attributes = ["class" => "form-control"];
if ($readonly) {
    array_push($attributes, 'disabled');
}
?>

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
    @include('partials.form.contact', ['adress' => 'adress', 'readonly' => $readonly, 'model' => $organisme->adress])
</div>