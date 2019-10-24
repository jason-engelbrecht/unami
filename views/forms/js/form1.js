var aff = document.getElementById("affiliateName");

function showfield(name)
{
    if(name=='Other')
    {
        document.getElementById('div1').innerHTML='NAMI Affiliate Name: <input type="text" class="form-control" name="other" />';
    }
    else
    {
        document.getElementById('div1').innerHTML='';
    }
}