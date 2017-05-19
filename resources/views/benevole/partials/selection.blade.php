<!--- antecedents form input ---->
<div class="form-group col-md-12 {{ $errors->first('antecedents', 'has-error') }}">
    {{ Form::label('antecedents', 'Antécédents judiciaires:') }}
    @if(isset($readonly))
        <div class="readonly">
            @if(isset($benevole))
                {{$benevole->antecedents}}
            @endif
        </div>
    @else
        {{ Form::textarea('antecedents', null, array_merge($attributes, ['class' => 'form-control textarea', 'row' => '20', 'width' => '100%'])) }}
    @endif
</div>
<!--- enquete_sociale form input ---->
<div class="form-group col-md-12 {{ $errors->first('enquete_sociale', 'has-error') }}">
    {{ Form::label('enquete_sociale', 'Références pour enquête sociale:') }}
    @if(isset($readonly))
        <div class="readonly">
            @if(isset($benevole))
                {{$benevole->enquete_sociale}}
            @endif
        </div>
    @else
        {{ Form::textarea('enquete_sociale', null, array_merge($attributes, ['class' => 'form-control textarea', 'row' => '20', 'width' => '100%'])) }}
    @endif
</div>
<!--- inscription datepicker --->
<div class="form-group col-md-6">
    {{ Form::label('inscription', 'Inscription:') }}
    <div class="input-group date datepicker">
        <div class="input-group-addon">
            <i class="fa fa-calendar"></i>
        </div>
        {{ Form::text('inscription', null, array_merge($attributes, ['class' => 'form-control pull-right'])) }}
    </div>
</div>
<div class="form-group col-md-6">
    {{ Form::label('integration', 'Intégration:') }}
    <div class="input-group date datepicker">
        <div class="input-group-addon">
            <i class="fa fa-calendar"></i>
        </div>
        {{ Form::text('integration', null, array_merge($attributes, ['class' => 'form-control pull-right'])) }}
    </div>
</div>
<div class="form-group col-md-6">
    {{ Form::label('suivi', 'Suivi:') }}
    <div class="input-group date datepicker">
        <div class="input-group-addon">
            <i class="fa fa-calendar"></i>
        </div>
        {{ Form::text('suivi', null, array_merge($attributes, ['class' => 'form-control pull-right'])) }}
    </div>
</div>
<div class="form-group col-md-6">
    {{ Form::label('accepte_ca', 'Accepté CA:') }}
    <div class="input-group date datepicker">
        <div class="input-group-addon">
            <i class="fa fa-calendar"></i>
        </div>
        {{ Form::text('accepte_ca', null, array_merge($attributes, ['class' => 'form-control pull-right'])) }}
    </div>
</div>