@extends('layouts.adminlte')

@section('title', "Tournée {$tournee->nom}")

@section('content_header')
    <h1>Tournée {{ $tournee->nom }}</h1>
@stop

@section('content')
    <div class="box box-primary">
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
        {!! Form::model($tournee, [
                                'method' => 'PATCH',
                                'url' => ['tournees', $tournee->id],
                            ]) !!}
        <div class="box-header">
            <h3 class="box-title">Point de service: {{ $tournee->nom }}</h3>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-3">
                    {{ Form::label('nom', 'Nom:') }}
                </div>
                <!--- nom form input ---->
                <div class="form-group col-md-3 {{ $errors->first('nom', 'has-error') }}">
                    {{ Form::text('nom', null, ['class' => 'form-control']) }}
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    {{ Form::label('telephone', 'Telephone:') }}
                </div>
                <!--- telephone form input ---->
                <div class="form-group col-md-3 {{ $errors->first('telephone', 'has-error') }}">
                    {{ Form::text('telephone', null, ['class' => 'form-control telephone']) }}
                </div>
            </div>
        </div>
        <div class="box-footer">
            <input type="submit" class="btn btn-primary" value="Enregistrer">
        </div>
        {{Form::close()}}
    </div>
    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">Clients</h3>
        </div>
        <div class="box-body">
            <table class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th colspan="2">Priorité</th>
                    <th>Client</th>
                    <th>Payé</th>
                    <th>Notes</th>
                </tr>
                </thead>
                <tbody>
                @foreach($beneficiaires as $beneficiaire)
                    <tr>
                        <td>
                            @if(!$loop->first)
                                <a href='{{$tournee->path() . '/moveUp/' . $beneficiaire->id}}'><i
                                            class="fa fa-arrow-up"
                                            aria-hidden="true"></i></a>
                            @endif
                            @if(!$loop->last)
                                <a href='{{$tournee->path() . '/moveDown/' . $beneficiaire->id}}'><i
                                            class="fa fa-arrow-down" aria-hidden="true"></i></a>
                            @endif
                        </td>
                        <td>{{$beneficiaire->tournee_priorite}}</td>
                        <td><a href="{{$beneficiaire->path()}}">{{$beneficiaire->nom_complet }}</a></td>
                        <td>@if($beneficiaire->tournee_payee) Oui @else Non @endif</td>
                        <td>{{$beneficiaire->tournee_note}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection