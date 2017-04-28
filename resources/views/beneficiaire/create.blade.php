@extends('layouts.adminlte')

@section('title', 'Inscription bénéficiaire')

@section('content_header')
    <h1>Nouveau Bénéficiaire</h1>
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
    <form method="POST" action="/beneficiaires">
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
                        <!--- conjoint form input ---->
                        <div class="form-group {{ $errors->first('conjoint', 'has-error') }}">
                            {{ Form::label('conjoint', 'Conjoint:') }}
                            {{ Form::text('conjoint', null, ['class' => 'form-control']) }}
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
            <div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Personne ressource 1</h3>
                        <div class="box-tools pull-right">
                            <!-- This will cause the box to collapse when clicked -->
                            <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                                    title="Collapse">
                                <i class="fa fa-minus"></i>
                            </button>
                        </div><!-- /.box-tools -->
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <!--- resource_nom form input ---->
                        <div class="form-group {{ $errors->first('resource_nom', 'has-error') }}">
                            {{ Form::label('resource_nom', 'Nom complet:') }}
                            {{ Form::text('resource_nom', null, ['class' => 'form-control']) }}
                        </div>
                        <div class="row">
                            <!--- telephone form input ---->
                            <div class="form-group col-md-6">
                                {{ Form::label('resource_tel_maison', 'Téléphone maison:') }}
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                    {{ Form::text('resource_tel_maison', null, ['class' => 'form-control telephone']) }}
                                </div>
                            </div>
                            <!--- telephone2 form input ---->
                            <div class="form-group col-md-6 {{ $errors->first('resource_tel_bureau', 'has-error') }}">
                                {{ Form::label('resource_tel_bureau', 'Bureau:') }}
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                    {{ Form::text('resource_tel_bureau', null, ['class' => 'form-control telephone']) }}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <!--- telephone form input ---->
                            <div class="form-group col-md-6">
                                {{ Form::label('resource_tel_cel', 'Cellulaire:') }}
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                    {{ Form::text('resource_tel_cel', null, ['class' => 'form-control telephone']) }}
                                </div>
                            </div>
                            <!--- resource_tel_pager form input ---->
                            <div class="form-group col-md-6 {{ $errors->first('resource_tel_pager', 'has-error') }}">
                                {{ Form::label('resource_tel_pager', 'Téléavertisseur:') }}
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                    {{ Form::text('resource_tel_pager', null, ['class' => 'form-control telephone']) }}
                                </div>
                            </div>
                        </div>
                        <!-- resource_email form input ---->
                        <div class="form-group  {{ $errors->first('resource_email', 'has-error') }}">
                            <label for="resource_email">Courriel:</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                {{ Form::text('resource_email', null, ['class' => 'form-control']) }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Personne ressource 2</h3>
                        <div class="box-tools pull-right">
                            <!-- This will cause the box to collapse when clicked -->
                            <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                                    title="Collapse">
                                <i class="fa fa-minus"></i>
                            </button>
                        </div><!-- /.box-tools -->
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <!--- resource2_nom form input ---->
                        <div class="form-group {{ $errors->first('resource2_nom', 'has-error') }}">
                            {{ Form::label('resource2_nom', 'Nom complet:') }}
                            {{ Form::text('resource2_nom', null, ['class' => 'form-control']) }}
                        </div>
                        <div class="row">
                            <!--- telephone form input ---->
                            <div class="form-group col-md-6">
                                {{ Form::label('resource2_tel_maison', 'Téléphone maison:') }}
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                    {{ Form::text('resource2_tel_maison', null, ['class' => 'form-control telephone']) }}
                                </div>
                            </div>
                            <!--- telephone2 form input ---->
                            <div class="form-group col-md-6 {{ $errors->first('resource2_tel_bureau', 'has-error') }}">
                                {{ Form::label('resource2_tel_bureau', 'Bureau:') }}
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                    {{ Form::text('resource2_tel_bureau', null, ['class' => 'form-control telephone']) }}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <!--- telephone form input ---->
                            <div class="form-group col-md-6">
                                {{ Form::label('resource2_tel_cel', 'Cellulaire:') }}
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                    {{ Form::text('resource2_tel_cel', null, ['class' => 'form-control telephone']) }}
                                </div>
                            </div>
                            <!--- resource2_tel_pager form input ---->
                            <div class="form-group col-md-6 {{ $errors->first('resource2_tel_pager', 'has-error') }}">
                                {{ Form::label('resource2_tel_pager', 'Téléavertisseur:') }}
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                    {{ Form::text('resource2_tel_pager', null, ['class' => 'form-control telephone']) }}
                                </div>
                            </div>
                        </div>
                        <!-- resource2_email form input ---->
                        <div class="form-group  {{ $errors->first('resource2_email', 'has-error') }}">
                            <label for="resource2_email">Courriel:</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                {{ Form::text('resource2_email', null, ['class' => 'form-control']) }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
                            <textarea name="remarque" class="form-control textarea" rows="10" width="100%"></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Enregistrer</button>
    </form>
@stop