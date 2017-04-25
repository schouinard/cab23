@extends('layouts.adminlte')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Nouveau Bénévole</h1>
@stop

@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Identification</h3>
            <div class="box-tools pull-right">
                <!-- This will cause the box to collapse when clicked -->
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                    <i class="fa fa-minus"></i>
                </button>
            </div><!-- /.box-tools -->
        </div><!-- /.box-header -->
        <div class="box-body">
            <form method="POST" action="/benevoles">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="prenom">Prénom:</label>
                    <input type="text" class="form-control" name="prenom" />
                </div>
                <div class="form-group">
                    <label for="nom">Nom:</label>
                    <input type="text" class="form-control" name="nom" />
                </div>
                <div class="form-group">
                    <label for="adresse">Adresse:</label>
                    <input type="text" class="form-control" name="adresse">
                </div>
                <div class="form-group">
                	<label for="ville">Ville:</label>
                	<input type="text" class="form-control" name="ville" />
                </div>
                <!--- ville form input ---->
                <div class="form-group">
                	<label for="ville">Ville:</label>
                	<input type="text" class="form-control" name="ville" />
                </div>
                <!--- province form input ---->
                <div class="form-group">
                	<label for="province">Province:</label>
                	<input type="text" class="form-control" name="province" />
                </div>
                <!--- code_postal form input ---->
                <div class="form-group">
                	<label for="code_postal">Code postal:</label>
                	<input type="text" class="form-control" name="code_postal" />
                </div>
                <!--- quartier form input ---->
                <div class="form-group">
                	<label for="quartier">Quartier:</label>
                	<input type="text" class="form-control" name="quartier" />
                </div>
                <!--- telephone form input ---->
                <div class="form-group">
                	<label for="telephone">Téléphone:</label>
                	<input type="text" class="form-control" name="telephone" />
                </div>
                <!--- telephone2 form input ---->
                <div class="form-group">
                	<label for="telephone2">Autre téléphone:</label>
                	<input type="text" class="form-control" name="telephone2" />
                </div>
                <!--- email form input ---->
                <div class="form-group">
                	<label for="email">Courriel:</label>
                	<input type="text" class="form-control" name="email" />
                </div>
                <!--- naissance datepicker --->
                <div class="form-group">
                	<label for="naissance">Naissance:</label>
                	<div class="input-group date datepicker">
                		<div class="input-group-addon">
                			<i class="fa fa-calendar"></i>
                		</div>
                		<input name="naissance" type="text" class="form-control pull-right" />
                	</div>
                </div>
                <!--- inscription datepicker --->
                <div class="form-group">
                	<label for="inscription">Inscription:</label>
                	<div class="input-group date datepicker">
                		<div class="input-group-addon">
                			<i class="fa fa-calendar"></i>
                		</div>
                		<input name="inscription" type="text" class="form-control pull-right" />
                	</div>
                </div>
                <!--- accepte_ca datepicker --->
                <div class="form-group">
                	<label for="accepte_ca">Accepté CA:</label>
                	<div class="input-group date datepicker">
                		<div class="input-group-addon">
                			<i class="fa fa-calendar"></i>
                		</div>
                		<input name="accepte_ca" type="text" class="form-control pull-right" />
                	</div>
                </div>
                <!--- remarque form input ---->
                <div class="form-group">
                	<label for="remarque">Remarque:</label>
                    <textarea name="remarque" class="form-control textarea" rows="10"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Enregistrer</button>
            </form>
        </div><!-- /.box-body -->
        <div class="box-footer">

        </div><!-- box-footer -->
    </div><!-- /.box -->
@stop

@push('js')
<script src="{{asset('bower_components/bootstrap3-wysihtml5-bower/dist/bootstrap3-wysihtml5.all.min.js')}}"></script>
@endpush

@push('css')
<link rel="stylesheet" href="{{asset('bower_components/bootstrap3-wysihtml5-bower/dist/bootstrap3-wysihtml5.min.css')}}">
@endpush