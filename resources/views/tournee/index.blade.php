@extends('layouts.adminlte')

@section('title', 'Liste des tournées')

@section('content_header')
    <h1>Tournées de popote</h1>
@stop

@section('content')
    <div class="row">
        @component('components.index', ['filters' => []])
            @slot('datatable')
                <table class="datatable table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($items as $item)
                        <tr>
                            <td><a href="{{ $item->path() }}">{{ $item->nom }}</a></td>
                            <td>
                                <a href="{{$item->path() . '/print' }}" target="_blank" title="Imprimer">
                                    <button class="btn btn-primary btn-xs"><i class="fa fa-print"
                                                                              aria-hidden="true"></i> Feuille de route
                                    </button>
                                </a>
                                <a href="{{$item->path() . '/printAlpha' }}" target="_blank" title="Imprimer">
                                    <button class="btn btn-primary btn-xs"><i class="fa fa-print"
                                                                              aria-hidden="true"></i> Copie du bureau
                                    </button>
                                </a>
                                <a href="{{$item->path() . '/printConducteur' }}" target="_blank" title="Imprimer">
                                    <button class="btn btn-primary btn-xs"><i class="fa fa-print"
                                                                              aria-hidden="true"></i> Feuille conducteur
                                    </button>
                                </a>
                                @can('can-delete')

                                    {!! Form::open([
                                        'method'=>'DELETE',
                                        'url' => ['/tournees', $item->id],
                                        'style' => 'display:inline'
                                    ]) !!}
                                    {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Supprimer', array(
                                            'type' => 'submit',
                                            'class' => 'btn btn-danger btn-xs',
                                            'title' => 'Supprimer la tournée',
                                            'onclick'=>'return confirm("Voulez-vous vraiment supprimer?")'
                                    )) !!}
                                    {!! Form::close() !!}

                                @endcan
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot></tfoot>
                </table>
            @endslot
        @endcomponent
    </div>
@stop