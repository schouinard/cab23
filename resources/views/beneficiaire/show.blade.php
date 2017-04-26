@extends('layouts.adminlte')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Fiche bénéficiaire - {{ $beneficiaire->prenom }} &nbsp; {{ $beneficiaire->nom }}</h1>
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
            {{ $beneficiaire->telephone }}
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
            <table>
                <thead>
                <tr>
                    <td>Type</td>
                    <td>Bénévole</td>
                    <td>Rendu le</td>
                </tr>
                </thead>
                <tbody>
                @foreach ($beneficiaire->services as $service)
                    <tr>
                        <td>
                            {{ $service->service_type_id }}
                        </td>
                        <td>
                            <a href="{{ $service->benevole->path() }}">{{ $service->benevole->nom_complet }}</a>
                        </td>
                        <td>
                            {{ $service->rendu_le }}
                        </td>
                    </tr>
                @endforeach
                <form method="POST" action="{{ $beneficiaire->path() . '/services' }}">
                    <tr>
                        <td><input type="text" class="form-control" placeholder="Type"/></td>
                        <td><input type="text" class="form-control" placeholder="Type"/></td>
                        <td>
                            <div class="input-group date datepicker">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" class="form-control pull-right" >
                            </div>
                        </td>
                    </tr>
                </form>
                </tbody>
            </table>
        </div><!-- /.box-body -->
        <div class="box-footer">

        </div><!-- box-footer -->
    </div><!-- /.box -->
@stop

