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
            @include('beneficiaire.partials.tabs')
            <div class="tab-content">
                <div class="tab-pane active row" id="tab_1">
                    @component("components.identification")
                        @slot('additionalFields')
                            <div class="form-group  col-md-6 {{ $errors->first('conjoint', 'has-error') }}">
                                {{ Form::label('conjoint', 'Conjoint:') }}
                                {{ Form::text('conjoint', null, ['class' => 'form-control']) }}
                            </div>
                            <div class="col-md-12">
                                @include('partials.form.contact', ['adress' => 'adress'])
                            </div>
                        @endslot
                    @endcomponent
                </div>
                <!-- /.tab-pane -->
                <div class="tab-pane row" id="tab_2">
                    @include('beneficiaire.partials.sante')
                </div>
                <!-- /.tab-pane -->
                <div class="tab-pane row" id="tab_3">
                    @include('beneficiaire.partials.statut')
                </div>
                <div class="tab-pane" id="tab_4">
                    @include('partials.form.ressources')
                </div>
                <div class="tab-pane" id="tab_5">
                    @include('beneficiaire.partials.requests')
                </div>
                <div class="tab-pane" id="tab_6">
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
            </div>
            <!-- /.tab-content -->
        </div>

        <button type="submit" class="btn btn-primary">Enregistrer</button>
    </form>
@stop