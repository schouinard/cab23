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

@if(isset($readonly))
    {{Form::close()}}
    <h3 class="col-md-12">Indisponibilités</h3>
    @foreach($benevole->indisponibilites as $indisponibilite)
        <div class="row">
            <div class="col-sm-2">
                <div class="col-sm-3">Du</div>
                <div class="col-sm-9">
                    {{$indisponibilite->from}}
                </div>
            </div>
            <div class="col-sm-2">
                <div class="col-sm-3">
                    au
                </div>
                <div class="col-sm-9">
                    {{$indisponibilite->to}}
                </div>
            </div>
            <div class="col-sm-2">
                {!! Form::open([
                                            'method'=>'DELETE',
                                            'url' => '/benevoles/' . $benevole->id . '/indisponibilites/'. $indisponibilite->id,
                                            'style' => 'display:inline'
                                        ]) !!}
                {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Supprimer', array(
                                                'type' => 'submit',
                                                'class' => 'btn btn-danger btn-xs',
                                                'title' => 'Supprimer',
                                                'onclick'=>'return confirm("Voulez-vous vraiment supprimer?")'
                                        )) !!}
                {!! Form::close() !!}
            </div>
        </div>
    @endforeach

    <h4 class="col-md-12">Ajouter une indisponibilité</h4>
    {{Form::open(['method' => 'post', 'url' => '/benevoles/' . $benevole->id . '/indisponibilites', 'class' => 'form-horizontal'])}}
    <div class="form-group col-md-3 {{ $errors->first('from', 'has-error') }}">
        {{ Form::label('from', 'Du:', ['class' => 'control-label col-sm-2']) }}
        <div class="input-group date datepicker col-sm-10">
            <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
            </div>
            {{ Form::text('from', null, array_merge( ['class' => 'form-control pull-right', 'required' => 'required'])) }}
        </div>
    </div>
    <div class="form-group col-md-3 {{ $errors->first('to', 'has-error') }}">
        {{ Form::label('to', 'Au:', ['class' => 'control-label col-sm-2']) }}
        <div class="input-group date datepicker col-sm-10">
            <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
            </div>
            {{ Form::text('to', null, array_merge(['class' => 'form-control pull-right', 'required' => 'required'])) }}
        </div>
    </div>
    <div class="form-group col-md-3">
        {!! Form::button('Ajouter', array(
                                                        'type' => 'submit',
                                                        'class' => 'btn btn-primary',
                                                        'title' => 'Ajouter',
                                                )) !!}
    </div>

    {{Form::close()}}
@endif