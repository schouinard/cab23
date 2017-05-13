<!--- etat_sante form input ---->
<div class="form-group col-md-12">
    <fieldset>
        <legend>État de santé:</legend>
        @foreach($etatsSante as $etat)
            <div class="checkbox">
                <label>{{Form::checkbox('etatsSante[]', $etat->id)}}{{ $etat->nom }}</label>
            </div>
        @endforeach
        {{ Form::textarea('etat_sante_autre', null, ['class' => 'form-control textarea', 'row' => '20', 'width' => '100%']) }}
    </fieldset>
</div>
<!--- autonomie form input ---->
<div class="form-group col-md-12">
    <fieldset>
        <legend>Autonomie:</legend>
        @foreach($autonomies as $autonomy)
            <div class="checkbox">
                <label>{{Form::checkbox('autonomies[]', $autonomy->id)}}{{ $autonomy->nom }}</label>
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