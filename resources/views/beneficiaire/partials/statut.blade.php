<!--- residence form input ---->
<div class="form-group col-md-6 {{ $errors->first('residence', 'has-error') }}">
    {{ Form::label('residence', 'Résidence:') }}
    {{ Form::text('residence', null, ['class' => 'form-control']) }}
</div>


<!--- occupation form input ---->
<div class="form-group col-md-6 {{ $errors->first('occupation', 'has-error') }}">
    {{ Form::label('occupation', 'Occupation:') }}
    {{ Form::text('occupation', null, ['class' => 'form-control']) }}
</div>
<!--- premiere_demande datepicker --->
<div class="form-group col-md-6">
    {{ Form::label('premiere_demande', 'Premiere demande:') }}
    <div class="input-group date datepicker">
        <div class="input-group-addon">
            <i class="fa fa-calendar"></i>
        </div>
        {{ Form::text('premiere_demande', null, ['class' => 'form-control pull-right']) }}
    </div>
</div>

<!--- evaluation_domicile datepicker --->
<div class="form-group col-md-6">
    {{ Form::label('evaluation_domicile', 'Évaluation à domicile:') }}
    <div class="input-group date datepicker">
        <div class="input-group-addon">
            <i class="fa fa-calendar"></i>
        </div>
        {{ Form::text('evaluation_domicile', null, ['class' => 'form-control pull-right']) }}
    </div>
</div>
@can('manage-confidential-fields')
    <!--- income_source_id form input ---->
    <div class="form-group col-md-6 {{ $errors->first('income_source_id', 'has-error') }}">
        {{ Form::label('income_source_id', 'Revenus:') }}
        <div class="radio">
            <label>{{ Form::radio('income_source_id', 1) }} {{$revenus[0]->nom}}</label>
        </div>
        <div class="radio">
            <label>{{ Form::radio('income_source_id', 2) }} {{$revenus[1]->nom}}</label>
        </div>
        <div class="radio">
            <label>{{ Form::radio('income_source_id', 3) }} {{$revenus[2]->nom}}</label>
        </div>
        <div class="radio">
            <label>{{ Form::radio('income_source_id', 4) }} {{$revenus[3]->nom}}</label>
        </div>
        <div class="radio">
            <label>{{ Form::radio('income_source_id', 5) }} {{$revenus[4]->nom}}</label>
        </div>
        <div class="radio">
            <label>{{ Form::radio('income_source_id', 6) }} {{$revenus[5]->nom}}</label>
        </div>
        <div class="row">
            <!--- securite_sociale form input ---->
            <div class="form-group col-md-12 additional-field additional-field-3 {{ $errors->first('securite_sociale', 'has-error') }}">
                {{ Form::label('securite_sociale', '# Securité sociale:') }}
                {{ Form::text('securite_sociale', null, ['class' => 'form-control']) }}
            </div>
            <!--- curateur_public form input ---->
            <div class="form-group col-md-12 additional-field additional-field-4 {{ $errors->first('RRQ', 'has-error') }}">
                {{ Form::label('curateur_public', '# Curateur public:') }}
                {{ Form::text('curateur_public', null, ['class' => 'form-control']) }}
            </div>
            <!--- autre_revenu form input ---->
            <div class="form-group col-md-12 additional-field additional-field-6 {{ $errors->first('autre_revenu', 'has-error') }}">
                {{ Form::label('autre_revenu', 'Autre source de revenu:') }}
                {{ Form::text('autre_revenu', null, ['class' => 'form-control']) }}
            </div>
        </div>
    </div>
@endcan
<div class="form-group col-md-6">
    <!--- contribution_volontaire form input ---->
    <div class="checkbox {{ $errors->first('contribution_volontaire', 'has-error') }}">
        <label>
            {{ Form::checkbox('contribution_volontaire', true) }} Contribution volontaire
        </label>
    </div>
    <!--- visite_medicale form input ---->
    <div class="checkbox {{ $errors->first('visite_medicale', 'has-error') }}">
        <label>
            {{ Form::checkbox('visite_medicale', true) }}
            Attestation de visite médicale
        </label>
    </div>
    <!--- gratuite form input ---->
    <div class="checkbox {{ $errors->first('gratuite', 'has-error') }}">
        <label>
            {{ Form::checkbox('gratuite', true) }}
            Gratuité
        </label>
    </div>
    <div class="checkbox">
        <label>
            {{ Form::checkbox('accepte_sollicitation', true) }}
            Accepte d'être sollicité dans le cadre d'une campagne de financement.
        </label>
    </div>
</div>

@push('js')
<script>
    $(document).ready(function () {
        var selectedRevenu = $('input[type=radio][name=income_source_id]:checked');
        $('.additional-field-' + selectedRevenu.val()).show();
        $('input[type=radio][name=income_source_id]').change(function () {
            $('.additional-field').hide();
            $('.additional-field-' + this.value).show();
        });
    });
</script>
@endpush