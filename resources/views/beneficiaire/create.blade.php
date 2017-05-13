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
                    <div class="box-group" id="ressources">
                        @for($i = 1; $i < 4; $i++)
                            @include('beneficiaire.partials.person', ['person' => $i])
                        @endfor
                    </div>
                </div>
                <div class="tab-pane" id="tab_5">
                    @include('beneficiaire.partials.requests')
                </div>
                <div class="tab-pane" id="tab_6">
                    <h3>Adresse de facturation</h3>
                    @include('partials.form.contact', ['adress' => 'facturation'])
                </div>
            </div>
            <!-- /.tab-content -->
        </div>

        <button type="submit" class="btn btn-primary">Enregistrer</button>
    </form>
@stop