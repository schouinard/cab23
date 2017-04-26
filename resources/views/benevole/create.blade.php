@extends('layouts.adminlte')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Nouveau Bénévole</h1>
@stop

@section('content')
    <form method="POST" action="/benevoles">
        {{ csrf_field() }}
        <div class="row">
            <div class="col-xs-6">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Informations personnelles</h3>
                        <div class="box-tools pull-right">
                            <!-- This will cause the box to collapse when clicked -->
                            <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                                    title="Collapse">
                                <i class="fa fa-minus"></i>
                            </button>
                        </div><!-- /.box-tools -->
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <div class="form-group">
                            <label for="prenom">Prénom:</label>
                            <input type="text" class="form-control" name="prenom"/>
                        </div>
                        <div class="form-group">
                            <label for="nom">Nom:</label>
                            <input type="text" class="form-control" name="nom"/>
                        </div>

                        <!--- naissance datepicker --->
                        <div class="form-group">
                            <label for="naissance">Naissance:</label>
                            <div class="input-group date datepicker-naissance">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input name="naissance" type="text" class="form-control pull-right"/>
                            </div>
                        </div>
                        <!--- inscription datepicker --->
                        <div class="form-group">
                            <label for="inscription">Inscription:</label>
                            <div class="input-group date datepicker">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input name="inscription" type="text" class="form-control pull-right"
                                       value="{{Carbon\Carbon::today()->toDateString()}}"/>
                            </div>
                        </div>
                        <!--- accepte_ca datepicker --->
                        <div class="form-group">
                            <label for="accepte_ca">Accepté CA:</label>
                            <div class="input-group date datepicker">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input name="accepte_ca" type="text" class="form-control pull-right"/>
                            </div>
                        </div>
                    </div><!-- /.box-body -->
                    <div class="box-footer">

                    </div><!-- box-footer -->
                </div><!-- /.box -->
            </div>
            <div class="col-xs-6">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Contact</h3>
                        <div class="box-tools pull-right">
                            <!-- This will cause the box to collapse when clicked -->
                            <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                                    title="Collapse">
                                <i class="fa fa-minus"></i>
                            </button>
                        </div><!-- /.box-tools -->
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="form-group col-md-8">
                                <label for="adresse">Adresse:</label>
                                <input type="text" class="form-control" name="adresse">
                            </div>
                            <!--- ville form input ---->
                            <div class="form-group col-md-4">
                                <label for="ville">Ville:</label>
                                <input type="text" class="form-control" name="ville" value="Québec"/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="quartier">Quartier:</label>
                                <input type="text" class="form-control" name="quartier"/>
                            </div>
                            <!--- province form input ---->
                            <div class="form-group col-md-4">
                                <label for="province">Province:</label>
                                <input type="text" class="form-control" name="province" value="QC"/>
                            </div>
                            <!--- code_postal form input ---->
                            <div class="form-group col-md-4">
                                <label for="code_postal">Code postal:</label>
                                <input type="text" class="form-control codepostal" name="code_postal"/>
                            </div>
                        </div>
                        <div class="row">
                            <!--- telephone form input ---->
                            <div class="form-group col-md-6">
                                <label for="telephone">Téléphone:</label>
                                <input type="text" class="form-control telephone" name="telephone"/>
                            </div>
                            <!--- telephone2 form input ---->
                            <div class="form-group col-md-6">
                                <label for="telephone2">Autre téléphone:</label>
                                <input type="text" class="form-control telephone" name="telephone2"/>
                            </div>
                        </div>
                        <!--- email form input ---->
                        <div class="form-group">
                            <label for="email">Courriel:</label>
                            <input type="text" class="form-control" name="email"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><label for="remarque">Remarque</label></h3>
                    <div class="box-tools pull-right">
                        <!-- This will cause the box to collapse when clicked -->
                        <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                                title="Collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div><!-- /.box-tools -->
                </div>
                <div class="box-body">
                    <!--- remarque form input ---->
                    <div class="form-group">
                        <textarea name="remarque" class="form-control textarea" rows="10" width="100%"></textarea>
                    </div>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Enregistrer</button>
    </form>
@stop