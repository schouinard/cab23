<div class="box box-primary collapsed-box">
    <div class="box-header">
        <h3 class="box-title">{{$note->title}}</h3>
        <div class="box-tools pull-right">
            <!-- This will cause the box to collapse when clicked -->
            <button class="btn btn-box-tool" data-widget="collapse">
                <i class="fa fa-plus"></i>
            </button>
            {!! Form::open([
                                            'method'=>'DELETE',
                                            'url' => ['/notes', $note->id],
                                            'style' => 'display:inline'
                                        ]) !!}
            {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Supprimer', array(
                                                'type' => 'submit',
                                                'class' => 'btn btn-danger btn-xs',
                                                'title' => 'Supprimer la note',
                                                'onclick'=>'return confirm("Voulez-vous vraiment supprimer?")'
                                        )) !!}
            {!! Form::close() !!}
        </div><!-- /.box-tools -->
    </div>
    <div class="box-body">
    {!! Form::model($note, [
                                'method' => 'PATCH',
                                'url' => ['notes', $note->id],
                            ]) !!}
    <!---  form input ---->
        <div class="form-group {{ $errors->first('', 'has-error') }}">

            {{ Form::textarea('text', $note->text, ['class' => 'form-control textarea', 'row' => '20']) }}
        </div>
        <button type="submit" class="btn btn-primary">Enregistrer</button>
        {{Form::close()}}

    </div>
    <div class="box-footer small">
        Ajoutée
        @if($note->date == \Carbon\Carbon::today()->format('Y-m-d'))
            aujourd'hui
        @else
            <span data-toggle="tooltip" title="{{$note->date}}">{{$note->dateForHumans}}</span>
        @endif
    </div>
</div>