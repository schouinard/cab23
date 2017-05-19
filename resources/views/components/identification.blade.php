
<!--- prenom form input ---->
<div class="form-group col-md-6 {{ $errors->first('prenom', 'has-error') }}">
    {{ Form::label('prenom', 'Prénom (*):') }}
    {{ Form::text('prenom', null, ['class' => 'form-control']) }}
</div>
<!--- nom form input ---->
<div class="form-group  col-md-6 {{ $errors->first('nom', 'has-error') }}">
    {{ Form::label('nom', 'Nom (*):') }}
    {{ Form::text('nom', null, ['class' => 'form-control']) }}
</div>

<!--- naissance datepicker --->
<div class="form-group  col-md-6">
    {{ Form::label('naissance', 'Naissance:') }}
    <div class="input-group date datepicker-naissance">
        <div class="input-group-addon">
            <i class="fa fa-calendar"></i>
        </div>
        {{ Form::text('naissance', null, ['class' => 'form-control pull-right']) }}
    </div>
</div>

{{ $additionalFields  }}

<div class="col-md-12">
    @include('partials.form.contact', ['adress' => 'adress', 'readonly' => $readonly, 'model' => $model->adress])
</div>

<div class="form-group col-md-12 {{ $errors->first('', 'has-error') }}">
    {{ Form::label('remarque', 'Remarques:') }}
    {{ Form::textarea('remarque', null, ['class' => 'form-control textarea', 'row' => '20', 'width' => '100%']) }}
</div>