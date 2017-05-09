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

    {{ Form::hidden('beneficiaire_id',$beneficiaireId, ['id' => 'beneficiaire_id']) }}
    {{ Form::hidden('benevole_id', $benevoleId, ['id' => 'benevole_id']) }}
    <div class="{{ $errors->first('service_id', 'has-error') }} form-group col-md-4">
        {{ Form::label('services_type_id', 'Type:') }}
        {{ Form::select('service_id', $serviceTypes->pluck('nom', 'id'),null, ['class' => 'form-control', 'required' => 'required']) }}
    </div>
    @if($showBenevole)
        <div class="{{ $errors->first('benevole_id', 'has-error') }} form-group col-md-2">
            {{Form::label('benevole', 'Donné par:')}}
            {{ Form::text('benevole', null, ['class' => 'form-control autocomplete',
                'data-model' => 'benevole',
                'data-display' => 'nom_complet',
                'placeholder' => 'Bénévole',
                'required' => 'required',
                ]) }}
        </div>
    @endif
    @if($showBeneficiaire)
        <div class="{{ $errors->first('beneficiaire_id', 'has-error') }} form-group col-md-2">
            {{Form::label('beneficiaire', 'Reçu par:')}}
            {{ Form::text('beneficiaire', null, ['class' => 'form-control autocomplete',
                                'data-model' => 'beneficiaire',
                                'data-display' => 'nom_complet',
                                'placeholder' => 'Bénéficiaire',
                                'required' => 'required',
                                ]) }}
        </div>
    @endif
    <div>
        <div class="form-group col-md-2 {{ $errors->first('rendu_le', 'has-error') }}">
            {{Form::label('rendu_le', 'Rendu le:')}}
            <div class="input-group date datepicker ">
                <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                </div>
                {{Form::text('rendu_le', Carbon\Carbon::today()->toDateString(), ['class' => 'form-control pull-right', 'required' => 'required'])}}
            </div>
        </div>
    </div>
    <div class="{{ $errors->first('don', 'has-error') }} form-group col-md-2">
        {{Form::label('don', 'Don:')}}
        {{ Form::text('don', null, ['class' => 'form-control']) }}
    </div>
    <div class="col-md-12">
        <button type="submit" class="btn btn-primary">Ajouter</button>
    </div>
</form>