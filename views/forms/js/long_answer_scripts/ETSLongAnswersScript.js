$(document).ready(function()
{
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
});