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
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">Identification</a></li>
                <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">Sélection</a></li>
                <li><a href="#tab_3" data-toggle="tab" aria-expanded="false">Intérêts</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active row" id="tab_1">
                @component("components.identification")
                    @slot('additionalFields')
                        <!--- benevole_type_id form input ---->
                            <div class="form-group col-md-6">
                                {{ Form::label('benevole_type_id', 'Catégorie de bénévole:') }}
                                {{ Form::select('benevole_type_id', $benevoleTypes->pluck('nom', 'id'),null, ['class' => 'form-control']) }}
                            </div>
                            <div class="col-md-12">
                                @include('partials.form.contact', ['adress' => 'adress'])
                            </div>
                        @endslot
                    @endcomponent
                </div>
                <div class="tab-pane row" id="tab_2">
                    @include('benevole.partials.selection')
                </div>
                <div class="tab-pane row" id="tab_3">
                    @include('benevole.partials.interets')
                </div>
            </div>
            <!-- /.tab-content -->
        </div>
        <button type="submit" class="btn btn-primary">Enregistrer</button>
    </form>
@stop