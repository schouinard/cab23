@extends('layouts.adminlte')

@section('title', 'Modifier un service rendu')

@section('content_header')
    <h1>Modifier un service rendu</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Modifier le service</h3>
                </div>
                <div class="box-body">
                    {!! Form::model($service, [
                                                'method' => 'PATCH',
                                                'url' => ['services', $service->id],
                                            ]) !!}
                    @include("components.addService", ['serviceTypes' => $serviceTypes, 'categories' => $interestGroups, 'serviceableType' => $service->serviceable_type])
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>

@stop