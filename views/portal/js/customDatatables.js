//start other datatables, order by 4th column - date submitted
$(document).ready( function () {
    $('#dataTable').DataTable({
        "order": [[ 4, "desc" ]],
    });
} );

//default sort, start active data table, order by 5th column - date submitted
$(document).ready(function() {
    $('#activeDataTable').DataTable( {
        "order": [[ 5, "desc" ]],
    } );
} );

//searchable status cards on active applications
$(document).ready( function () {
    var table = $('#activeDataTable').DataTable();
    $('.statusButtons').click(function (){
        let value = $(this).data("value");
        table.search(value).draw();
    });
} );

//^^ hover animation
$(document).ready(function() {
    $( ".statusCards" ).hover(
        function() {
            $(this).addClass('shadow-lg').css('cursor', 'pointer');
        }, function() {
            $(this).removeClass('shadow-lg');
        }
    );
});

