<?php
class HelperSubmitButton extends MainHelper
{
    private $_type = "submit";
    private $_save_text = "Guardar";
    private $_delete_text = "Borrar";
    private $_display_save = true;
    private $_display_delete = true;
    private $_display_replan = false;

    public function __construct($sSaveText="Guardar",$sDeleteText="Borrar",$showSave=true,$showDelete=true)
    {
        $this->_save_text = $sSaveText;
        $this->_delete_text = $sDeleteText;
        $this->_display_save = $showSave;
        $this->_display_delete = $showDelete;
    }
   
    private function get_html_delete_submit_button($sId)
    {
        $sOnClick = "oMtb.set_submit_type('delete');";
        $sHtmlDeleteButton = $this->get_html_submit_button("butDelete$sId", $this->_delete_text, $sOnClick, "delete");
        return $sHtmlDeleteButton;
    }    
    
    private function get_html_save_submit_button($sId)
    {
        $sOnClick = "oMtb.set_submit_type('save');";
        $sHtmlSaveButton = $this->get_html_submit_button("butSave$sId", $this->_save_text, $sOnClick);
        return $sHtmlSaveButton;
    }
    
    private function get_html_replan_button($sId)
    {
        $sOnClick = "oMtb.set_submit_type('replan');";
        $sHtmlReplan = $this->get_html_submit_button("butReplan$sId", "Replanificar", $sOnClick);
        return $sHtmlReplan;
    }
    
    
    private function get_html_submit_button($sId="butId",$sText="botón",$sOnClick="",$sDataIcon="check")
    {
        $sHtmlButton = "<button type=\"$this->_type\" id=\"$sId\" data-theme=\"b\" onclick=\"$sOnClick\" data-icon=\"$sDataIcon\" >$sText</button>\n";
        return $sHtmlButton;
    }
 
    private function get_html_div_buttons($sId,$sPosition="Top")
    {
        $sHtmlTopDiv = "<div id=\"$sId\" data-role=\"controlgroup\" data-type=\"horizontal\"  >\n";
        if($this->_display_save)
            $sHtmlTopDiv .= $this->get_html_save_submit_button($sPosition);
        if($this->_display_delete)
            $sHtmlTopDiv .= $this->get_html_delete_submit_button ($sPosition);
        if($this->_display_replan)
            $sHtmlTopDiv .= $this->get_html_replan_button($sPosition);
        $sHtmlTopDiv .= "</div>\n";
        return $sHtmlTopDiv;
    }
    
    public function get_html_top_div()
    {
        return $this->get_html_div_buttons("divTopButtons");
    }

    public function get_html_bottom_div()
    {
        return $this->get_html_div_buttons("divBottomButtons","Bottom");
    }
    public function show_top_div()
    {
        if($this->_display)
            echo $this->get_html_top_div();
    }
    
    public function show_bottom_div()
    {
        if($this->_display)
            echo $this->get_html_bottom_div();
    }
    
    public function display_delete($showIt=true)
    {
        $this->_display_delete = $showIt;
    }
    
    public function display_save($showIt=true)
    {
        $this->_display_save = $showIt;
    }
    
    public function display_replan($showIt=true)
    {
        $this->_display_replan = $showIt;
    }
    //=============== GET ======================  
 
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