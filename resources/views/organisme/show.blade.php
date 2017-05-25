@extends('layouts.adminlte')

@section('title', 'Fiche organisme - '. $organisme->nom)

@section('content_header')
    <div class="pull-right">
        <a class="btn btn-primary" href="{{ route('organismes.edit', $organisme) }}">Modifier</a>
    </div>
    <h1>
        Organisme - {{$organisme->nom}}
    </h1>
@stop

@section('content')
    @php
        $attributes = ["class" => "form-control"];
        if (isset($readonly)) {
            array_push($attributes, 'disabled');
        }
    @endphp
    {{ Form::model($organisme, ['route' => ['organismes.update', $organisme]]) }}
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#identification" data-toggle="tab" aria-expanded="true">Identification</a></li>
            <li class=""><a href="#contacts" data-toggle="tab" aria-expanded="false">Contacts</a></li>
            <li><a href="#services" data-toggle="tab" aria-expanded="false">Services</a></li>
            <li><a href="#notes" data-toggle="tab" aria-expanded="false">Notes</a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active row" id="identification">
                <!--- nom form input ---->
                <div class="form-group col-md-6 {{ $errors->first('nom', 'has-error') }}">
                    {{ Form::label('nom', 'Nom de l\'organisme:') }}
                    {{ Form::text('nom', null, $attributes) }}
                </div>
                <!--- organisme_type_id form input ---->
                <div class="form-group col-md-6 {{ $errors->first('organisme_type_id', 'has-error') }}">
                    {{ Form::label('type_id', 'Type:') }}
                    {{ Form::select('type_id', $type->pluck("nom", "id"), null, $attributes) }}
                </div>
                <div class="col-md-12">
                    @include('partials.form.contact')
                </div>
            </div>
            <div class="tab-pane row" id="contacts">
                <h3 class="col-md-12">Employé</h3>
                <div class="form-group col-md-6 {{ $errors->first("employe[nom]", "has-error") }}">
                    {{ Form::label("employe[nom]", "Nom:") }}
                    {{ Form::text("employe[nom]", null, $attributes) }}
                </div>
                {{ Form::hidden('employe[lien]', 'Employé') }}

                <div class="col-md-12">
                    @include("partials.form.contact", ["adress" => "employe[adress]"])
                </div>
                <h3 class="col-md-12">Président</h3>
                <div class="form-group col-md-6 {{ $errors->first("president[nom]", "has-error") }}">
                    {{ Form::label("president[nom]", "Nom:") }}
                    {{ Form::text("president[nom]", null, $attributes) }}
                </div>
                {{ Form::hidden('president[lien]', 'Président') }}
                <div class="col-md-12">
                    @include("partials.form.contact", ["adress" => "president[adress]"])
                </div>
            </div>
            <div class="tab-pane row" id="services">
                <h3 class="col-md-12">Services reçus</h3>
                <div class="col-md-12">
                    <table class="table table-bordered table-hover services-donne" width="100%">
                        <thead>
                        <tr>
                            <td>Type</td>
                            <td>Bénévole</td>
                            <td>Rendu le</td>
                            <td>Don</td>
                            <td>Durée</td>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach ($organisme->services as $service)
                            <tr>
                                <td>
                                    {{ $service->type->nom }}
                                </td>
                                <td>
                                    <a href="{{ $service->benevole->path() }}">{{ $service->benevole->nom }}
                                        , {{ $service->benevole->prenom }}</a>
                                </td>
                                <td>
                                    {{ $service->rendu_le }}
                                </td>
                                <td>
                                    {{ $service->don }}
                                </td>
                                <td>{{$service->heures}}</td>
                            </tr>
                        @endforeach

                        </tbody>
                        <tfoot>
                        <tr>
                            <th colspan="3" style="text-align:right">Total:</th>
                            <th></th>
                        </tr>
                        </tfoot>
                    </table>
                </div>

            </div>
            <div class="tab-pane" id="notes">
                @component('components.note', ['notableId' => $organisme->id, 'notableType' => \App\Organisme::class])
                @endcomponent
                @foreach($organisme->notes as $note)
                    @include('partials.show.notes', ['note' => $note])
                @endforeach
            </div>
        </div>

    </div><!-- /.box -->
    {{ Form::close() }}
@stop