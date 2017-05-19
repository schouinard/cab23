<div class="box box-primary">
    <div class="box-header">
        <h3 class="box-title">{{$note->title}}</h3>
        <div class="box-tools pull-right">
            <!-- This will cause the box to collapse when clicked -->
            <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
                <i class="fa fa-minus"></i>
            </button>
        </div><!-- /.box-tools -->
    </div>
    <div class="box-body">
        {{$note->text}}
    </div>
    <div class="box-footer small">
        Ajoutée <span data-toggle="tooltip" title="{{$note->date}}">{{$note->dateForHumans}}</span>
    </div>
</div>