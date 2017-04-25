@extends('adminlte::page')

@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/locales/bootstrap-datepicker.fr-CH.min.js"></script>
<script>
    $('.datepicker').datepicker({
        language: "fr",
        format: 'yyyy-mm-dd',
    });

    $('.datatable').DataTable();

    $('.textarea').wysihtml5({
        toolbar: {
            fa: true
        }
    });
</script>
@endpush

@push('css')
<link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css"/>
@endpush