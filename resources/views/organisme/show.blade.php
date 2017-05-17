@extends('layouts.adminlte')

@section('title', 'Fiche organisme - '. $organisme->nom)

@section('content_header')
    <h1>
        Organisme - {{$organisme->nom}}
    </h1>
@stop

@section('content')
    {{ Form::model($organisme, ['route' => ['organismes.update', $organisme]]) }}
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">Identification</a></li>
            <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">Contacts</a></li>
            <li><a href="#tab_3" data-toggle="tab" aria-expanded="false">Services</a></li>
            <li><a href="#tab_4" data-toggle="tab" aria-expanded="false">Notes</a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active row" id="tab_1">
                @include('organisme.partials.identification', ['readonly' => $readonly])
            </div>
            <div class="tab-pane row" id="tab_2">
                <h3 class="col-md-12">Président</h3>
                @include('partials.form.resource', ['resource' => $organisme->president, 'readonly' => $readonly, 'iterator' => 0, 'lien' => 'Titre'])
                <h3 class="col-md-12">Employé</h3>
                @include('partials.form.resource', ['resource' => $organisme->employe, 'readonly' => $readonly, 'iterator'=> 1, 'lien' => 'Titre'])
            </div>
            <div class="tab-pane" id="tab_3">
                <h3>Services</h3>

            </div>
            <div class="tab-pane" id="tab_4">
                @foreach($organisme->notes as $note)
                    @include('partials.show.notes', ['note' => $note])
                @endforeach
            </div>
        </div>

    </div><!-- /.box -->
    {{ Form::close() }}
@stop