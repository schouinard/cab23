<!--- residence form input ---->
<div class="form-group col-md-6 {{ $errors->first('residence', 'has-error') }}">
    {{ Form::label('residence', 'Résidence:') }}
    {{ Form::text('residence', null, ['class' => 'form-control']) }}
</div>
<!--- revenus form input ---->
<div class="form-group col-md-6 {{ $errors->first('revenus', 'has-error') }}">
    {{ Form::label('revenus', 'Revenus:') }}
    {{ Form::select('revenus', $revenus->pluck('nom', 'id'), null, ['class' => 'form-control form-revenus']) }}
</div>

<!--- occupation form input ---->
<div class="form-group col-md-6 {{ $errors->first('occupation', 'has-error') }}">
    {{ Form::label('occupation', 'Occupation:') }}
    {{ Form::text('occupation', null, ['class' => 'form-control']) }}
</div>
<!--- premiere_demande datepicker --->
<div class="form-group col-md-6">
    {{ Form::label('premiere_demande', 'Premiere demande:') }}
    <div class="input-group date datepicker-premiere-demande">
        <div class="input-group-addon">
            <i class="fa fa-calendar"></i>
        </div>
        {{ Form::text('premiere_demande', null, ['class' => 'form-control pull-right']) }}
    </div>
</div>

<!--- evaluation_domicile datepicker --->
<div class="form-group col-md-6">
    {{ Form::label('evaluation_domicile', 'Évaluation à domicile:') }}
    <div class="input-group date datepicker-evaluation-domicile">
        <div class="input-group-addon">
            <i class="fa fa-calendar"></i>
        </div>
        {{ Form::text('evaluation_domicile', null, ['class' => 'form-control pull-right']) }}
    </div>
</div>

<div class="form-group col-md-6">
    <!--- contribution_volontaire form input ---->
    <div class="checkbox {{ $errors->first('contribution_volontaire', 'has-error') }}">
        <label>
            {{ Form::checkbox('contribution_volontaire', null) }} Contribution volontaire
        </label>
    </div>
    <!--- visite_medicale form input ---->
    <div class="checkbox {{ $errors->first('visite_medicale', 'has-error') }}">
        <label>
            {{ Form::checkbox('visite_medicale', null) }}
            Confirmation de visite médicale
        </label>
    </div>
    <!--- gratuite form input ---->
    <div class="checkbox {{ $errors->first('gratuite', 'has-error') }}">
        <label>
            {{ Form::checkbox('gratuite', null) }}
            Gratuité
        </label>
    </div>
</div>
