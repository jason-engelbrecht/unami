var aff = document.getElementById("affiliateName");

function showfield(name)
{
    if(name=='Other')
    {
        document.getElementById('div1').innerHTML=
            '                    <div class="form-row justify-content-end">\n' +
            '                        <div class="form-group col-md-4">\n' +
            '                            <input type="text" class="form-control" name="other" id="other" placeholder="Please explain"/>\n' +
            '                        </div>\n' +
            '                    </div>';
    }
    else
    {
        document.getElementById('div1').innerHTML='';
    }
}