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
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">Identification</a></li>
                <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">Facturation</a></li>
                <li class=""><a href="#tab_3" data-toggle="tab" aria-expanded="false">Personnes ressources</a></li>
                <li class=""><a href="#tab_4" data-toggle="tab" aria-expanded="false">Statut</a></li>
                <li class=""><a href="#tab_5" data-toggle="tab" aria-expanded="false">État de santé</a></li>
                <li><a href="#tab_6" data-toggle="tab" aria-expanded="false">Services demandés</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active row" id="tab_1">
                    @component("components.identification")
                        @slot('additionalFields')
                            <div class="form-group  col-md-6 {{ $errors->first('conjoint', 'has-error') }}">
                                {{ Form::label('conjoint', 'Conjoint:') }}
                                {{ Form::text('conjoint', null, ['class' => 'form-control']) }}
                            </div>
                            <div class="col-md-12">
                                @include('partials.form.contact')
                            </div>
                        @endslot
                    @endcomponent
                </div>
                <!-- /.tab-pane -->
                <div class="tab-pane" id="tab_2">
                    <h3>Adresse de facturation</h3>
                    <div class="row">
                        <!--- facturation_adresse form input ---->
                        <div class="form-group col-md-12 {{ $errors->first('facturation_adresse', 'has-error') }}">
                            {{ Form::label('facturation_adresse', 'Adresse:') }}
                            {{ Form::text('facturation_adresse', null, ['class' => 'form-control']) }}
                        </div>
                        <!--- facturation_ville form input ---->
                        <div class="form-group col-md-4 {{ $errors->first('facturation_ville', 'has-error') }}">
                            {{ Form::label('facturation_ville', 'Ville:') }}
                            {{ Form::text('facturation_ville', 'Québec', ['class' => 'form-control']) }}
                        </div>

                        <!--- facturation_province form input ---->
                        <div class="form-group col-md-4 {{ $errors->first('facturation_province', 'has-error') }}">
                            {{ Form::label('facturation_province', 'Province:') }}
                            {{ Form::text('facturation_province', 'QC', ['class' => 'form-control']) }}
                        </div>
                        <!--- facturation_code_postal form input ---->
                        <div class="form-group col-md-4 {{ $errors->first('facturation_code_postal', 'has-error') }}">
                            {{ Form::label('facturation_code_postal', 'Code postal:') }}
                            {{ Form::text('facturation_code_postal', null, ['class' => 'form-control codepostal']) }}
                        </div>
                    </div>
                </div>
                <!-- /.tab-pane -->
                <div class="tab-pane" id="tab_3">
                    @include('partials.form.ressources')
                </div>
                <div class="tab-pane row" id="tab_4">
                    @include('beneficiaire.partials.statut')
                </div>
                <div class="tab-pane row" id="tab_5">
                </div>
                <div class="tab-pane" id="tab_6">
                    @include('beneficiaire.partials.requests')
                </div>
            </div>
            <!-- /.tab-content -->
        </div>

        <button type="submit" class="btn btn-primary">Enregistrer</button>
    </form>
@stop