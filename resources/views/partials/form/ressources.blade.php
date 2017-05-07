<div class="box-group" id="ressources">
    <h2><a data-toggle="collapse" data-parent="#ressources" href="#collapse1" aria-expanded="true">Personne ressource
            1</a></h2>
    <div id="collapse1" class="panel-collapse collapse in" aria-expanded="true">
        <div class="row">
            <!--- resource_nom form input ---->
            <div class="form-group col-md-4 {{ $errors->first('resource_nom', 'has-error') }}">
                {{ Form::label('resource_nom', 'Nom complet:') }}
                {{ Form::text('resource_nom', null, ['class' => 'form-control']) }}
            </div>
            <!-- resource_email form input ---->
            <div class="form-group col-md-4 {{ $errors->first('resource_email', 'has-error') }}">
                <label for="resource_email">Courriel:</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                    {{ Form::text('resource_email', null, ['class' => 'form-control']) }}
                </div>
            </div>
            <!--- resource_lien form input ---->
            <div class="form-group col-md-4 {{ $errors->first('resource_lien', 'has-error') }}">
            	{{ Form::label('resource_lien', 'Lien:') }}
            	{{ Form::text('resource_lien', null, ['class' => 'form-control']) }}
            </div>
        </div>

        <div class="row">
            <!--- telephone form input ---->
            <div class="form-group col-md-6">
                {{ Form::label('resource_tel_maison', 'Téléphone maison:') }}
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                    {{ Form::text('resource_tel_maison', null, ['class' => 'form-control telephone']) }}
                </div>
            </div>
            <!--- telephone2 form input ---->
            <div class="form-group col-md-6 {{ $errors->first('resource_tel_bureau', 'has-error') }}">
                {{ Form::label('resource_tel_bureau', 'Bureau:') }}
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                    {{ Form::text('resource_tel_bureau', null, ['class' => 'form-control telephone']) }}
                </div>
            </div>
        </div>
        <div class="row">
            <!--- telephone form input ---->
            <div class="form-group col-md-6">
                {{ Form::label('resource_tel_cel', 'Cellulaire:') }}
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                    {{ Form::text('resource_tel_cel', null, ['class' => 'form-control telephone']) }}
                </div>
            </div>
            <!--- resource_tel_pager form input ---->
            <div class="form-group col-md-6 {{ $errors->first('resource_tel_pager', 'has-error') }}">
                {{ Form::label('resource_tel_pager', 'Téléavertisseur:') }}
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                    {{ Form::text('resource_tel_pager', null, ['class' => 'form-control telephone']) }}
                </div>
            </div>
        </div>
    </div>
    <h2><a data-toggle="collapse" data-parent="#ressources" href="#collapse2" aria-expanded="false">Personne ressource
            2</a></h2>
    <div id="collapse2" class="panel-collapse collapse" aria-expanded="false">
        <div class="row">
            <!--- resource2_nom form input ---->
            <div class="form-group col-md-4 {{ $errors->first('resource2_nom', 'has-error') }}">
                {{ Form::label('resource2_nom', 'Nom complet:') }}
                {{ Form::text('resource2_nom', null, ['class' => 'form-control']) }}
            </div>
            <!-- resource2_email form input ---->
            <div class="form-group col-md-4 {{ $errors->first('resource2_email', 'has-error') }}">
                <label for="resource2_email">Courriel:</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                    {{ Form::text('resource2_email', null, ['class' => 'form-control']) }}
                </div>
            </div>
            <!--- resource2_lien form input ---->
            <div class="form-group col-md-4 {{ $errors->first('resource2_lien', 'has-error') }}">
                {{ Form::label('resource2_lien', 'Lien:') }}
                {{ Form::text('resource2_lien', null, ['class' => 'form-control']) }}
            </div>
        </div>

        <div class="row">
            <!--- telephone form input ---->
            <div class="form-group col-md-6">
                {{ Form::label('resource2_tel_maison', 'Téléphone maison:') }}
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                    {{ Form::text('resource2_tel_maison', null, ['class' => 'form-control telephone']) }}
                </div>
            </div>
            <!--- telephone2 form input ---->
            <div class="form-group col-md-6 {{ $errors->first('resource2_tel_bureau', 'has-error') }}">
                {{ Form::label('resource2_tel_bureau', 'Bureau:') }}
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                    {{ Form::text('resource2_tel_bureau', null, ['class' => 'form-control telephone']) }}
                </div>
            </div>
        </div>
        <div class="row">
            <!--- telephone form input ---->
            <div class="form-group col-md-6">
                {{ Form::label('resource2_tel_cel', 'Cellulaire:') }}
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                    {{ Form::text('resource2_tel_cel', null, ['class' => 'form-control telephone']) }}
                </div>
            </div>
            <!--- resource2_tel_pager form input ---->
            <div class="form-group col-md-6 {{ $errors->first('resource2_tel_pager', 'has-error') }}">
                {{ Form::label('resource2_tel_pager', 'Téléavertisseur:') }}
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                    {{ Form::text('resource2_tel_pager', null, ['class' => 'form-control telephone']) }}
                </div>
            </div>
        </div>
    </div>
    <h2><a data-toggle="collapse" data-parent="#ressources" href="#collapse3" aria-expanded="false">Personne ressource
            3</a></h2>
    <div id="collapse3" class="panel-collapse collapse" aria-expanded="false">
        <div class="row">
            <!--- resource3_nom form input ---->
            <div class="form-group col-md-4 {{ $errors->first('resource3_nom', 'has-error') }}">
                {{ Form::label('resource3_nom', 'Nom complet:') }}
                {{ Form::text('resource3_nom', null, ['class' => 'form-control']) }}
            </div>
            <!-- resource3_email form input ---->
            <div class="form-group col-md-4 {{ $errors->first('resource3_email', 'has-error') }}">
                <label for="resource3_email">Courriel:</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                    {{ Form::text('resource3_email', null, ['class' => 'form-control']) }}
                </div>
            </div>
            <!--- resource3_lien form input ---->
            <div class="form-group col-md-4 {{ $errors->first('resource3_lien', 'has-error') }}">
                {{ Form::label('resource3_lien', 'Lien:') }}
                {{ Form::text('resource3_lien', null, ['class' => 'form-control']) }}
            </div>
        </div>

        <div class="row">
            <!--- telephone form input ---->
            <div class="form-group col-md-6">
                {{ Form::label('resource3_tel_maison', 'Téléphone maison:') }}
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                    {{ Form::text('resource3_tel_maison', null, ['class' => 'form-control telephone']) }}
                </div>
            </div>
            <!--- telephone2 form input ---->
            <div class="form-group col-md-6 {{ $errors->first('resource3_tel_bureau', 'has-error') }}">
                {{ Form::label('resource3_tel_bureau', 'Bureau:') }}
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                    {{ Form::text('resource3_tel_bureau', null, ['class' => 'form-control telephone']) }}
                </div>
            </div>
        </div>
        <div class="row">
            <!--- telephone form input ---->
            <div class="form-group col-md-6">
                {{ Form::label('resource3_tel_cel', 'Cellulaire:') }}
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                    {{ Form::text('resource3_tel_cel', null, ['class' => 'form-control telephone']) }}
                </div>
            </div>
            <!--- resource3_tel_pager form input ---->
            <div class="form-group col-md-6 {{ $errors->first('resource3_tel_pager', 'has-error') }}">
                {{ Form::label('resource3_tel_pager', 'Téléavertisseur:') }}
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                    {{ Form::text('resource3_tel_pager', null, ['class' => 'form-control telephone']) }}
                </div>
            </div>
        </div>
    </div>
</div>