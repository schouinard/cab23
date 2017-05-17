<?php
$attributes = ["class" => "form-control"];
if ($readonly) {
    array_push($attributes, 'disabled');
}
?>

<div class="form-group col-md-6 {{ $errors->first("people[{$iterator}][nom]", "has-error") }}">
    {{ Form::label("people[{$iterator}][nom]", "Nom:") }}
    {{ Form::text("people[{$iterator}][nom]", $resource->nom, $attributes) }}
</div>
<div class="form-group col-md-6 {{ $errors->first("people[{$iterator}][lien]", "has-error") }}">
    {{ Form::label("people[{$iterator}][lien]", "{$lien}:") }}
    {{ Form::text("people[{$iterator}][lien]", $resource->lien, $attributes) }}
</div>
<div class="col-md-12">
    @include("partials.form.contact", ["adress" => "people[{$iterator}][adress]", "model" => $resource->adress])
</div>