<?php
class HelperGenericButton extends MainHelper
{
    private $_text;
    private $_id;

    public function __construct($sId="", $sText="")
    {
        $this->_control_id = $sId;
        $this->_text = $sText;
    }
   
    public function get_html()
    {
        $sHtmlButton = "<button id=\"$this->_control_id\"";
        if(!empty($this->_js_onclick)) $sHtmlButton .= " onclick=\"$this->_js_onclick\"";
        $sHtmlButton .= ">";
        $sHtmlButton .= $this->_text;
        $sHtmlButton .= "</button>";
        return $sHtmlButton;
    }
    
    public function set_js_onclick($sJs)
    {
        $this->_js_onclick = $sJs;
    }
}

/*
 *             <!--buttons-->
            <div id="divButTop" data-role="controlgroup" data-type="horizontal" >
                <button type="submit" id="butSave" data-theme="b" onclick="oMtb.set_submit_type('save');" data-icon="check" >Guardar</button> 
<?
if(!$isNew):
?>
    <button type="submit" id="butDelete"  data-theme="b" onclick="oMtb.set_submit_type('delete');" data-icon="delete" >Borrar</button>                
<?
endif;
?>
            </div>
            <!--/buttons-->
 
 <div id=\"divButTop\" data-role=\"controlgroup\" data-type=\"horizontal\" >
	<button type=\"submit\" id=\"butSave\" data-theme=\"b\" onclick=\"oMtb.set_submit_type('save');\" data-icon=\"check\" >Guardar</button> 
	<button type=\"submit\" id=\"butDelete\"  data-theme=\"b\" onclick=\"oMtb.set_submit_type('delete');\" data-icon=\"delete\" >Borrar</button>                
</div>

 */