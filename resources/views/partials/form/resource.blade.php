{{Form::hidden("people[{$iterator}][id]", $resource->id)}}

<div class="form-group col-md-6 {{ $errors->first("people[{$iterator}][nom]", "has-error") }}">
    {{ Form::label("people[{$iterator}][nom]", "Nom:") }}
    {{ Form::text("people[{$iterator}][nom]", $resource->nom, array_merge($attributes, ["class" => "form-control"])) }}
</div>
<div class="form-group col-md-6 {{ $errors->first("people[{$iterator}][lien]", "has-error") }}">
    {{ Form::label("people[{$iterator}][lien]", "{$lien}:") }}
    {{ Form::text("people[{$iterator}][lien]", $resource->lien, array_merge($attributes, ["class" => "form-control"])) }}
</div>
<div class="col-md-12">
    @include("partials.form.contact", ["adress" => "people[{$iterator}][adress]", "model" => is_null($resource->adress) ? null : $resource->adress ])
</div>