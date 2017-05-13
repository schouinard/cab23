<h2><a data-toggle="collapse" data-parent="#ressources" href="#collapse1" aria-expanded="true">Personne ressource
        {{$person}}</a></h2>
<div id="collapse1" class="panel-collapse collapse in" aria-expanded="true">
    <div class="row">
        <!--- resource_nom form input ---->
        <div class="form-group col-md-6 {{ $errors->first("people.person{$person}.nom", "has-error") }}">
            {{ Form::label("people[person{$person}][nom]", "Nom complet:") }}
            {{ Form::text("people[person{$person}][nom]", null, ["class" => "form-control"]) }}
        </div>
        <!--- resource_lien form input ---->
        <div class="form-group col-md-6 {{ $errors->first("people.person{$person}.lien", "has-error") }}">
            {{ Form::label("people[person{$person}][lien]", "Lien:") }}
            {{ Form::text("people[person{$person}][lien]", null, ["class" => "form-control"]) }}
        </div>
    </div>

        @include('partials.form.contact', ['adress'=>"people[person{$person}][adress]"])
</div>