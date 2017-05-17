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

var table = $('.datatable').DataTable({
    language: {
        url: "//cdn.datatables.net/plug-ins/1.10.15/i18n/French.json"
    },
    stateSave: true,
    dom: 'flrtiBp',
    buttons: [
        'copy', 'csv', 'excel', 'pdf'
    ]
});

$('.services-rendus').DataTable({
    language: {
        url: "//cdn.datatables.net/plug-ins/1.10.15/i18n/French.json"
    },
    stateSave: true,
    "order": [[ 3, "desc" ]],
    dom: 'flrtiBp',
    buttons: [
        'copy', 'csv', 'excel', 'pdf'
    ]
});

$(document).ready(function() {
    $('.services-donne').DataTable( {
        language: {
            url: "//cdn.datatables.net/plug-ins/1.10.15/i18n/French.json"
        },
        stateSave: true,
        "order": [[ 3, "desc" ]],
        dom: 'flrtiBp',
        buttons: [
            'copy', 'csv', 'excel', 'pdf'
        ],
        "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;

            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };

            // Total over all pages
            total = api
                .column( 3 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

            // Total over this page
            pageTotal = api
                .column( 3, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

            // Update footer
            $( api.column( 3 ).footer() ).html(
                pageTotal +' ('+ total +' total)'
            );
        }
    } );
} );

$('.textarea').wysihtml5({
    toolbar: {
        fa: true
    }
});

$('.telephone').inputmask("(999) 999-9999 [x99999]");
$('.codepostal').inputmask("A9A 9A9");
