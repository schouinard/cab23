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
            <div class="form-group col-md-6 {{ $errors->first('prenom', 'has-error') }}">
                {{ Form::label('prenom', 'Prénom (*):') }}
                {{ Form::text('prenom', null, array_merge($attributes, ['class' => 'form-control'])) }}
            </div>
            <!--- nom form input ---->
            <div class="form-group  col-md-6 {{ $errors->first('nom', 'has-error') }}">
                {{ Form::label('nom', 'Nom (*):') }}
                {{ Form::text('nom', null, array_merge($attributes, ['class' => 'form-control'])) }}
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
                            <td>Type</td>
                            <td>Bénéficiaire</td>
                            <td>Rendu le</td>
                            <td>Durée (h)</td>
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
                                <td>
                                    {{ $service->heures }}
                                </td>
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
                <h3 class="col-md-12">Services aux organismes</h3>
                <div class="col-md-12">
                    <table class="table table-bordered table-hover services-donne" width="100%">
                        <thead>
                        <tr>
                            <td>Type</td>
                            <td>Organisme</td>
                            <td>Rendu le</td>
                            <td>Durée (h)</td>
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
                                <td>
                                    {{ $service->heures }}
                                </td>
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