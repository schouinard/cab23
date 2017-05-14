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
                <div class="box-body">
                    @component("components.addService", ['serviceTypes' => $serviceTypes, 'beneficiaireId' => null, 'benevoleId' => null, 'showBenevole' => true, 'showBeneficiaire' =>true])
                    @endcomponent
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
                    <form action="" method="post">
                        {{ method_field('PUT') }}
                        {{ csrf_field() }}
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
                                    <a href="{{$service->benevole->path()}}">{{$service->benevole->nom}}
                                        , {{ $service->benevole->prenom }}</a>
                                </td>
                                <td>
                                    <a href="{{ $service->beneficiaire->path() }}">{{ $service->beneficiaire->nom }}
                                        , {{ $service->beneficiaire->prenom }}</a>
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