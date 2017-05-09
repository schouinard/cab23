<!--- antecedents form input ---->
<div class="form-group col-md-12 {{ $errors->first('antecedents', 'has-error') }}">
    {{ Form::label('antecedents', 'Antécédents judiciaires:') }}
    {{ Form::textarea('antecedents', null, ['class' => 'form-control textarea', 'row' => '20', 'width' => '100%']) }}
</div>
<!--- enquete_sociale form input ---->
<div class="form-group col-md-12 {{ $errors->first('enquete_sociale', 'has-error') }}">
    {{ Form::label('enquete_sociale', 'Références pour enquête sociale:') }}
    {{ Form::textarea('enquete_sociale', null, ['class' => 'form-control textarea', 'row' => '20', 'width' => '100%']) }}
</div>
<!--- inscription datepicker --->
<div class="form-group col-md-6">
    {{ Form::label('inscription', 'Inscription:') }}
    <div class="input-group date datepicker">
        <div class="input-group-addon">
            <i class="fa fa-calendar"></i>
        </div>
        {{ Form::text('inscription', Carbon\Carbon::today()->toDateString(), ['class' => 'form-control pull-right']) }}
    </div>
</div>
<div class="form-group col-md-6">
    {{ Form::label('integration', 'Intégration:') }}
    <div class="input-group date datepicker">
        <div class="input-group-addon">
            <i class="fa fa-calendar"></i>
        </div>
        {{ Form::text('integration', null, ['class' => 'form-control pull-right']) }}
    </div>
</div>
<div class="form-group col-md-6">
    {{ Form::label('suivi', 'Suivi:') }}
    <div class="input-group date datepicker">
        <div class="input-group-addon">
            <i class="fa fa-calendar"></i>
        </div>
        {{ Form::text('suivi', null, ['class' => 'form-control pull-right']) }}
    </div>
</div>
<div class="form-group col-md-6">
    {{ Form::label('accepte_ca', 'Accepté CA:') }}
    <div class="input-group date datepicker">
        <div class="input-group-addon">
            <i class="fa fa-calendar"></i>
        </div>
        {{ Form::text('accepte_ca', null, ['class' => 'form-control pull-right']) }}
    </div>
</div>