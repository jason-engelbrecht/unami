//start datatables
$(document).ready( function () {
    $('#dataTable').DataTable();
} );

//searchable status cards on active applications
$(document).ready( function () {
    var table = $('#dataTable').DataTable();
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

//default sort
$(document).ready(function() {
    $('#activeDataTable').DataTable( {
        "order": [[ 5, "asc" ]]
    } );
} );
