@extends('layouts.adminlte')

@section('title', 'Profil utilisateur - ' . $profileUser->name)

@section('content_header')
    <h1>Profil utilisateur - {{ $profileUser->name }}</h1>
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
            {{ $profileUser->name }}
        </div><!-- /.box-body -->
        <div class="box-footer">

        </div><!-- box-footer -->
    </div><!-- /.box -->
@stop