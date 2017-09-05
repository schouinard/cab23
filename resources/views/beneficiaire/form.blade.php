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
        <li class=""><a href="#sante" data-toggle="tab" aria-expanded="false">État de santé</a></li>
        <li class=""><a href="#statut" data-toggle="tab" aria-expanded="false">Statut</a></li>
        <li class=""><a href="#contacts" data-toggle="tab" aria-expanded="false">Personnes ressources</a></li>
        <li><a href="#services" data-toggle="tab" aria-expanded="false">Services</a></li>
        <li><a href="#popote" data-toggle="tab" aria-expanded="false">Popote</a></li>
        <li class=""><a href="#facturation" data-toggle="tab" aria-expanded="false">Facturation</a></li>
        @if(isset($readonly))
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

            <div class="form-group  col-md-6 {{ $errors->first('conjoint', 'has-error') }}">
                {{ Form::label('conjoint', 'Conjoint:') }}
                {{ Form::text('conjoint', null, array_merge($attributes,['class' => 'form-control'])) }}
            </div>

            <div class="col-md-12">
                @include('partials.form.contact', ['adress' => 'adress'])
            </div>

            <div class="form-group col-md-12 {{ $errors->first('', 'has-error') }}">
                {{ Form::label('remarque', 'Remarques:') }}
                @if(isset($readonly))
                    <div class="readonly">
                        @if(isset($beneficiaire))
                            {!! $beneficiaire->remarque !!}
                        @endif
                    </div>
                @else
                    {!!  Form::textarea('remarque', null, ['class' => 'form-control textarea', 'row' => '20']) !!}
                @endif
            </div>
        </div>
        <!-- /.tab-pane -->
        <div class="tab-pane row" id="sante">
            @include('beneficiaire.partials.sante')
        </div>
        <!-- /.tab-pane -->
        <div class="tab-pane row" id="statut">
            @include('beneficiaire.partials.statut')
        </div>
        <div class="tab-pane" id="contacts">

            @for($i = 0; $i < 3; $i++)
                <h3>Personne ressource {{$i + 1}}</h3>
                <div class="row">
                    @include('partials.form.resource', ['resource' => isset($beneficiaire->people[$i]) ? $beneficiaire->people[$i] : new \App\Person(), 'iterator' => $i, 'lien' => 'Lien'])
                </div>
            @endfor

        </div>
        <div class="tab-pane row" id="services">
            @include('beneficiaire.partials.requests')
        </div>
        <div class="tab-pane row" id="popote">
            <div class="form-group col-md-12">
                <fieldset @isset($readonly) disabled @endisset>
                    <legend>Jours où le bénéficiaire <strong>ne veut pas</strong> de repas</legend>
                    @foreach($days as $day)
                        <div class="checkbox">
                            <label>
                                {{ Form::checkbox('days[]', $day->id, isset($beneficiaire) ? in_array($day->id, $beneficiaire->selectedDays) : null) }} {{ $day->nom }}
                            </label>
                        </div>
                    @endforeach
                </fieldset>
            </div>
            @isset($beneficiaire)
                <h3 class="col-md-12">Tournées</h3>
                @foreach($beneficiaire->tournees as $tournee)
                    <input type="hidden" name="tournees[{{$tournee->id}}][id]" value="{{$tournee->id}}"/>
                    <h4 class="col-md-12"><a href="{{$tournee->path()}}">{{$tournee->nom}}</a></h4>
                    <fieldset class="col-md-12" @isset($readonly) disabled @endisset>
                        <div class="checkbox">
                            <label>{{ Form::checkbox('tournees['. $tournee->id .'][payee]', true, $tournee->pivot->payee) }}
                                A payé sa tournée</label>
                        </div>
                        {{ Form::label('tournees['. $tournee->id .'][note]', 'Note:') }}
                        @if(isset($readonly))
                            <div class="readonly">
                                {!! $tournee->pivot->note  !!}
                            </div>
                        @else
                            {!!  Form::textarea('tournees['. $tournee->id .'][note]', $tournee->pivot->note, ['class' => 'form-control textarea', 'row' => '20']) !!}
                        @endif
                    </fieldset>
                    <hr>
                @endforeach
            @endisset
        </div>
        <div class="tab-pane" id="facturation">
            <h3>Adresse de facturation</h3>
            @include('partials.form.contact', ['adress' => 'facturation', 'model' => isset($beneficiaire) ? $beneficiaire->facturation : new \App\Adress()])
        </div>
        @if(isset($readonly))
            @can('manage-confidential-fields')
                <div class="tab-pane" id="notes">
                    {{Form::close()}}
                    @component('components.note', ['notableId' => $beneficiaire->id, 'notableType' => \App\Beneficiaire::class])
                    @endcomponent
                    @foreach($beneficiaire->notes as $note)
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