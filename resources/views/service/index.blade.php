@extends('layouts.adminlte')

@section('title', 'Liste des services rendus')

@section('content_header')
    <h1>Services rendus</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary collapsed-box">
                <div class="box-header">
                    <h3 class="box-title">Ajouter un nouveau service rendu</h3>
                    <div class="box-tools pull-right">
                        <!-- This will cause the box to collapse when clicked -->
                        <button class="btn btn-box-tool" data-widget="collapse">
                            <i class="fa fa-plus"></i>
                        </button>
                    </div><!-- /.box-tools -->
                </div>
                <div class="box-body">
                    <form method="POST" action="/services">

                        {{ csrf_field() }}
                        @include("components.addService", ['serviceTypes' => $serviceTypes, 'categories' => $interestGroups])
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        @component('components.filtres', ['filters' => $filters])
            @slot('inputFilters')
                <div class="form-group col-md-6">
                    {{ Form::label('type', 'Type de service:') }}
                    @if($serviceableType == \App\Beneficiaire::class)
                        @include('components.select', ['name' => 'type', 'items' => $serviceTypes])
                    @else
                        <select name="type" class="form-control">
                            <option value="">Tous</option>
                            @foreach($interestGroups as $category)
                                <optgroup label="{{$category->nom}}">
                                    @foreach($category->competences as $competence)
                                        <option @if(isset($filters['type']))
                                                @if($filters['type'] == $competence->id) selected
                                                @endif
                                                @endif
                                                value="{{$competence->id}}">{{$competence->nom}}</option>
                                    @endforeach
                                </optgroup>
                            @endforeach
                        </select>
                    @endif
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
                        <th>Type</th>
                        <th>Bénévole</th>
                        @if($serviceableType == \App\Beneficiaire::class)
                            <th>Bénéficiaire</th>
                        @else
                            <th>Organisme</th>
                        @endif
                        <th>Rendu le</th>
                        <th>Don</th>
                        <th>Durée</th>
                        <th>Note</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($services as $service)
                        <tr>
                            <td>
                                {{ $service->competence->nom }}
                            </td>
                            <td>
                                <a href="{{$service->benevole->path()}}">{{$service->benevole->displayNom}}</a>
                            </td>
                            <td>
                                <a href="{{ $service->serviceable->path() }}">{{ $service->serviceable->displayNom }}</a>
                            </td>
                            <td>
                                {{ $service->rendu_le }}
                            </td>
                            <td>{{ $service->don }}</td>
                            <td>{{ $service->heures }}</td>
                            <td>
                                @if($service->note)
                                    <button type="button" class="btn btn-primary btn-xs" data-toggle="modal"
                                            data-target="#myModal{{$service->id}}">
                                        Note
                                    </button>
                                    <!-- Modal -->
                                    <div class="modal fade" id="myModal{{$service->id}}" tabindex="-1" role="dialog"
                                         aria-labelledby="myModalLabel">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close"><span aria-hidden="true">&times;</span>
                                                    </button>
                                                    <h4 class="modal-title" id="myModalLabel">Note</h4>
                                                </div>
                                                <div class="modal-body">
                                                    {!! $service->note !!}
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">
                                                        Close
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('services.edit', $service->id) }}" title="Modifier">
                                    <button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o"
                                                                              aria-hidden="true"></i> Modifier
                                    </button>
                                </a>
                                @can('can-delete')

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
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <th colspan="4" style="text-align:right">Total:</th>
                        <th></th>
                        <th></th>
                    </tr>
                    </tfoot>
                </table>
            @endslot
        @endcomponent
    </div>

@stop