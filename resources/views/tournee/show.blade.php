@extends('layouts.adminlte')

@section('title', "Tournée {$tournee->nom}")

@section('content_header')
    <h1>Tournée {{ $tournee->nom }}</h1>
@stop

@section('content')

    {!! Form::model($tournee, [
                               'method' => 'PATCH',
                               'url' => ['tournees', $tournee->id],
                           ]) !!}
    @include('tournee.form')
    {{Form::close()}}
    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">Clients</h3>
            <div class="box-tools pull-right">
                {{ Form::open([
                                            'method'=>'POST',
                                            'url' => '/tournees/' . $tournee->id . '/add',
                                            'style' => 'display:inline'
                                        ]) }}
                {{ Form::hidden('beneficiaire_id',null, ['id' => 'beneficiaire_id']) }}
                {{ Form::text('beneficiaire', null, ['class' => 'form-control inline autocomplete',
                                'data-model' =>  'beneficiaire',
                                'data-display' => 'nom_complet',
                                'placeholder' => 'Bénéficiaire',
                                'required' => 'required',
                                ]) }}
                <button type="submit" class="btn btn-primary">Ajouter</button>
                {{ Form::close() }}
            </div>
        </div>
        <div class="box-body">

            <table class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th></th>
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
                            {!! Form::open([
                                            'method'=>'DELETE',
                                            'url' => '/tournees/' . $tournee->id . '/remove/' . $beneficiaire->id,
                                            'style' => 'display:inline'
                                        ]) !!}
                            {!! Form::button('<i class="fa fa-times" aria-hidden="true"></i>', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs',
                                    'title' => 'Retirer de la tournée',
                                    'onclick'=>'return confirm("Voulez-vous vraiment arrêter le service?")'
                            )) !!}
                            {!! Form::close() !!}
                        </td>
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
                        <td><a href="{{$beneficiaire->path()}}/edit#popote">{{$beneficiaire->nom_complet }}</a></td>
                        <td>@if($beneficiaire->tournee_payee) Oui @else Non @endif</td>
                        <td>{{$beneficiaire->tournee_note}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>
    </div>
@endsection