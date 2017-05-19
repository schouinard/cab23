<div class="col-md-12">
    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">Filtres</h3>
            <div class="box-tools pull-right">
                <!-- This will cause the box to collapse when clicked -->
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                    <i class="fa fa-minus"></i>
                </button>
            </div><!-- /.box-tools -->
        </div>
        <div class="box-body">
            <form action="" method="post">
                {{ method_field('PUT') }}
                {{ csrf_field() }}

                {{ $inputFilters }}

                <div class="form-group col-md-12">
                    <input type="submit" class="btn btn-primary" value="Filtrer"/>
                </div>
            </form>
        </div>
    </div>
</div>