<?php
//$PHP_SELF = $_SERVER["PHP_SELF"];
//bug($_POST,"POST");
?>
<script type="text/javascript">
    function ajax_send_text()
    {
        var sUrlDestino = "http://localhost/proy_anytest/php_single_files/TfwAjax.php";
        var sNombreTxt = 'txtTest';
        var sNombreMulti = 'chkTest[]';
        TfwAjax.send_input_by_post(sUrlDestino, sNombreTxt);
        TfwAjax.get_multi_input_in_json(sNombreMulti);
    }
    
    function boton_on_click()
    {
        TfwCss.set_border('txtTest', '1px', 'solid', 'red');
        TfwCss.set_color('txtTest', 'blue');
        TfwCss.set_display('txtTest','list-item');
        TfwCss.set_list_style('ulListaItem_0', 'decimal inside');
        TfwCss.set_list_style_image('ulListaItem_1', 'html_images/list_item_style.gif');
        TfwCss.set_list_style_type('ulListaItem_2', 'square');
        TfwCss.set_font('ulListaItem_2', 'italic small-caps bold 12px arial,sans-serif');
        TfwCss.set_font_family('ulListaItem_3','courier');
        TfwCss.set_font_family('txtTest','courier');
        TfwCss.set_font_size('txtTest','15px');
        TfwCss.set_font_style('txtTest','italic');
        //TfwCss.set_font_variant('txtTest','small-caps');
        
        //TfwCss.set_font_weight('txtTest','100');
        TfwCss.set_background_color('divTest','yellow');
        TfwCss.set_text_word_spacing('divTest','105px');
        TfwCss.set_border('divTest','medium','double','green');
        //TfwCss.set_whitespace('divTest', 'nowrap');
        
        TfwCss.set_text_letter_spacing('divTest', '10px');
        TfwCss.set_text_transform('divTest','capitalize');
        
        TfwCss.set_height('txaTest', '150px');
        TfwCss.set_width('txaTest','250px');
        TfwCss.set_text_line_height('txaTest','20px');
        TfwCss.set_text_align('txaTest','right');
        TfwCss.set_text_decoration('txaTest', 'overline');
        TfwCss.set_text_indent('txaTest_1', '15px');
        
        TfwCss.set_text_vertical_align('spnTest','-35px');
        
        
        TfwCss.set_text_vertical_align('txaTest_1','sub');
        TfwCss.set_text_vertical_align('txaTest','sub');
        //console.debug(this);
        
        var result = TfwCss.get_border('divTest');
        //console.debug(result);
        
        ajax_send_text();
    }
    
    var on_dom_ready = function()
    {
        var eBoton = document.getElementById('botBoton');
        eBoton.addEventListener('click', boton_on_click, false);
    }
 
    //core.on_dom_content_loaded(on_dom_ready);
    TfwCore.on_dom_content_loaded(on_dom_ready);
