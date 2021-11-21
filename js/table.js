// Call the dataTables jQuery plugin
$(document).ready(function() {
     var domCfg = "<'row'<'col-sm-1'l><'col-sm-3'f><'col-sm-6'>>" +
                 "<'row'<'col-sm-12'tr>>" +
                 "<'row'<'col-sm-5'i><'col-sm-7'p>>";
    $('#table-event').DataTable({
        dom: domCfg
    });
} );