@php
    $attributes = [];
    if (isset($readonly)) {
        array_push($attributes, 'disabled');
    }
@endphp
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
<div class="nav-tabs-custom">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#identification" data-toggle="tab" aria-expanded="true">Identification</a></li>
        @can('manage-confidential-fields')
            <li class=""><a href="#selection" data-toggle="tab" aria-expanded="false">Sélection</a></li>
        @endcan
        <li><a href="#interets" data-toggle="tab" aria-expanded="false">Intérêts</a></li>
        <li><a href="#disponibilites" data-toggle="tab" aria-expanded="false">Disponibilités</a></li>
        @if(isset($readonly))
            <li><a href="#services" data-toggle="tab" aria-expanded="false">Services</a></li>
            @can('manage-confidential-fields')
                <li><a href="#notes" data-toggle="tab" aria-expanded="false">Notes</a></li>
            @endcan
        @endif
    </ul>
    <div class="tab-content">
        <div class="tab-pane active row" id="identification">
            <!--- prenom form input ---->
            <div class="form-group col-md-4 {{ $errors->first('prenom', 'has-error') }}">
                {{ Form::label('prenom', 'Prénom (*):') }}
                {{ Form::text('prenom', null, array_merge($attributes, ['class' => 'form-control'])) }}
            </div>
            <!--- nom form input ---->
            <div class="form-group  col-md-4 {{ $errors->first('nom', 'has-error') }}">
                {{ Form::label('nom', 'Nom (*):') }}
                {{ Form::text('nom', null, array_merge($attributes, ['class' => 'form-control'])) }}
            </div>
            <!--- sexe form input ---->
            <div class="form-group col-md-4 {{ $errors->first('sexe', 'has-error') }}">
                <fieldset @isset($readonly) disabled @endisset>
                    {{ Form::label('sexe', 'Sexe:') }}
                    <div>
                        <label class="radio-inline">
                            {{Form::radio('sexe', 'Homme')}} Homme
                        </label>
                        <label class="radio-inline">
                            {{Form::radio('sexe', 'Femme')}} Femme
                        </label>
                    </div>
                </fieldset>
            </div>

            <!--- naissance datepicker --->
            <div class="form-group  col-md-6">
                {{ Form::label('naissance', 'Naissance:') }}
                <div class="input-group date datepicker-naissance">
                    <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                    </div>
                    {{ Form::text('naissance', null, array_merge($attributes, ['class' => 'form-control pull-right'])) }}
                </div>
            </div>

            <div class="form-group col-md-6">
                {{ Form::label('benevole_type_id', 'Catégorie de bénévole:') }}
                {{ Form::select('benevole_type_id', $benevoleTypes->pluck('nom', 'id'),null, array_merge($attributes, ['class' => 'form-control'])) }}
            </div>

            <div class="col-md-12">
                @include('partials.form.contact', ['adress' => 'adress'])
            </div>

            <div class="form-group col-md-12 {{ $errors->first('remarque', 'has-error') }}">
                {{ Form::label('remarque', 'Remarques:') }}
                @if(isset($readonly))
                    <div class="readonly">
                        @if(isset($benevole))
                            {{$benevole->remarque}}
                        @endif
                    </div>
                @else
                    {!! Form::textarea('remarque', null, ['class' => 'form-control textarea', 'row' => '20'])  !!}
                @endif
            </div>
        </div>
        @can('manage-confidential-fields')
            <div class="tab-pane row" id="selection">
                @include('benevole.partials.selection')
            </div>
        @endcan
        <div class="tab-pane row" id="interets">
            @include('benevole.partials.interets')
        </div>
        <div class="tab-pane row" id="disponibilites">
            @include('benevole.partials.disponibilites')
        </div>
        @if(isset($readonly))
            <div class="tab-pane row" id="services">
                <h3 class="col-md-12">Services aux bénéficiaires</h3>
                <div class="col-md-12">
                    <table class="table table-bordered table-hover services-donne" width="100%">
                        <thead>
                        <tr>
                            <th>Type</th>
                            <th>Bénéficiaire</th>
                            <th>Rendu le</th>
                            <th>Don</th>
                            <th>Durée (h)</th>
                            <th>Note</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach ($benevole->services->where('serviceable_type', \App\Beneficiaire::class) as $service)
                            <tr>
                                <td>
                                    {{ $service->competence->nom }}
                                </td>
                                <td>
                                    <a href="{{ $service->serviceable->path() }}">{{$service->serviceable->displayNom}}</a>
                                </td>
                                <td>
                                    {{ $service->rendu_le }}
                                </td>
                                <td>{{$service->don}}</td>
                                <td>
                                    {{ $service->heures }}
                                </td>
                                <td>
                                    @if($service->note)
                                        <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModal{{$service->id}}">
                                            Note
                                        </button>
                                        <!-- Modal -->
                                        <div class="modal fade" id="myModal{{$service->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                        <h4 class="modal-title" id="myModalLabel">Note</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        {!! $service->note !!}
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                        <tfoot>
                        <tr>
                            <th colspan="3" style="text-align:right">Total:</th>
                            <th></th>
                            <th></th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
                <h3 class="col-md-12">Services aux organismes</h3>
                <div class="col-md-12">
                    <table class="table table-bordered table-hover services-donne" width="100%">
                        <thead>
                        <tr>
                            <th>Type</th>
                            <th>Organisme</th>
                            <th>Rendu le</th>
                            <th>Don</th>
                            <th>Durée (h)</th>
                            <th>Note</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach ($benevole->services->where('serviceable_type', \App\Organisme::class) as $service)
                            <tr>
                                <td>
                                    {{ $service->competence->nom }}
                                </td>
                                <td>
                                    <a href="{{ $service->serviceable->path() }}">{{$service->serviceable->displayNom}}</a>
                                </td>
                                <td>
                                    {{ $service->rendu_le }}
                                </td>
                                <td>{{$service->don}}</td>
                                <td>
                                    {{ $service->heures }}
                                </td>
                                <td>
                                    @if($service->note)
                                        <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModal{{$service->id}}">
                                            Note
                                        </button>
                                        <!-- Modal -->
                                        <div class="modal fade" id="myModal{{$service->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                        <h4 class="modal-title" id="myModalLabel">Note</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        {!! $service->note !!}
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                        <tfoot>
                        <tr>
                            <th colspan="3" style="text-align:right">Total:</th>
                            <th></th>
                            <th></th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            @can('manage-confidential-fields')
                <div class="tab-pane" id="notes">
                    @component('components.note', ['notableId' => $benevole->id, 'notableType' => \App\Benevole::class])
                    @endcomponent
                    @foreach($benevole->notes as $note)
                        @include('partials.show.notes', ['note' => $note])
                    @endforeach
                </div>
            @endcan
        @endif
    </div>
    <!-- /.tab-content -->
</div>
@if(!isset($readonly))
    <button type="submit" class="btn btn-primary">Enregistrer</button>
@endif