</script>
<h1>TODOS LOS CONTROLES</h1>
EN CASO DE ENVIO DE FICHEROS: enctype="multipart/form-data"
<form id="frmTest" name="frmTest" method="post" action="<?echo $PHP_SELF; ?>" enctype="" >
    <table id="tblTest" style="border: 1px solid #5C9425; width: 70%" >
       <tr>
            <td style="border: 1px solid #5C9425" >
                <label for="botBoton" >botBoton </label>
                <input type="button" id="botBoton" name="botBoton" value="botBoton" onclick="" />
            </td>
        </tr>
         
        <tr style="border: 1px solid #5C9425" >
            <td style="border: 1px solid #5C9425" >
                <label for="txtText" >TxtTest</label>
                <input type="text" id="txtTest" name="txtTest" value="value txttest" />
            </td>
            <td style="border: 1px solid #5C9425" >
                <label for="ulLista" >ulLista</label>
                <ul id="ulLista">
                    <li id="ulListaItem_0">ulListaItem_0</li>
                    <li id="ulListaItem_1">ulListaItem_1</li>
                    <li id="ulListaItem_2">ulListaItem_2</li>
                    <li id="ulListaItem_3">ulListaItem_3</li>
                    <li id="ulListaItem_4">ulListaItem_4</li>
                </ul>
            </td>             
        </tr>
        <tr style="border: 1px solid #5C9425" >
            <td style="border: 1px solid #5C9425" >
                <label for="passTest" >passTest</label>
                <input type="password" id="passTest" name="passTest" value="value passTest" />
            </td>
            <td style="border: 1px solid #5C9425" >
                <label for="hidTest" >hidTest</label>
                <input type="hidden" id="hidTest" name="hidTest" value="value hidtest 1" />
            </td>         
        </tr>        
        <tr>
            <td style="border: 1px solid #5C9425" >
                <label for="divTest" >divTest</label>
                <div id="divTest" name="divTest">
                Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. 
                Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, 
                cuando un impresor (N. del T. persona que se dedica a la imprenta) desconocido usó una 
                galería de textos y los mezcló de tal manera que logró hacer un libro de textos 
                <span id="spnTest">
                    especimen. No sólo sobrevivió 500 años, sino que tambien ingresó como texto de relleno
                </span>
                en documentos electrónicos, quedando esencialmente igual al original. Fue popularizado 
                en los 60s con la creación de las hojas "Letraset", las cuales contenian pasajes 
                de Lorem Ipsum, y más recientemente con software de autoedición, como por ejemplo 
                Aldus PageMaker, el cual incluye versiones de Lorem Ipsum.                      
                </div>
            </td>               
            <td style="border: 1px solid #5C9425" >
                <label for="divTest_1" >divTest_1</label>
                <div id="divTest_1" name="divTest_1">
                  
                </div>
            </td>            
        </tr>
        <tr>
            <td style="border: 1px solid #5C9425" >
                <label for="txaTest" >txaTest</label>
                <textarea id="txaTest" name="txaTest" rows="5" cols="5" >Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor (N. del T. persona que se dedica a la imprenta) desconocido usó una galería de textos y los mezcló de tal manera que logró hacer un libro de textos especimen. No sólo sobrevivió 500 años, sino que tambien ingresó como texto de relleno en documentos electrónicos, quedando esencialmente igual al original. Fue popularizado en los 60s con la creación de las hojas "Letraset", las cuales contenian pasajes de Lorem Ipsum, y más recientemente con software de autoedición, como por ejemplo Aldus PageMaker, el cual incluye versiones de Lorem Ipsum.</textarea>
            </td>
            <td style="border: 1px solid #5C9425" >
                <label for="txaTest_1" >txaTest_1</label>
                <textarea id="txaTest_1" name="txaTest_1" rows="5" cols="5" >-</textarea>
            </td>            
        </tr>
        <tr>
            <td style="border: 1px solid #5C9425" >
                <label for="chkTest" >chkTest[]</label>
                <input type="checkbox" id="chkTest_1" name="chkTest[]" value="value in chk 1" /> value 1
                <input type="checkbox" id="chkTest_2" name="chkTest[]" value="value in chk 2" /> value 2
                <input type="checkbox" id="chkTest_3" name="chkTest[]" value="value in chk 3" checked /> value 3
                <input type="checkbox" id="chkTest_4" name="chkTest[]" value="value in chk 4" /> value 4
                <input type="checkbox" id="chkTest_5" name="chkTest[]" value="value in chk 5" /> value 5
            </td>
        </tr>   
        <tr>
            <td style="border: 1px solid #5C9425" >
                <label for="radTest" >radTest</label>
                <input type="radio" id="radTest_1" name="radGroup1" value="value in rad 1_1" /> value 1 de 1
                <input type="radio" id="radTest_2" name="radGroup1" value="value in rad 1_2" /> value 2 de 1
                <input type="radio" id="radTest_3" name="radGroup2" value="value in rad 2_1" checked /> value 1 de 2
                <input type="radio" id="radTest_4" name="radGroup2" value="value in rad 2_2" /> value 2 de 2
                <input type="radio" id="radTest_5" name="radGroup2" value="value in rad 2_3" /> value 3 de 2
            </td>
        </tr>          
        <tr>
            <td style="border: 1px solid #5C9425" >
                <label for="selTestSingle" >selTestSingle</label>
                <select id="selTestSingle" name="selTestSingle" >
                    <option value="" ></option>
                    <option value="Single_1" >Single 1</option>
                    <option value="Single_2" >Single 2</option>
                    <option value="Single_3" selected="" >Single 3</option>
                    <option value="Single_4" >Single 4</option>
                    <option value="Single_5" >Single 5</option>                    
                </select>
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
                <label for="selTestSingleGroup" >selTestSingleGroup</label>
                <select id="selTestSingleGroup" name="selTestSingleGroup" >
                    <optgroup label="mygroup_1" >
                        <option value="" ></option>
                        <option value="Single_1" >Single 1</option>
                        <option value="Single_2" >Single 2</option>
                        <option value="Single_3" selected="" >Single 3</option>
                    </optgroup>
                    <optgroup label="mygroup_2" >
                        <option value="Single_4" >Single 4</option>
                        <option value="Single_5" >Single 5</option>                    
                    </optgroup>
                </select>
            </td>
            <td style="border: 1px solid #5C9425" >
                <label for="selTestMultipleGroup" >selTestMultipleGroup[]</label>
                <select id="selTestMultipleGroup" name="selTestMultipleGroup[]" multiple size="5" >
                    <optgroup label="mygroup_1" >
                        <option value="" ></option>
                        <option value="Multiple_1" >Multiple 1</option>
                        <option value="Multiple_2" >Multiple 2</option>
                    </optgroup>
                    <optgroup label="mygroup_2" >
                        <option value="Multiple_3" selected="">Multiple 3</option>
                        <option value="Multiple_4" >Multiple 4</option>
                        <option value="Multiple_5" selected="">Multiple 5</option>
                    </optgroup>
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
                <label for="fileTest" >fileTest </label>
                <input type="file" id="fileTest" name="fileTest" />
            </td>
            <td style="border: 1px solid #5C9425" >
                <label for="fileTest2" >fileTest2 </label>
                <input type="file" id="fileTest2" name="fileTest2" multiple />
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
