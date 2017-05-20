<fieldset @if(isset($readonly)) disabled @endif>
    <div class="col-xs-3">Jour</div>
    <div class="col-xs-3">Matin</div>
    <div class="col-xs-3">Après-midi</div>
    <div class="col-xs-3">Soir</div>
    @foreach($days as $day)
        <div class="col-xs-3">{{$day->nom}}</div>
        @foreach($moments as $moment)
            <div class="col-xs-3">{{ Form::checkbox("disponibilites[{$day->id}][]", $moment->id, isset($benevole) ? $benevole->isDisponible($day->id, $moment->id): null) }}</div>
        @endforeach
    @endforeach
</fieldset>
