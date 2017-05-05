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
                    <h3 class="box-title">Ajouter un nouveau service rendu</h3>
                    <div class="box-tools pull-right">
                        <!-- This will cause the box to collapse when clicked -->
                        <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                                title="Collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div><!-- /.box-tools -->
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
                    <form method="POST" action="/services">

                        <table class="table table-bordered">
                            {{ csrf_field() }}
                            {{ Form::hidden('beneficiaire_id', null , ['id' => 'beneficiaire_id']) }}
                            {{ Form::hidden('benevole_id', null, ['id' => 'benevole_id']) }}
                            <tr>
                                <td class="{{ $errors->first('service_type_id', 'has-error') }}">
                                    {{ Form::select('service_type_id', $serviceTypes->pluck('nom', 'id'),request('type'), ['class' => 'form-control', 'required' => 'required']) }}
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
                        </table>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Filtres</h3>
                    <div class="box-tools pull-right">
                        <!-- This will cause the box to collapse when clicked -->
                        <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                                title="Collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div><!-- /.box-tools -->
                </div>
                <div class="box-body">
                    <form action="" method="get">
                        <div class="form-group col-md-6">
                            {{ Form::label('type', 'Type de service:') }}
                            {{ Form::select('type', $serviceTypes->pluck('nom', 'id'),request('type'), ['class' => 'form-control', 'placeholder' => 'Tous les types']) }}
                        </div>
                        <div class="form-group col-md-3">
                            {{ Form::label('from', 'De:') }}
                            <div class="input-group date datepicker">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                {{Form::text('from', request('from'), ['class' => 'form-control pull-right'])}}
                            </div>
                        </div>
                        <div class="form-group col-md-3">
                            {{ Form::label('to', 'À:') }}
                            <div class="input-group date datepicker">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                {{Form::text('to', request('to'), ['class' => 'form-control pull-right'])}}
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <input type="submit" class="btn btn-primary" value="Filtrer"/>
                            <a href="/services" class="btn btn-primary">Effacer les filtres</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Liste des services rendus</h3>
                </div>
                <div class="box-body table-responsive">

                    <table class="table table-hover table-bordered services-rendus">
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
                                    <a href="{{$service->benevole->path()}}">{{$service->benevole->nom}}, {{ $service->benevole->prenom }}</a>
                                </td>
                                <td>
                                    <a href="{{ $service->beneficiaire->path() }}">{{ $service->beneficiaire->nom }}, {{ $service->beneficiaire->prenom }}</a>
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