$(document).ready(function()
{
    //For revealing the textarea for the trained question
    let trained = $("#textbox1");
    $("#show1").click(function()
    {
        trained.show();
    });
    $("#hide1").click(function()
    {
        trained.hide();
    });
    if(document.getElementById('show1').checked)
    {
        trained.show();
    }
    if(document.getElementById('hide1').checked)
    {
        trained.hide();
    }

    //revealing the convict textarea
    let certified = $("#textbox2");
    $("#hide2").click(function()
    {
        certified.hide();
    });
    $("#show2").click(function()
    {
        certified.show();
    });
    if(document.getElementById('show2').checked)
    {
        certified.show();
    }
    if(document.getElementById('hide2').checked)
    {
        certified.hide();
    }
});