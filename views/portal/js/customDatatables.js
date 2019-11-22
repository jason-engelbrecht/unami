//start other datatables, order by 4th column - date submitted
//save state
$(document).ready( function () {
    $('#dataTable').DataTable({
        "order": [[ 4, "desc" ]],
        "bStateSave": true,
        "fnStateSave": function (oSettings, oData) {
            localStorage.setItem('offersDataTables', JSON.stringify(oData));
        },
        "fnStateLoad": function (oSettings) {
            return JSON.parse(localStorage.getItem('offersDataTables'));
        }
    });
} );

//default sort, start active data table, order by 5th column - date submitted
//also save state
$(document).ready(function() {
    $('#activeDataTable').DataTable( {
        "order": [[ 5, "desc" ]],
        "bStateSave": true,
        "fnStateSave": function (oSettings, oData) {
            localStorage.setItem('offersDataTables', JSON.stringify(oData));
        },
        "fnStateLoad": function (oSettings) {
            return JSON.parse(localStorage.getItem('offersDataTables'));
        }
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

$(document).ready(function() {
    $('#oldTrainingDataTable').DataTable( {
        "bStateSave": true,
        "fnStateSave": function (oSettings, oData) {
            localStorage.setItem('offersDataTables', JSON.stringify(oData));
        },
        "fnStateLoad": function (oSettings) {
            return JSON.parse(localStorage.getItem('offersDataTables'));
        }
    } );
} );

$(document).ready(function() {
    $('#affiliatesDataTable').DataTable( {
        "bStateSave": true,
        "fnStateSave": function (oSettings, oData) {
            localStorage.setItem('offersDataTables', JSON.stringify(oData));
        },
        "fnStateLoad": function (oSettings) {
            return JSON.parse(localStorage.getItem('offersDataTables'));
        }
    } );
} );



