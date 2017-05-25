<div class="box box-primary">
    <div class="box-header">
        <h3 class="box-title">Ajouter une note</h3>
        <div class="box-tools pull-right">
            <!-- This will cause the box to collapse when clicked -->
            <button class="btn btn-box-tool" data-widget="collapse">
                <i class="fa fa-minus"></i>
            </button>
        </div><!-- /.box-tools -->
    </div>
    <div class="box-body">

    {!! Form::open(['url' => '/notes']) !!}
    {{ csrf_field() }}
    {{Form::hidden('notable_type', $notableType)}}
    {{Form::hidden('notable_id', $notableId)}}
    <!--- title form input ---->
        <div class="form-group col-md-6 {{ $errors->first('title', 'has-error') }}">
            {{ Form::label('title', 'Titre:') }}
            {{ Form::text('title', null, ['class' => 'form-control']) }}
        </div>
        <!--- date form input ---->
        <div class="form-group col-md-2 {{ $errors->first('date', 'has-error') }}">
            {{ Form::label('date', 'Date:') }}
            <div class="input-group date datepicker-naissance">
                <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                </div>
                {{ Form::text('date', \Carbon\Carbon::now()->format('Y-m-d'), ['class' => 'form-control pull-right']) }}
            </div>
        </div>
        <!--- text form input ---->
        <div class="form-group col-md-12 {{ $errors->first('text', 'has-error') }}">
            {{ Form::label('text', 'Text:') }}
            {{ Form::textarea('text', null, ['class' => 'form-control textarea', 'row' => '20']) }}
        </div>
        <div class="form-group col-md-12">
            <input type="submit" class="btn btn-primary" value="Ajouter"/>
        </div>
        {{Form::close()}}
    </div>
</div>
