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
                    <form method="POST" action="/services">
                        <input type="hidden" name="benevole_id" id="benevole_id">
                        <input type="hidden" name="beneficiaire_id" id="beneficiaire_id">
                        <table class="table table-bordered">
                            {{ csrf_field() }}
                            <tr>
                                <td>{{ Form::select('service_type_id', \App\ServiceType::pluck('nom', 'id'),null, ['class' => 'form-control']) }}
                                </td>
                                <td><input type="text" class="form-control autocomplete"
                                           data-model="benevole"
                                           data-display="nom_complet"
                                           placeholder="Bénévole"/></td>
                                <td><input type="text" class="form-control autocomplete"
                                           data-model="beneficiaire"
                                           data-display="nom_complet"
                                           placeholder="Bénéficiaire"/></td>
                                <td>
                                    <div class="input-group date datepicker">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        {{Form::text('rendu_le', Carbon\Carbon::today()->toDateString(), ['class' => 'form-control pull-right'])}}
                                    </div>
                                </td>
                                <td>
                                    <input name="don" type="text" class="form-control"/>
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
                    <h3>Liste des derniers services entrés</h3>
                </div>
                <div class="box-body table-responsive">

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