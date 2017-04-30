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

$('.datatable').DataTable({
    language: {
        url: "//cdn.datatables.net/plug-ins/1.10.15/i18n/French.json"
    },
    stateSave: true
});

$('.services-rendus').DataTable({
    language: {
        url: "//cdn.datatables.net/plug-ins/1.10.15/i18n/French.json"
    },
    stateSave: true,
    "order": [[ 3, "desc" ]]
});

$('.textarea').wysihtml5({
    toolbar: {
        fa: true
    }
});

$('.telephone').inputmask("(999) 999-9999 [x99999]");
$('.codepostal').inputmask("A9A 9A9");