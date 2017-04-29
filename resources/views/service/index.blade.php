@extends('layouts.adminlte')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Services rendus</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3>Ajouter un nouveau service rendu</h3>
                </div>
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
                <div class="box-body">
                    <table class="table table-bordered">
                        <form method="POST" action="/services">
                            {{ csrf_field() }}
                            {{ Form::hidden('beneficiaire_id', null , ['id' => 'beneficiaire_id']) }}
                            {{ Form::hidden('benevole_id', null, ['id' => 'benevole_id']) }}
                            <tr>
                                <td class="{{ $errors->first('service_type_id', 'has-error') }}">
                                    {{ Form::select('service_type_id', $serviceTypes->pluck('nom', 'id'),null, ['class' => 'form-control', 'required' => 'required']) }}
                                </td>
                                <td class="{{ $errors->first('benevole_id', 'has-error') }}">
                                    {{ Form::text('benevole', null, ['class' => 'form-control autocomplete',
                                        'data-model' => 'benevole',
                                        'data-display' => 'nom_complet',
                                        'placeholder' => 'Bénévole',
                                        'required' => 'required',
                                        ]) }}
                                </td>
                                <td class="{{ $errors->first('beneficiaire_id', 'has-error') }}">{{ Form::text('beneficiaire', null, ['class' => 'form-control autocomplete',
                                'data-model' => 'beneficiaire',
                                'data-display' => 'nom_complet',
                                'placeholder' => 'Bénéficiaire',
                                'required' => 'required',
                                ]) }}
                                </td>
                                <td>
                                    <div class="input-group date datepicker {{ $errors->first('rendu_le', 'has-error') }}">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        {{Form::text('rendu_le', Carbon\Carbon::today()->toDateString(), ['class' => 'form-control pull-right', 'required' => 'required'])}}
                                    </div>
                                </td>
                                <td class="{{ $errors->first('don', 'has-error') }}">
                                    {{ Form::text('don', null, ['class' => 'form-control']) }}
                                </td>
                                <td>
                                    <button type="submit" class="btn btn-primary">Ajouter</button>
                                </td>
                            </tr>
                        </form>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3>Liste des derniers services entrés</h3>
                </div>
                <div class="box-body table-responsive">
                    <header>
                        <h4>Filtres</h4>
                        <div class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                               aria-haspopup="true" aria-expanded="false">Type</a>
                            <ul class="dropdown-menu">
                                @foreach($serviceTypes as $service)
                                    <li>
                                        <a href="/services?type={{$service->id}}">{{$service->nom}}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </header>
                    <table class="datatable table table-hover table-bordered">
                        <thead>
                        <tr>
                            <td>Type</td>
                            <td>Bénévole</td>
                            <td>Bénéficiaire</td>
                            <td>Rendu le</td>
                            <td>Don</td>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($services as $service)
                            <tr>
                                <td>
                                    {{ $service->type->nom }}
                                </td>
                                <td>
                                    <a href="{{$service->benevole->path()}}">{{$service->benevole->nom_complet}}</a>
                                </td>
                                <td>
                                    <a href="{{ $service->beneficiaire->path() }}">{{ $service->beneficiaire->nom_complet }}</a>
                                </td>
                                <td>
                                    {{ $service->rendu_le }}
                                </td>
                                <td>{{ $service->don }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="box-footer">
                </div>
            </div>
        </div>
    </div>
@stop