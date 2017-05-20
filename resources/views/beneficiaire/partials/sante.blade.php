<!--- etat_sante form input ---->
<div class="form-group col-md-12">
    <fieldset @if(isset($readonly)) disabled @endif>
        <legend>État de santé:</legend>
        @foreach($etatsSante as $etat)
            <div class="checkbox">
                <label>{{Form::checkbox('etatsSante[]', $etat->id)}}{{ $etat->nom }}</label>
            </div>
        @endforeach
    </fieldset>

    @if(isset($readonly))
        <div class="readonly">
            @if(isset($beneficiaire))
                {{$beneficiaire->etat_sante_autre}}
            @endif
        </div>
    @else
        {{ Form::textarea('etat_sante_autre', null, ['class' => 'form-control textarea', 'row' => '20', 'width' => '100%']) }}
    @endif
</div>
<!--- autonomie form input ---->
<div class="form-group col-md-12">
    <fieldset @if(isset($readonly)) disabled @endif>
        <legend>Autonomie:</legend>
        @foreach($autonomies as $autonomy)
            <div class="checkbox">
                <label>{{Form::checkbox('autonomies[]', $autonomy->id)}}{{ $autonomy->nom }}</label>
            </div>
        @endforeach
    </fieldset>

    @if(isset($readonly))
        <div class="readonly">
            @if(isset($beneficiaire))
                {{$beneficiaire->autonomie_autre}}
            @endif
        </div>
    @else
        {{ Form::textarea('autonomie_autre', null, ['class' => 'form-control textarea', 'row' => '20', 'width' => '100%']) }}
    @endif
</div>
<!--- support_familial form input ---->
<div class="form-group col-md-12">
    {{ Form::label('support_familial', 'Support du réseau familial et social:') }}
    @if(isset($readonly))
        <div class="readonly">
            @if(isset($beneficiaire))
                {{$beneficiaire->support_familial}}
            @endif
        </div>
    @else
        {{ Form::textarea('support_familial', null, ['class' => 'form-control textarea', 'row' => '20', 'width' => '100%']) }}
    @endif
</div>