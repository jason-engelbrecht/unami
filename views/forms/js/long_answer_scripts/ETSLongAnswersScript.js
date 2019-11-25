$(document).ready(function()
{
    //revealing the convict textarea
    let convict = $("#convictText");
    $("#yesConvict").click(function()
    {
        convict.show();
    });
    $("#noConvict").click(function()
    {
        convict.hide();
    });
    if(document.getElementById('yesConvict').checked)
    {
        convict.show();
    }
    if(document.getElementById('noConvict').checked)
    {
        convict.hide();
    }
});