$(document).ready(function()
{
    $('#show1').change(function ()
    {
        if(this.checked)
        {
            $('#show2').prop('required', true);
            $('#hide2').prop('required', true);
        }
        else
        {
            $('#show2').prop('required', false);
            $('#hide2').prop('required', false);
        }
    });

    $('#show2').change(function ()
    {
        if(this.checked)
        {
            $('#gender').prop('required', true);
            $('#roommateGender').prop('required', true);
        }
        else
        {
            $('#gender').prop('required', false);
            $('#roommateGender').prop('required', false);
        }
    });

    let singleRoom = $("#singleRoom");
    $("#hide1").click(function()
    {
        singleRoom.hide();
        $("#hide2").removeAttr('required');
        $("#show2").removeAttr('required');
    });

    $("#show1").click(function()
    {
        singleRoom.show();
        $("#hide2").attr('required');
        $("#show2").attr('required');
    });

    if(document.getElementById('show1').checked)
    {
        singleRoom.show();
        $("#hide2").attr('required');
        $("#show2").attr('required');
    }
    if(document.getElementById('hide1').checked)
    {
        singleRoom.hide();
        $("#hide2").removeAttr('required');
        $("#show2").removeAttr('required');
    }

    let daysRooming = $("#daysRooming");
    $("#hide2").click(function()
    {
        daysRooming.hide();
        $("#gender").removeAttr('required');
        $("#roommateGender").removeAttr('required');
    });

    $("#show2").click(function()
    {
        daysRooming.show();
        $("#gender").attr('required');
        $("#roommateGender").attr('required');
    });

    if(document.getElementById('show2').checked)
    {
        daysRooming.show();
        $("#gender").attr('required');
        $("#roommateGender").attr('required');
    }
    if(document.getElementById('hide2').checked)
    {
        daysRooming.hide();
        $("#gender").removeAttr('required');
        $("#roommateGender").removeAttr('required');
    }
});