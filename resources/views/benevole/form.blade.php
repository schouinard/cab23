@php
    $attributes = [];
    if (isset($readonly)) {
        array_push($attributes, 'disabled');
    }
@endphp

<div class="nav-tabs-custom">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">Identification</a></li>
        @can('manage-confidential-fields')
            <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">Sélection</a></li>
        @endcan
        <li><a href="#tab_3" data-toggle="tab" aria-expanded="false">Intérêts</a></li>
        <li><a href="#tab_4" data-toggle="tab" aria-expanded="false">Disponibilités</a></li>
        @if(isset($readonly))
            <li><a href="#tab_5" data-toggle="tab" aria-expanded="false">Services</a></li>
            @can('manage-confidential-fields')
                <li><a href="#tab_6" data-toggle="tab" aria-expanded="false">Notes</a></li>
            @endcan
        @endif
    </ul>
    <div class="tab-content">
        <div class="tab-pane active row" id="tab_1">
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

            <div class="form-group col-md-12 {{ $errors->first('', 'has-error') }}">
                {{ Form::label('remarque', 'Remarques:') }}
                @if(isset($readonly))
                    <div class="readonly">
                        @if(isset($benevole))
                            {{$benevole->remarque}}
                        @endif
                    </div>
                @else
                    {{ Form::textarea('remarque', null, ['class' => 'form-control textarea', 'row' => '20']) }}
                @endif
            </div>
        </div>
        @can('manage-confidential-fields')
            <div class="tab-pane row" id="tab_2">
                @include('benevole.partials.selection')
            </div>
        @endcan
        <div class="tab-pane row" id="tab_3">
            @include('benevole.partials.interets')
        </div>
        <div class="tab-pane row" id="tab_4">
            @include('benevole.partials.disponibilites')
        </div>
        @if(isset($readonly))
            <div class="tab-pane row" id="tab_5">
                <h3 class="col-md-12">Services aux bénéficiaires</h3>
                <div class="col-md-12">
                    <table class="table table-bordered table-hover services-donne" width="100%">
                        <thead>
                        <tr>
                            <td>Type</td>
                            <td>Bénévole</td>
                            <td>Rendu le</td>
                            <td>Durée (h)</td>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th colspan="3" style="text-align:right">Total:</th>
                            <th></th>
                        </tr>
                        </tfoot>
                        <tbody>
                        @foreach ($benevole->services as $service)
                            <tr>
                                <td>
                                    {{ $service->type->nom }}
                                </td>
                                <td>
                                    <a href="{{ $service->beneficiaire->path() }}">{{ $service->beneficiaire->nom }}
                                        , {{ $service->beneficiaire->prenom }}</a>
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
                    </table>
                </div>
            </div>
            @can('manage-confidential-fields')
                <div class="tab-pane" id="tab_6">
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