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
                <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">État de santé</a></li>
                <li class=""><a href="#tab_3" data-toggle="tab" aria-expanded="false">Statut</a></li>
                <li class=""><a href="#tab_4" data-toggle="tab" aria-expanded="false">Personnes ressources</a></li>
                <li><a href="#tab_5" data-toggle="tab" aria-expanded="false">Services</a></li>
                <li class=""><a href="#tab_6" data-toggle="tab" aria-expanded="false">Facturation</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active row" id="tab_1">
                    @component("components.identification", ['readonly'=>$readonly, 'model' => $beneficiaire])
                        @slot('additionalFields')
                            <div class="form-group  col-md-6 {{ $errors->first('conjoint', 'has-error') }}">
                                {{ Form::label('conjoint', 'Conjoint:') }}
                                {{ Form::text('conjoint', null, ['class' => 'form-control']) }}
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

                    @for($i = 0; $i < 3; $i++)
                        <h3>Personne ressource {{$i + 1}}</h3>
                        <div class="row">
                            @include('partials.form.resource', ['readonly' => $readonly, 'resource' => $beneficiaire->people[$i], 'iterator' => $i, 'lien' => 'Lien'])
                        </div>
                    @endfor

                </div>
                <div class="tab-pane" id="tab_5">
                    @include('beneficiaire.partials.requests')
                </div>
                <div class="tab-pane" id="tab_6">
                    <h3>Adresse de facturation</h3>
                    @include('partials.form.contact', ['adress' => 'facturation', 'readonly' => $readonly, 'model' => $beneficiaire->facturation])
                </div>
            </div>
            <!-- /.tab-content -->
        </div>

        <button type="submit" class="btn btn-primary">Enregistrer</button>
    </form>
@stop