<div class="col-md-12">
    <div class="box box-primary">
        <div class="box-header">
            @if(count($filters))
                <div class="box-title">Cette liste est filtrée
                    <!-- This will cause the box to collapse when clicked -->
                    <form action="" method="post" class="inline">
                        {{method_field('PUT')}}
                        {{csrf_field()}}
                        <button class="btn btn-box-tool inline" data-toggle="tooltip"
                                title="Effacer les filtres">
                            <i class="fa fa-close"></i>
                        </button>
                    </form>

                </div><!-- /.box-tools -->
            @endif
        </div>
        <div class="box-body table-responsive">
            {{ $datatable }}
        </div>
    </div>
</div>