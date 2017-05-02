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
            <div class="level">
                <strong>Nom:</strong>&nbsp;{{ $profileUser->name }}
            </div>
            <div class="level">
                <strong>Courriel:</strong>&nbsp;{{ $profileUser->email }}
            </div>
            <div class="level">
                <strong>Rôle:</strong>&nbsp;{{ $profileUser->isAdmin ? 'Administrateur' : 'Accueil' }}
            </div>
        </div><!-- /.box-body -->
        <div class="box-footer">

        </div><!-- box-footer -->
    </div><!-- /.box -->
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">
                Activité
            </h3>
            <div class="box-tools pull-right">
                <!-- This will cause the box to collapse when clicked -->
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                    <i class="fa fa-minus"></i>
                </button>
            </div><!-- /.box-tools -->
        </div>
        <div class="box-body">
            <ul class="timeline timeline-inverse">
                @foreach($activities as $date => $records)
                    <li class="time-label">
                        <span class="bg-blue">{{$date}}</span>
                    </li>
                    @foreach($records as $record)
                        @include("users.activities.{$record->type}")
                    @endforeach
                @endforeach
                <li>
                    <i class="fa fa-clock-o bg-gray"></i>
                </li>
            </ul>
        </div>
    </div>

@stop