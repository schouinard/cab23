@php
    $attributes = [];
    if (isset($readonly)) {
        array_push($attributes, 'disabled');
    }
@endphp

<div class="nav-tabs-custom">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">Identification</a></li>
        <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">État de santé</a></li>
        <li class=""><a href="#tab_3" data-toggle="tab" aria-expanded="false">Statut</a></li>
        <li class=""><a href="#tab_4" data-toggle="tab" aria-expanded="false">Personnes ressources</a></li>
        <li><a href="#tab_5" data-toggle="tab" aria-expanded="false">Services</a></li>
        <li class=""><a href="#tab_6" data-toggle="tab" aria-expanded="false">Facturation</a></li>
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
                            {{$beneficiaire->remarque}}
                        @endif
                    </div>
                @else
                    {{ Form::textarea('remarque', null, ['class' => 'form-control textarea', 'row' => '20']) }}
                @endif
            </div>
        </div>
        <!-- /.tab-pane -->
        <div class="tab-pane row" id="tab_2">
            @include('beneficiaire.partials.sante')
        </div>
        <!-- /.tab-pane -->
        <div class="tab-pane row" id="tab_3">
            @include('beneficiaire.partials.statut')
        </div>
        <div class="tab-pane" id="tab_4">

            @for($i = 0; $i < 3; $i++)
                <h3>Personne ressource {{$i + 1}}</h3>
                <div class="row">
                    @include('partials.form.resource', ['resource' => isset($beneficiaire) ? $beneficiaire->people[$i] : new \App\Person(), 'iterator' => $i, 'lien' => 'Lien'])
                </div>
            @endfor

        </div>
        <div class="tab-pane" id="tab_5">
            @include('beneficiaire.partials.requests')
        </div>
        <div class="tab-pane" id="tab_6">
            <h3>Adresse de facturation</h3>
            @include('partials.form.contact', ['adress' => 'facturation', 'model' => isset($beneficiaire) ? $beneficiaire->facturation : new \App\Adress()])
        </div>
    </div>
    <!-- /.tab-content -->
</div>
@if(!isset($readonly))
    <button type="submit" class="btn btn-primary">Enregistrer</button>
@endif