
/**
 * First we will load all of this project's JavaScript
 * dependencies which include jQuery and Bootstrap.
 */

require('./bootstrap');

/**
 * Here comes Application-specific JavaScript.
 */

// Form validation with jquery-validation
$('#submit').click(() => {
    const form = $('form');
    form.validate();
    if (form.valid()) {
        $(this).button('loading');
    }
});

// Sortable Tables with datable.net
$(() => $('table.dataTable').DataTable({
    'language': {
        "sEmptyTable":   	"Keine Daten in der Tabelle vorhanden",
        "sInfo":         	"_START_ bis _END_ von _TOTAL_ Einträgen",
        "sInfoEmpty":    	"0 bis 0 von 0 Einträgen",
        "sInfoFiltered": 	"(gefiltert von _MAX_ Einträgen)",
        "sInfoPostFix":  	"",
        "sInfoThousands":  	".",
        "sLengthMenu":   	"_MENU_ Einträge anzeigen",
        "sLoadingRecords": 	"Wird geladen...",
        "sProcessing":   	"Bitte warten...",
        "sSearch":       	"Suchen",
        "sZeroRecords":  	"Keine Einträge vorhanden.",
        "oPaginate": {
            "sFirst":    	"Erste",
            "sPrevious": 	"Zurück",
            "sNext":     	"Nächste",
            "sLast":     	"Letzte"
        },
        "oAria": {
            "sSortAscending":  ": aktivieren, um Spalte aufsteigend zu sortieren",
            "sSortDescending": ": aktivieren, um Spalte absteigend zu sortieren"
        }
    }
}));