$(document).ready(function()
{
    let specialNeedsYes = $("#specialNeedsYes");
    let specialNeedsNo = $("#specialNeedsNo");
    let specialNeedsText = $("#specialNeedsText");

    specialNeedsNo.click(function()
    {
        specialNeedsText.hide();
    });
    specialNeedsYes.click(function()
    {
        specialNeedsText.show();
    });
    if(document.getElementById("specialNeedsYes").checked)
    {
        specialNeedsText.show();
    }
    if(document.getElementById("specialNeedsNo").checked)
    {
        specialNeedsText.hide();
    }

    let serviceAnimalYes = $("#serviceAnimalYes");
    let serviceAnimalNo = $("#serviceAnimalNo");
    let serviceAnimalText = $("#serviceAnimalText");

    serviceAnimalNo.click(function()
    {
        serviceAnimalText.hide();
    });
    serviceAnimalYes.click(function()
    {
        serviceAnimalText.show();
    });
    if(document.getElementById("serviceAnimalYes").checked)
    {
        serviceAnimalText.show();
    }
    if(document.getElementById("serviceAnimalNo").checked)
    {
        serviceAnimalText.hide();
    }

    let movementDisabilityYes = $("#movementDisabilityYes");
    let movementDisabilityNo = $("#movementDisabilityNo");
    let movementDisabilityText = $("#movementDisabilityText");

    movementDisabilityNo.click(function()
    {
        movementDisabilityText.hide();
    });
    movementDisabilityYes.click(function()
    {
        movementDisabilityText.show();
    });
    if(document.getElementById("movementDisabilityYes").checked)
    {
        movementDisabilityText.show();
    }
    if(document.getElementById("movementDisabilityNo").checked)
    {
        movementDisabilityText.hide();
    }

    let singleRoom = $("#singleRoom");
    let daysRooming = $("#daysRooming");

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
            $('#gender').prop('required', false);
            $('#roommateGender').prop('required', false);
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

    $("#hide1").click(function()
    {
        singleRoom.hide();
        daysRooming.hide();
        $("#hide2").removeAttr('required');
        $("#show2").removeAttr('required');
        $("#gender").removeAttr('required');
        $("#roommateGender").removeAttr('required');
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
        daysRooming.hide();
        $("#hide2").removeAttr('required');
        $("#show2").removeAttr('required');
        $("#gender").removeAttr('required');
        $("#roommateGender").removeAttr('required');
    }

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

    if(document.getElementById('show2').checked && document.getElementById('show1').checked)
    {
        daysRooming.show();
        $("#gender").attr('required');
        $("#roommateGender").attr('required');
    }
    if(document.getElementById('hide2').checked || document.getElementById('hide1').checked)
    {
        daysRooming.hide();
        $("#gender").removeAttr('required');
        $("#roommateGender").removeAttr('required');
    }
});