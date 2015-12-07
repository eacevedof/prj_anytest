<?php
$PHP_SELF = $_SERVER["PHP_SELF"];
//bug($_POST,"POST");
?>
<script type="text/javascript">
    function bug(variable)
    {
        console.debug(variable);
    }

    function sel_change()
    {
        var url = "http://localhost/proy_anytest/php_single_files/ajax_jquery.php";
        bug($(this).find("option:selected").text());
        bug($(this).find("option:selected").val());
        //bug(this);
        $.post
        (
            url, 
            { 'choices[]': ["Jon", "Susan"],name: "John", time: "2pm" }, 
            function(data) 
            {
                bug(data);
                bug(this);
                $('#spnAjax').empty();
                $('#spnAjax')
                .html(data);
                //.selectmenu('refresh',true);
                $('#selTestMultiple')
                .empty()
                .html(data);
                bug($('#selTestMultiple'));
                
                //alert("Data Loaded: " + data);
            }
        );
        
    }
    //var sel_change = function(){alert("hola anonimo")}
    //jQuery(document).ready(document_ready());
    //function debe ser una funcion anonima
    //jQuery(document).delegate("#selTestSingle","change",function(){alert("hola")});
    jQuery(document).delegate("#selTestSingle","change",sel_change);
</script>

<h1>TODOS LOS CONTROLES</h1>
<form id="frmTest" name="frmTest" method="post" action="<?echo $PHP_SELF; ?>" enctype="" >
    <table id="tblTest" style="border: 1px solid #5C9425; width: 70%" >
       <tr>
            <td style="border: 1px solid #5C9425" >
                <label for="botBoton" >botBoton </label>
                <input type="button" id="botBoton" name="botBoton" value="botBoton" onclick="" />
            </td>
        </tr>
         
       <tr>
            <td style="border: 1px solid #5C9425" >
            </td>               
            <td style="border: 1px solid #5C9425" >
                <label for="divTest_1" >divTest_1</label>
                <div id="divTest_1" name="divTest_1">
                  
                </div>
            </td>            
        </tr>
       <tr>
            <td style="border: 1px solid #5C9425" >
                <label for="selTestSingle" >selTestSingle</label>
                <select id="selTestSingle" name="selTestSingle" >
                    <option value="" ></option>
                    <option value="v00001" >txt00001</option>
                    <option value="v00002" >txt00002</option>
                    <option value="v00003" selected="" >txt00003</option>
                    <option value="v00004" >txt00004</option>
                    <option value="v00005" >txt00005</option>
                    <option value="v00006" >txt00006</option>
                    <option value="v00007" >txt00007</option>
                </select>
                <span id="spnAjax"></span>
            </td>
            <td style="border: 1px solid #5C9425" >
                <label for="selTestMultiple" >selTestMultiple[]</label>
                <select id="selTestMultiple" name="selTestMultiple[]" multiple size="5" >
                    <option value="" ></option>
                    <option value="Multiple_1" >Multiple 1</option>
                    <option value="Multiple_2" >Multiple 2</option>
                    <option value="Multiple_3" selected="">Multiple 3</option>
                    <option value="Multiple_4" >Multiple 4</option>
                    <option value="Multiple_5" selected="">Multiple 5</option>
                </select>
            </td>            
        </tr>
        <tr>
            <td style="border: 1px solid #5C9425" >
                <label for="imgBotonTest" >imgBotonTest </label>
                <input type="image" id="imgBotonTest" name="imgBotonTest" src="http://www.eduardoaf.com/wp-content/uploads/img_articulos/logo_eduardoaf_com.png" />
            </td>
        </tr>
        <tr>
            <td style="border: 1px solid #5C9425" >
                <label for="subEnvio" >subEnvio </label>
                <input type="submit" id="subEnvio" name="subEnvio" value="subEnvio" onclick="alert(this.id);" />
            </td>
        </tr>
        <tr>
            <td style="border: 1px solid #5C9425" >
                <label for="resReset" >resReset </label>
                <input type="reset" id="resReset" name="resReset" value="resReset" onclick="alert(this.id);" />
            </td>
        </tr>        
    </table>
</form>
