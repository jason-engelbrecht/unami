$(document).ready(function()
{
    //For revealing the textarea for the relative living with a mental illness question
    let mentalIllness = $("#textbox1");
    $("#show1").click(function()
    {
        mentalIllness.show();
    });
    $("#hide1").click(function()
    {
        mentalIllness.hide();
    });
    if(document.getElementById('show1').checked)
    {
        mentalIllness.show();
    }
    if(document.getElementById('hide1').checked)
    {
        mentalIllness.hide();
    }

    //revealing the convict textarea
    let convict = $("#textbox2");
    $("#hide2").click(function()
    {
        convict.hide();
    });
    $("#show2").click(function()
    {
        convict.show();
    });
    if(document.getElementById('show2').checked)
    {
        convict.show();
    }
    if(document.getElementById('hide2').checked)
    {
        convict.hide();
    }

    //reveals the coFacWhom text area
    let coFacWhom = $("#textbox3");
    $("#hide3").click(function()
    {
        coFacWhom.hide();
    });
    $("#show3").click(function()
    {
        coFacWhom.show();
    });
    if(document.getElementById('show3').checked)
    {
        coFacWhom.show();
    }
    if(document.getElementById('hide3').checked)
    {
        coFacWhom.hide();
    }

    //Reveals the coFacWhere text area
    let coFacWhere = $("#textbox4");
    $("#hide4").click(function()
    {
        coFacWhere.hide();
    });
    $("#show4").click(function()
    {
        coFacWhere.show();
    });
    if(document.getElementById('show4').checked)
    {
        coFacWhere.show();
    }
    if(document.getElementById('hide4').checked)
    {
        coFacWhere.hide();
    }
});