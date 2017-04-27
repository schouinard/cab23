@extends('layouts.adminlte')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Fiche bénévole - {{ $benevole->prenom }} &nbsp; {{ $benevole->nom }}</h1>
@stop

@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Identification</h3>
            <div class="box-tools pull-right">
                <!-- This will cause the box to collapse when clicked -->
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                    <i class="fa fa-minus"></i>
                </button>
            </div><!-- /.box-tools -->
        </div><!-- /.box-header -->
        <div class="box-body">
            {{ $benevole->telephone }}
        </div><!-- /.box-body -->
        <div class="box-footer">

        </div><!-- box-footer -->
    </div><!-- /.box -->
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Services rendus</h3>
            <div class="box-tools pull-right">
                <!-- This will cause the box to collapse when clicked -->
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                    <i class="fa fa-minus"></i>
                </button>
            </div><!-- /.box-tools -->
        </div><!-- /.box-header -->
        <div class="box-body">
            <table class="table table-hover table-bordered datatable">
                <thead>
                <tr>
                    <td>Type</td>
                    <td>Bénéficiaire</td>
                    <td>Rendu le</td>
                    <td>Don</td>
                </tr>
                </thead>
                <tbody>
                @foreach ($benevole->services as $service)
                    <tr>
                        <td>
                            {{ $service->type->nom }}
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
        </div><!-- /.box-body -->
        <div class="box-footer">
            <table class="table table-bordered">
                <form method="POST" action="{{ $benevole->path() . '/services' }}">
                    {{ csrf_field() }}
                    <input type="hidden" name="benevole_id" id="benevole_id" value="{{ $benevole->id }}"/>
                    <input type="hidden" name="beneficiaire_id" id="beneficiaire_id">
                    <tr>
                        <td>
                            {{ Form::select('service_type_id', \App\ServiceType::pluck('nom', 'id'),null, ['class' => 'form-control']) }}
                        </td>
                        <td><input type="text" class="form-control autocomplete" data-model="beneficiaire"
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
                </form>
            </table>
        </div><!-- box-footer -->
    </div><!-- /.box -->
@stop