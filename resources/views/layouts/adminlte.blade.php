@extends('adminlte::page')

@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/locales/bootstrap-datepicker.fr-CH.min.js"></script>
<script src="{{asset('bower_components/Inputmask/dist/jquery.inputmask.bundle.js')}}"></script>
<script src="{{asset('bower_components/bootstrap3-wysihtml5-bower/dist/bootstrap3-wysihtml5.all.min.js')}}"></script>
<script>
    $('.datepicker').datepicker({
        language: "fr",
        format: 'yyyy-mm-dd',
    });

    $('.datepicker-naissance').datepicker({
        language: "fr",
        format: 'yyyy-mm-dd',
        startView: 3,
        endDate: "0d",
        defaultViewDate: {
            year: "1960",
        }
    });

    $('.datatable').DataTable();

    $('.textarea').wysihtml5({
        toolbar: {
            fa: true
        }
    });

    $('.telephone').inputmask("(999) 999-9999 [x99999]");
    $('.codepostal').inputmask("A9A 9A9");
</script>
@endpush

@push('css')
<link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css"/>
<link rel="stylesheet"
      href="{{asset('bower_components/bootstrap3-wysihtml5-bower/dist/bootstrap3-wysihtml5.min.css')}}">
@endpush