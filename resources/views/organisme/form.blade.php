@php
    $attributes = ["class" => "form-control"];
    if (isset($readonly)) {
        array_push($attributes, 'disabled');
    }
@endphp

@if (count($errors))
    <div class="callout callout-danger">
        <h4>Veuillez valider les points suivants avant de continuer.</h4>
        <ul class="error-content">
            @foreach ($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="nav-tabs-custom">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#identification" data-toggle="tab" aria-expanded="true">Identification</a></li>
        <li><a href="#details" data-toggle="tab" aria-expanded="false">Détails</a></li>
        <li class=""><a href="#contacts" data-toggle="tab" aria-expanded="false">Contacts</a></li>
        @if(isset($readonly))
            <li><a href="#notes" data-toggle="tab" aria-expanded="false">Notes</a></li>
        @endif
    </ul>
    <div class="tab-content">
        <div class="tab-pane active row" id="identification">
            <!--- nom form input ---->
            <div class="form-group col-md-6 {{ $errors->first('nom', 'has-error') }}">
                {{ Form::label('nom', 'Nom de l\'organisme:') }}
                {{ Form::text('nom', null, $attributes) }}
            </div>

            <div class="col-md-12">
                @include('partials.form.contact')
            </div>
        </div>
        <div class="tab-pane" id="details">
            <div class="form-group">
                {{ Form::label('mission_id', 'Mission:') }}
                {{ Form::select('mission_id', $mission->pluck("nom", "id"), null, $attributes) }}
            </div>
            <div class="form-group">
                {{ Form::label('mission_desc', 'Description:') }}
                {!! Form::textarea('mission_desc', null, ['class' => 'form-control textarea', 'row' => '20'])  !!}
            </div>
            <!--- organisme_type_id form input ---->
            <div class="form-group {{ $errors->first('organisme_type_id', 'has-error') }}">
                {{ Form::label('type_id', 'Type:') }}
                {{ Form::select('type_id', $type->pluck("nom", "id"), null, $attributes) }}
            </div>
            <fieldset @if(isset($readonly)) disabled @endif>
                <legend>Regroupement:</legend>
                @foreach($regroupement as $groupe)
                    <div class="checkbox">
                        <label>{{Form::checkbox('regroupements[]', $groupe->id)}}{{ $groupe->nom }}</label>
                    </div>
                @endforeach
            </fieldset>
        </div>
        <div class="tab-pane" id="contacts">

            @for($i = 0; $i < 3; $i++)
                <h3>Personne ressource {{$i + 1}}</h3>
                <div class="row">
                    @include('partials.form.resource', ['resource' => isset($organisme->people[$i]) ? $organisme->people[$i] : new \App\Person(), 'iterator' => $i, 'lien' => 'Lien'])
                </div>
            @endfor

        </div>
        @if(isset($readonly))
            <div class="tab-pane" id="notes">
                @component('components.note', ['notableId' => $organisme->id, 'notableType' => \App\Organisme::class])
                @endcomponent
                @foreach($organisme->notes as $note)
                    @include('partials.show.notes', ['note' => $note])
                @endforeach
            </div>
        @endif
    </div>
</div>
@if(!isset($readonly))
    <button type="submit" class="btn btn-primary">Enregistrer</button>
@endif





