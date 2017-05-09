<!--- etat_sante form input ---->
<div class="form-group col-md-12">
    <fieldset>
        <legend>État de santé:</legend>
        <div class="form-group">
            {{ Form::select('etat_sante_id', $etatsSante->pluck('nom', 'id'),null, ['class' => 'form-control', 'placeholder' => 'Sélectionner']) }}
        </div>
        {{ Form::textarea('etat_sante_autre', null, ['class' => 'form-control textarea', 'row' => '20', 'width' => '100%']) }}
    </fieldset>
</div>
<!--- autonomie form input ---->
<div class="form-group col-md-12">
    <fieldset>
        <legend>Autonomie:</legend>
        @foreach($autonomies as $autonomy)
            <div class="checkbox">
                <label>{{Form::checkbox('autonomy[]', $autonomy->id)}}{{ $autonomy->nom }}</label>
            </div>
        @endforeach
        {{ Form::textarea('autonomie_autre', null, ['class' => 'form-control textarea', 'row' => '20', 'width' => '100%']) }}
    </fieldset>
</div>
<!--- support_familial form input ---->
<div class="form-group col-md-12">
    {{ Form::label('support_familial', 'Support du réseau familial et social:') }}
    {{ Form::textarea('support_familial', null, ['class' => 'form-control textarea', 'row' => '20', 'width' => '100%']) }}
</div>