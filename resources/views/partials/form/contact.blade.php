<div class="row">
    <!--- adresse form input ---->
    <div class="form-group col-md-8 {{ $errors->first('adresse', 'has-error') }}">
        {{ Form::label('adresse', 'Adresse (*):') }}
        {{ Form::text('adresse', null, ['class' => 'form-control']) }}
    </div>
    <!--- ville form input ---->
    <div class="form-group col-md-4 {{ $errors->first('ville', 'has-error') }}">
        {{ Form::label('ville', 'Ville (*):') }}
        {{ Form::text('ville', 'Québec', ['class' => 'form-control']) }}
    </div>
</div>
<div class="row">
    <!--- secteur form input ---->
    <div class="form-group col-md-4 {{ $errors->first('secteur', 'has-error') }}">
        {{ Form::label('secteur_id', 'Secteur:') }}
        {{ Form::select('secteur_id', $secteurs->pluck('nom', 'id'), null, ['class' => 'form-control', 'placeholder' => '']) }}
    </div>
    <!--- province form input ---->
    <div class="form-group col-md-4 {{ $errors->first('province', 'has-error') }}">
        {{ Form::label('province', 'Province (*):') }}
        {{ Form::text('province', 'QC', ['class' => 'form-control']) }}
    </div>
    <!--- code_postal form input ---->
    <div class="form-group col-md-4 {{ $errors->first('code_postal', 'has-error') }}">
        {{ Form::label('code_postal', 'Code postal (*):') }}
        {{ Form::text('code_postal', null, ['class' => 'form-control codepostal']) }}
    </div>
</div>
<div class="row">
    <!--- telephone form input ---->
    <div class="form-group col-md-6">
        {{ Form::label('telephone', 'Téléphone:') }}
        <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-phone"></i></span>
            {{ Form::text('telephone', null, ['class' => 'form-control telephone']) }}
        </div>
    </div>
    <!--- telephone2 form input ---->
    <div class="form-group col-md-6 {{ $errors->first('telephone2', 'has-error') }}">
        {{ Form::label('telephone2', 'Autre téléphone:') }}
        <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-phone"></i></span>
            {{ Form::text('telephone2', null, ['class' => 'form-control telephone']) }}
        </div>
    </div>
</div>
<div class="row">
    <!--- cellulaire form input ---->
    <div class="form-group col-md-6">
        <label for="cellulaire">Cellulaire:</label>
        <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-mobile-phone"></i></span>
            {{ Form::text('cellulaire', null, ['class' => 'form-control telephone']) }}
        </div>
    </div>
    <!--- email form input ---->
    <div class="form-group col-md-6 {{ $errors->first('email', 'has-error') }}">
        <label for="email">Courriel:</label>
        <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
            {{ Form::text('email', null, ['class' => 'form-control']) }}
        </div>
    </div>
</div>