@extends('layouts.adminlte')

@section('title', 'Liste des services rendus')

@section('content_header')
    <h1>Services rendus</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Ajouter un nouveau service rendu</h3>
                    <div class="box-tools pull-right">
                        <!-- This will cause the box to collapse when clicked -->
                        <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                                title="Collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div><!-- /.box-tools -->
                </div>
                <div class="box-body">
                    @component("components.addService", ['serviceTypes' => $serviceTypes, 'beneficiaireId' => null, 'benevoleId' => null, 'showBenevole' => true, 'showBeneficiaire' =>true])
                    @endcomponent
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        @component('components.filtres')
            @slot('inputFilters')
                <div class="form-group col-md-6">
                    {{ Form::label('type', 'Type de service:') }}
                    {{ Form::select('type', $serviceTypes->pluck('nom', 'id'),isset($filters['type']) ? $filters['type'] : null, ['class' => 'form-control', 'placeholder' => 'Tous les types']) }}
                </div>
                <div class="form-group col-md-3">
                    {{ Form::label('from', 'De:') }}
                    <div class="input-group date datepicker">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        {{Form::text('from', isset($filters['from']) ? $filters['from'] : null, ['class' => 'form-control pull-right'])}}
                    </div>
                </div>
                <div class="form-group col-md-3">
                    {{ Form::label('to', 'À:') }}
                    <div class="input-group date datepicker">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        {{Form::text('to', isset($filters['to']) ? $filters['to'] : null, ['class' => 'form-control pull-right'])}}
                    </div>
                </div>
            @endslot
        @endcomponent
    </div>
    <div class="row">
        @component('components.index', ['filters' => $filters])
            @slot('datatable')
                <table class="table table-hover table-bordered services-rendus">
                    <thead>
                    <tr>
                        <td>Type</td>
                        <td>Bénévole</td>
                        <td>Bénéficiaire</td>
                        <td>Rendu le</td>
                        <td>Don</td>
                        <td>Durée</td>
                        <td>Actions</td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($services as $service)
                        <tr>
                            <td>
                                {{ $service->type->nom }}
                            </td>
                            <td>
                                <a href="{{$service->benevole->path()}}">{{$service->benevole->nom}}
                                    , {{ $service->benevole->prenom }}</a>
                            </td>
                            <td>
                                <a href="{{ $service->serviceable->path() }}">{{ $service->serviceable->nom }}
                                    , {{ $service->serviceable->prenom }}</a>
                            </td>
                            <td>
                                {{ $service->rendu_le }}
                            </td>
                            <td>{{ $service->don }}</td>
                            <td>{{ $service->heures }}</td>
                            <td>
                                <a href="{{ route('services.edit', $service->id) }}" title="Modifier">
                                    <button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o"
                                                                              aria-hidden="true"></i> Modifier
                                    </button>
                                </a>
                                @can('can-delete')
                                    @if($service->trashed())
                                        {!! Form::open([
                                            'method'=>'POST',
                                            'url' => ['/services/' . $service->id . '/restore'],
                                            'style' => 'display:inline'
                                        ]) !!}
                                        {!! Form::button('<i class="fa fa-undo" aria-hidden="true"></i> Restaurer',
                                        [
                                                'type' => 'submit',
                                                'class' => 'btn btn-success btn-xs',
                                                'title' => 'Restaurer le service',

                                        ]) !!}
                                        {!! Form::close() !!}
                                    @else
                                        {!! Form::open([
                                            'method'=>'DELETE',
                                            'url' => ['/services', $service->id],
                                            'style' => 'display:inline'
                                        ]) !!}
                                        {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Supprimer', array(
                                                'type' => 'submit',
                                                'class' => 'btn btn-danger btn-xs',
                                                'title' => 'Supprimer le service',
                                                'onclick'=>'return confirm("Voulez-vous vraiment supprimer?")'
                                        )) !!}
                                        {!! Form::close() !!}
                                    @endif
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endslot
        @endcomponent
    </div>
@stop