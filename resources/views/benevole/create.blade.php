@extends('layouts.adminlte')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Nouveau Bénévole</h1>
@stop

@section('content')
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
    <form method="POST" action="/benevoles">
        {{ csrf_field() }}
        <div class="row">
            <div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Informations personnelles</h3>
                        <div class="box-tools pull-right">
                            <!-- This will cause the box to collapse when clicked -->
                            <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                                    title="Collapse">
                                <i class="fa fa-minus"></i>
                            </button>
                        </div><!-- /.box-tools -->
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <!--- prenom form input ---->
                        <div class="form-group {{ $errors->first('prenom', 'has-error') }}">
                            {{ Form::label('prenom', 'Prénom (*):') }}
                            {{ Form::text('prenom', null, ['class' => 'form-control']) }}
                        </div>
                        <!--- nom form input ---->
                        <div class="form-group {{ $errors->first('nom', 'has-error') }}">
                            {{ Form::label('nom', 'Nom (*):') }}
                            {{ Form::text('nom', null, ['class' => 'form-control']) }}
                        </div>

                        <!--- naissance datepicker --->
                        <div class="form-group">
                            {{ Form::label('naissance', 'Naissance:') }}
                            <div class="input-group date datepicker-naissance">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                {{ Form::text('naissance', null, ['class' => 'form-control pull-right']) }}
                            </div>
                        </div>

                        <!--- inscription datepicker --->
                        <div class="form-group">
                            {{ Form::label('inscription', 'Inscription:') }}
                            <div class="input-group date datepicker">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                {{ Form::text('inscription', Carbon\Carbon::today()->toDateString(), ['class' => 'form-control pull-right']) }}
                            </div>
                        </div>
                        <!--- accepte_ca datepicker --->
                        <div class="form-group">
                            {{ Form::label('accepte_ca', 'Accepté CA:') }}
                            <div class="input-group date datepicker">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                {{ Form::text('accepte_ca', null, ['class' => 'form-control pull-right']) }}
                            </div>
                        </div>
                    </div><!-- /.box-body -->
                    <div class="box-footer">

                    </div><!-- box-footer -->
                </div><!-- /.box -->
            </div>
            <div class="col-md-6">
                @include('partials.form.contact')
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><label for="remarque">Remarque</label></h3>
                        <div class="box-tools pull-right">
                            <!-- This will cause the box to collapse when clicked -->
                            <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                                    title="Collapse">
                                <i class="fa fa-minus"></i>
                            </button>
                        </div><!-- /.box-tools -->
                    </div>
                    <div class="box-body">
                        <!--- remarque form input ---->
                        <div class="form-group">
                            {{ Form::textarea('remarque', null, ['class' => 'form-control textarea', 'rows'=>10, 'width'=>'100%']) }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Enregistrer</button>
    </form>
@stop