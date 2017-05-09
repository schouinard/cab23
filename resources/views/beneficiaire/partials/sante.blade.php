<!--- etat_sante form input ---->
<div class="form-group col-md-6 {{ $errors->first('etat_sante', 'has-error') }}">
	{{ Form::label('etat_sante', 'Etat_sante:') }}
	{{ Form::text('etat_sante', null, ['class' => 'form-control']) }}
</div>
<!--- etat_sante_autre form input ---->
<div class="form-group col-md-6 {{ $errors->first('etat_sante_autre', 'has-error') }}">
	{{ Form::label('etat_sante_autre', 'Etat_sante_autre:') }}
	{{ Form::text('etat_sante_autre', null, ['class' => 'form-control']) }}
</div>
<!--- autonomie form input ---->
<div class="form-group col-md-6 {{ $errors->first('autonomie', 'has-error') }}">
	{{ Form::label('autonomie', 'Autonomie:') }}
	{{ Form::text('autonomie', null, ['class' => 'form-control']) }}
</div>
<!--- accompagnement form input ---->
<div class="form-group col-md-6 {{ $errors->first('accompagnement', 'has-error') }}">
	{{ Form::label('accompagnement', 'Accompagnement:') }}
	{{ Form::text('accompagnement', null, ['class' => 'form-control']) }}
</div>
<!--- support_familial form input ---->
<div class="form-group col-md-6 {{ $errors->first('support_familial', 'has-error') }}">
	{{ Form::label('support_familial', 'Support_familial:') }}
	{{ Form::text('support_familial', null, ['class' => 'form-control']) }}
</div>