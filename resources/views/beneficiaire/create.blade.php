@extends('layouts.adminlte')

@section('title', 'Inscription bénéficiaire')

@section('content_header')
    <h1>Nouveau Bénéficiaire</h1>
@stop

@section('content')
    <form method="POST" action="/beneficiaires">
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
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="prenom">Prénom:</label>
                    <input type="text" class="form-control" name="prenom"/>
                </div>
                <div class="form-group">
                    <label for="nom">Nom:</label>
                    <input type="text" class="form-control" name="nom"/>
                </div>
                <div class="form-group">
                    <label for="adresse">Adresse:</label>
                    <input type="text" class="form-control" name="adresse">
                </div>
                <!--- ville form input ---->
                <div class="form-group">
                    <label for="ville">Ville:</label>
                    <input type="text" class="form-control" name="ville"/>
                </div>
                <!--- province form input ---->
                <div class="form-group">
                    <label for="province">Province:</label>
                    <input type="text" class="form-control" name="province"/>
                </div>
                <!--- code_postal form input ---->
                <div class="form-group">
                    <label for="code_postal">Code postal:</label>
                    <input type="text" class="form-control" name="code_postal"/>
                </div>
                <!--- quartier form input ---->
                <div class="form-group">
                    <label for="quartier">Quartier:</label>
                    <input type="text" class="form-control" name="quartier"/>
                </div>
                <!--- telephone form input ---->
                <div class="form-group">
                    <label for="telephone">Téléphone:</label>
                    <input type="text" class="form-control" name="telephone"/>
                </div>
                <!--- telephone2 form input ---->
                <div class="form-group">
                    <label for="telephone2">Autre téléphone:</label>
                    <input type="text" class="form-control" name="telephone2"/>
                </div>
                <!--- email form input ---->
                <div class="form-group">
                    <label for="email">Courriel:</label>
                    <input type="text" class="form-control" name="email"/>
                </div>
                <!--- naissance datepicker --->
                <div class="form-group">
                    <label for="naissance">Naissance:</label>
                    <div class="input-group date datepicker">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input name="naissance" type="text" class="form-control pull-right"/>
                    </div>
                </div>
                <!--- remarque form input ---->
                <div class="form-group">
                    <label for="remarque">Remarque:</label>
                    <textarea name="remarque" class="form-control textarea" rows="10"></textarea>
                </div>

            </div><!-- /.box-body -->
            <div class="box-footer">

            </div><!-- box-footer -->
        </div><!-- /.box -->
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Personne ressource</h3>
                <div class="box-tools pull-right">
                    <!-- This will cause the box to collapse when clicked -->
                    <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fa fa-minus"></i>
                    </button>
                </div><!-- /.box-tools -->
            </div><!-- /.box-header -->
            <div class="box-body">
                <!-- resource_nom form input ---->
                <div class="form-group">
                	<label for="resource_nom">Nom:</label>
                	<input type="text" class="form-control" name="resource_nom" />
                </div>
                <!-- resource_tel_maison form input ---->
                <div class="form-group">
                	<label for="resource_tel_maison">Téléphone maison:</label>
                	<input type="text" class="form-control" name="resource_tel_maison" />
                </div>
                <!-- resource_tel_bureau form input ---->
                <div class="form-group">
                	<label for="resource_tel_bureau">Téléphone bureau:</label>
                	<input type="text" class="form-control" name="resource_tel_bureau" />
                </div>
                <!-- resource_tel_cel form input ---->
                <div class="form-group">
                	<label for="resource_tel_cel">Téléphone cellulaire:</label>
                	<input type="text" class="form-control" name="resource_tel_cel" />
                </div>
                <!-- resource_tel_pager form input ---->
                <div class="form-group">
                	<label for="resource_tel_pager">Téléavertisseur:</label>
                	<input type="text" class="form-control" name="resource_tel_pager" />
                </div>
                <!-- resource_email form input ---->
                <div class="form-group">
                	<label for="resource_email">Courriel:</label>
                	<input type="text" class="form-control" name="email" />
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Enregistrer</button>
    </form>
@stop

@push('js')
<script src="{{asset('bower_components/bootstrap3-wysihtml5-bower/dist/bootstrap3-wysihtml5.all.min.js')}}"></script>
@endpush

@push('css')
<link rel="stylesheet"
      href="{{asset('bower_components/bootstrap3-wysihtml5-bower/dist/bootstrap3-wysihtml5.min.css')}}">
@endpush