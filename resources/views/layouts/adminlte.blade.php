@extends('adminlte::page')

@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/locales/bootstrap-datepicker.fr-CH.min.js"></script>
<script src="{{asset('bower_components/Inputmask/dist/jquery.inputmask.bundle.js')}}"></script>
<script src="{{asset('bower_components/bootstrap3-wysihtml5-bower/dist/bootstrap3-wysihtml5.all.min.js')}}"></script>
<script src="{{asset('bower_components/typeahead.js/dist/typeahead.bundle.js')}}"></script>
<script src="{{asset('js/app.js')}}"></script>
<script src="{{asset('js/autocomplete.js')}}"></script>
@endpush

@push('css')
<link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css"/>
<link rel="stylesheet"
      href="{{asset('bower_components/bootstrap3-wysihtml5-bower/dist/bootstrap3-wysihtml5.min.css')}}">
<link rel="stylesheet" href="{{asset('css/app.css')}}">
@endpush