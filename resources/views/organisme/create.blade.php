@extends('layouts.adminlte')

@section('title', 'Nouvel Organisme')

@section('content_header')
    <h1>Nouvel organisme</h1>
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
    <form method="POST" action="/organismes">
        {{ csrf_field() }}
        <div class="box box-primary">
            <div class="box-header">
                <h2 class="box-title">Identification</h2>
            </div>
            <div class="box-body row">
                @include('organisme.partials.identification')
            </div>
        </div>
        <div class="box box-primary">
            <div class="box-header">
                <h2 class="box-title">Président</h2>
            </div>
            <div class="box-body row">
                @include('partials.form.resource', ['resource' => $organisme->president, 'readonly' => $readonly, 'iterator' => 0, 'lien' => 'Titre'])
            </div>
        </div>
        <div class="box box-primary">
            <div class="box-header">
                <h2 class="box-title">Employé</h2>
            </div>
            <div class="box-body row">
                @include('partials.form.resource', ['resource' => $organisme->employe, 'readonly' => $readonly, 'iterator' => 1, 'lien' => 'Titre'])
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Enregistrer</button>
    </form>
@stop