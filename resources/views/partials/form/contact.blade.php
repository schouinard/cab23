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
            <!--- adresse form input ---->
            <div class="form-group col-md-8 {{ $errors->first('adresse', 'has-error') }}">
            	{{ Form::label('adresse', 'Adresse (*):') }}
            	{{ Form::text('adresse', null, ['class' => 'form-control', 'required' => true]) }}
            </div>
            <!--- ville form input ---->
            <div class="form-group col-md-4 {{ $errors->first('ville', 'has-error') }}">
            	{{ Form::label('ville', 'Ville (*):') }}
            	{{ Form::text('ville', 'Québec', ['class' => 'form-control', 'required' => true]) }}
            </div>
        </div>
        <div class="row">
            <!--- quartier form input ---->
            <div class="form-group col-md-4 {{ $errors->first('quartier', 'has-error') }}">
            	{{ Form::label('quartier', 'Quartier:') }}
            	{{ Form::text('quartier', null, ['class' => 'form-control']) }}
            </div>
            <!--- province form input ---->
            <div class="form-group col-md-4 {{ $errors->first('province', 'has-error') }}">
            	{{ Form::label('province', 'Province (*):') }}
            	{{ Form::text('province', 'QC', ['class' => 'form-control', 'required' => true]) }}
            </div>
            <!--- code_postal form input ---->
            <div class="form-group col-md-4 {{ $errors->first('code_postal', 'has-error') }}">
            	{{ Form::label('code_postal', 'Code postal (*):') }}
            	{{ Form::text('code_postal', null, ['class' => 'form-control codepostal', 'required' => true]) }}
            </div>
        </div>
        <div class="row">
            <!--- telephone form input ---->
            <div class="form-group col-md-6">
                {{ Form::label('telephone', 'Téléphone:') }}
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                    {{ Form::text('telephone', null, ['class' => 'form-control telephone']) }}
                </div>
            </div>
            <!--- telephone2 form input ---->
            <div class="form-group col-md-6 {{ $errors->first('telephone2', 'has-error') }}">
            	{{ Form::label('telephone2', 'Autre téléphone:') }}
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                    {{ Form::text('telephone2', null, ['class' => 'form-control telephone']) }}
                </div>
            </div>
        </div>
        <div class="row">
            <!--- cellulaire form input ---->
            <div class="form-group col-md-6">
                <label for="cellulaire">Cellulaire:</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-mobile-phone"></i></span>
                    {{ Form::text('cellulaire', null, ['class' => 'form-control telephone']) }}
                </div>
            </div>
            <!--- email form input ---->
            <div class="form-group col-md-6 {{ $errors->first('email', 'has-error') }}">
                <label for="email">Courriel:</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                    {{ Form::text('email', null, ['class' => 'form-control']) }}
                </div>
            </div>
        </div>
    </div>
</div>