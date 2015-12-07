<?php
class HelperTextArea extends MainHelper
{
    private $_type = "textarea";
    private $_value = "";
    private $_name;
    private $_maxlength; //Para text

    private $_extras;
    private $_extras_for_label;
    private $_iCols = 40;
    private $_iRows = 8;
    
    public function __construct
    ($sControlId, $sValue="", $label="", $extras="", $iMxlength=-1, $iCols=40, $iRows=8, $class="", $extrasForLabel="")
    {
        $this->_control_id = $sControlId;
        $this->_value = ComponentText::clean_for_html($sValue);
        $this->_name = $sControlId;
        $this->_label = $label;
        $this->_maxlength = $iMaxLength;
        $this->_extras = $extras;
        $this->_class = $class;
        $this->_extras_for_label = $extrasForLabel;
    }
    
    public function get_html()
    {  
        $sHtmlTextArea = "";
        //Una longitud de 0 tiene un comportamiento parecido a un bloqueado
        if($this->_maxlength>-1)
            $this->_js_onkeypress .= " return oMtb.set_max_length(this,$this->_maxlength,event);";
        
        $sClass = $this->get_class_style_from_array();
        $this->_extras_for_label .= $sClass;
        if(!empty($this->_label))
            $sHtmlTextArea .= $this->create_html_label($this->_control_id,$this->_label,$this->_extras_for_label);

        $sHtmlTextArea .= "<$this->_type ";
        $sHtmlTextArea .= "id=\"$this->_control_id\" ";
        $sHtmlTextArea .= "name=\"$this->_name\" ";
        if(!empty($this->_js_onkeypress)) $sHtmlTextArea .= "onkeypress=\"$this->_js_onkeypress\" ";
        $sHtmlTextArea .= "rows=\"$this->_iRows\" ";
        $sHtmlTextArea .= "cols=\"$this->_iCols\" ";
        if($this->_isDisabled) $sHtmlTextArea .= "disabled ";
        if($this->_isReadOnly) $sHtmlTextArea .= "readonly "; 
        if($this->_isRequired) $sHtmlTextArea .= "required "; 
        $sHtmlTextArea .= $sClass;
        if(!empty($this->_style)) $sHtmlTextArea .= "style=\"$this->_style\"";
        if(!empty($this->_extras)) $sHtmlTextArea .= $this->_extras;
        $sHtmlTextArea .= ">";
        $sHtmlTextArea .= $this->_value;
        $sHtmlTextArea .="</$this->_type>\n";

        return $sHtmlTextArea;
    }
 
    public function set_type($sType)
    {
        $this->_type = $sType;
    }
    
    public function set_control_id($sValor)
    {
        $this->_control_id = $sValor;
    }

    public function set_name($sValor)
    {
        $this->_name = $sValor;
    }

    public function set_extras($sValor)
    {
        $this->_extras = $sValor;
    }

    public function set_value($sValue)
    {
        $this->_value = ComponentText::clean_for_html($sValue);
    }
    
    public function set_label($sValue)
    {
        $this->_label = $sValue;
    }
    
    public function set_extras_for_label($sValue)
    {
        $this->_extras_for_label = $sValue;
    }

    //usar javascript para el control de caracteres
    public function set_maxlength($iNumChars)
    {
        $this->_maxlength = $iNumChars;
    }
    

    public function set_keycode($isKeyCode=true)
    {
        $this->_isKeyCode = $isKeyCode;
    }
    
    //=============== GET ======================  
    public function get_control_id()
    {
        return $this->_control_id;
    }

    public function get_name()
    {
        return $this->_name;
    }
   
    public function get_value()
    {
        return $this->_value;
    }

    public function get_class()
    {
        return $this->_class;
    }

    public function get_extras()
    {
        return $this->_extras;
    }
    
    public function get_label()
    {
        return $this->_label;
    }

}
/*
 <label for="detm_Observaciones">Observ.</label>    
 <textarea cols="40" rows="8" name="detm_Observaciones" id="detm_Observaciones" class="clsNormal"><? echo ComponentText::clean_for_html($oMtbCliente->get_observaciones()) ?></textarea>
 */