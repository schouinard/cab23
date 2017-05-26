@if (count($errors))
    <div class="callout callout-danger">
        <h4>Veuillez valider les points suivants avant de continuer.</h4>
        <ul class="error-content">
            @foreach ($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="box box-primary">
    <div class="box-body">
        <div class="row">
            <div class="col-md-6">
                <fieldset>
                    <legend>
                        Détails de la tournée
                    </legend>
                    <div class="col-md-6">
                        {{ Form::label('nom', 'Nom *:') }}
                    </div>
                    <!--- nom form input ---->
                    <div class="form-group col-md-6 {{ $errors->first('nom', 'has-error') }}">
                        {{ Form::text('nom', isset($tournee) ? $tournee->nom : null, ['class' => 'form-control']) }}
                    </div>

                    <div class="col-md-6">
                        {{ Form::label('telephone', 'Telephone *:') }}
                    </div>
                    <!--- telephone form input ---->
                    <div class="form-group col-md-6 {{ $errors->first('telephone', 'has-error') }}">
                        {{ Form::text('telephone', isset($tournee) ? $tournee->telephone : null, ['class' => 'form-control telephone']) }}
                    </div>
                </fieldset>

            </div>
            <div class="col-md-6">
                <fieldset>
                    <legend>Tournée active le:</legend>
                    @foreach($days as $day)
                        <div class="checkbox">
                            <label>
                                {{ Form::checkbox('days[]', $day->id) }} {{ $day->nom }}
                            </label>
                        </div>
                    @endforeach
                </fieldset>
            </div>
        </div>
    </div>
    <div class="box-footer">
        <input type="submit" class="btn btn-primary" value="Enregistrer">
    </div>
</div>