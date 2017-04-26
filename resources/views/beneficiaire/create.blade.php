@extends('layouts.adminlte')

@section('title', 'Inscription bénéficiaire')

@section('content_header')
    <h1>Nouveau Bénéficiaire</h1>
@stop

@section('content')
    <form method="POST" action="/beneficiaires">
        {{ csrf_field() }}
        <div class="row">
            <div class="col-md-6">
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
                        <!--- conjoint form input ---->
                        <div class="form-group">
                            <label for="conjoint">Conjoint:</label>
                            <input type="text" class="form-control" name="conjoint"/>
                        </div>
                    </div><!-- /.box-body -->
                    <div class="box-footer">

                    </div><!-- box-footer -->
                </div><!-- /.box -->
            </div>
            <div class="col-md-6">
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
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                    <input type="text" class="form-control telephone" name="telephone"/>
                                </div>
                            </div>
                            <!--- telephone2 form input ---->
                            <div class="form-group col-md-6">
                                <label for="telephone2">Autre téléphone:</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                    <input type="text" class="form-control telephone" name="telephone2"/>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <!--- cellulaire form input ---->
                            <div class="form-group col-md-6">
                                <label for="cellulaire">Cellulaire:</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-mobile-phone"></i></span>
                                    <input type="text" class="form-control telephone" name="cellulaire"/>
                                </div>
                            </div>
                            <!--- email form input ---->
                            <div class="form-group col-md-6">
                                <label for="email">Courriel:</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                    <input type="text" class="form-control" name="email"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Personne ressource 1</h3>
                        <div class="box-tools pull-right">
                            <!-- This will cause the box to collapse when clicked -->
                            <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                                    title="Collapse">
                                <i class="fa fa-minus"></i>
                            </button>
                        </div><!-- /.box-tools -->
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <!-- resource_nom form input ---->
                        <div class="form-group">
                            <label for="resource_nom">Nom complet:</label>
                            <input type="text" class="form-control" name="resource_nom"/>
                        </div>
                        <div class="row">
                            <!-- resource_tel_maison form input ---->
                            <div class="form-group col-md-6">
                                <label for="resource_tel_maison">Téléphone maison:</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                    <input type="text" class="form-control telephone" name="resource_tel_maison"/>
                                </div>
                            </div>
                            <!-- resource_tel_bureau form input ---->
                            <div class="form-group col-md-6">
                                <label for="resource_tel_bureau">Téléphone bureau:</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                    <input type="text" class="form-control telephone" name="resource_tel_bureau"/>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <!-- resource_tel_cel form input ---->
                            <div class="form-group col-md-6">
                                <label for="resource_tel_cel">Téléphone cellulaire:</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-mobile-phone"></i></span>
                                    <input type="text" class="form-control telephone" name="resource_tel_cel"/>
                                </div>
                            </div>
                            <!-- resource_tel_pager form input ---->
                            <div class="form-group col-md-6">
                                <label for="resource_tel_pager">Téléavertisseur:</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-mobile-phone"></i></span>
                                    <input type="text" class="form-control telephone" name="resource_tel_pager"/>
                                </div>
                            </div>
                        </div>
                        <!-- resource_email form input ---->
                        <div class="form-group">
                            <label for="resource_email">Courriel:</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                <input type="text" class="form-control" name="resource_email"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Personne ressource 2</h3>
                        <div class="box-tools pull-right">
                            <!-- This will cause the box to collapse when clicked -->
                            <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                                    title="Collapse">
                                <i class="fa fa-minus"></i>
                            </button>
                        </div><!-- /.box-tools -->
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <!-- resource_nom form input ---->
                        <div class="form-group">
                            <label for="resource_nom">Nom complet:</label>
                            <input type="text" class="form-control" name="resource2_nom"/>
                        </div>
                        <div class="row">
                            <!-- resource_tel_maison form input ---->
                            <div class="form-group col-md-6">
                                <label for="resource_tel_maison">Téléphone maison:</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                    <input type="text" class="form-control telephone" name="resource2_tel_maison"/>
                                </div>
                            </div>
                            <!-- resource_tel_bureau form input ---->
                            <div class="form-group col-md-6">
                                <label for="resource_tel_bureau">Téléphone bureau:</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                    <input type="text" class="form-control telephone" name="resource2_tel_bureau"/>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <!-- resource_tel_cel form input ---->
                            <div class="form-group col-md-6">
                                <label for="resource_tel_cel">Téléphone cellulaire:</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-mobile-phone"></i></span>
                                    <input type="text" class="form-control telephone" name="resource2_tel_cel"/>
                                </div>
                            </div>
                            <!-- resource_tel_pager form input ---->
                            <div class="form-group col-md-6">
                                <label for="resource_tel_pager">Téléavertisseur:</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-mobile-phone"></i></span>
                                    <input type="text" class="form-control telephone" name="resource2_tel_pager"/>
                                </div>
                            </div>
                        </div>
                        <!-- resource_email form input ---->
                        <div class="form-group">
                            <label for="resource_email">Courriel:</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                <input type="text" class="form-control" name="resource2_email"/>
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
        </div>
        <button type="submit" class="btn btn-primary">Enregistrer</button>
    </form>
@stop