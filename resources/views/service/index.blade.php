@extends('layouts.adminlte')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Services rendus</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
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
                                    {{ $service->service_type_id }}
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
                <div class="box-footer table-responsive">
                    <form method="POST" action="/services">
                        <table class="table table-bordered">
                            {{ csrf_field() }}
                            <tr>
                                <td><input name="service_type_id" id="service_type_id" type="text" class="form-control"
                                           placeholder="Type"/></td>
                                <td><input name="benevole_id" id="benevole_id" type="text" class="form-control"
                                           placeholder="Bénévole"/></td>
                                <td><input name="beneficiaire_id" id="beneficiaire_id" type="text" class="form-control"
                                           placeholder="Bénéficiaire"/></td>
                                <td>
                                    <div class="input-group date datepicker">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input name="rendu_le" type="text" class="form-control pull-right"/>
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
@stop