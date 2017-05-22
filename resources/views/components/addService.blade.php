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
<form method="POST" action="/services">

    {{ csrf_field() }}

    @if($serviceableType == \App\Beneficiaire::class)
        {{ Form::hidden('beneficiaire_id',null, ['id' => 'beneficiaire_id']) }}
    @else
        {{ Form::hidden('organisme_id',null, ['id' => 'organisme_id']) }}
    @endif
    {{ Form::hidden('benevole_id', null, ['id' => 'benevole_id']) }}
    {{ Form::hidden('serviceable_type', $serviceableType) }}
    <div class="{{ $errors->first('service_id', 'has-error') }} form-group col-md-4">
        {{ Form::label('service_type_id', 'Type:') }}
        {{ Form::select('service_type_id', $serviceTypes->pluck('nom', 'id'),null, ['class' => 'form-control', 'required' => 'required']) }}
    </div>
    <div class="{{ $errors->first('benevole_id', 'has-error') }} form-group col-md-2">
        {{Form::label('benevole', 'Donné par:')}}
        {{ Form::text('benevole', null, ['class' => 'form-control autocomplete',
            'data-model' => 'benevole',
            'data-display' => 'nom_complet',
            'placeholder' => 'Bénévole',
            'required' => 'required',
            ]) }}
    </div>
    <div class="{{ $errors->first('serviceable_id', 'has-error') }} form-group col-md-2">
        {{Form::label('serviceable', 'Reçu par:')}}
        {{ Form::text('serviceable', null, ['class' => 'form-control autocomplete',
                            'data-model' => $serviceableType == \App\Beneficiaire::class ? 'beneficiaire' : 'organisme',
                            'data-display' => $serviceableType == \App\Beneficiaire::class ? 'nom_complet' : 'nom',
                            'placeholder' => $serviceableType == \App\Beneficiaire::class ? 'Bénéficiaire' : 'Organisme',
                            'required' => 'required',
                            ]) }}
    </div>
    <div class="form-group col-md-2 {{ $errors->first('rendu_le', 'has-error') }}">
        {{Form::label('rendu_le', 'Rendu le:')}}
        <div class="input-group date datepicker ">
            <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
            </div>
            {{Form::text('rendu_le', Carbon\Carbon::today()->toDateString(), ['class' => 'form-control pull-right', 'required' => 'required'])}}
        </div>
    </div>
    <div class="{{ $errors->first('don', 'has-error') }} form-group col-md-1">
        {{Form::label('don', 'Don:')}}
        {{ Form::text('don', null, ['class' => 'form-control']) }}
    </div>
    <!--- heures form input ---->
    <div class="form-group col-md-1 {{ $errors->first('heures', 'has-error') }}">
        {{ Form::label('heures', 'Durée (h):') }}
        {{ Form::text('heures', null, ['class' => 'form-control']) }}
    </div>
    <div class="col-md-12">
        <button type="submit" class="btn btn-primary">Ajouter</button>
    </div>
</form>