<?php
class HelperText extends MainHelper
{
    private $_type = "text";
    private $_value = "";
    private $_name;
    private $_maxlength; //Para text

    private $_extras;
    private $_extras_for_label;
    
    public function __construct
    ($sControlId, $sValue="", $label="", $extras="", $iMaxLength="50", $class="", $extrasForLabel="")
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
        $sHtmlInputText = "";
        
        $sDivFieldContain = "<div data-role=\"fieldcontain\">\n";
        $sDivFieldContainEnd = "</div>\n";
        
        $sClass = $this->get_class_style_from_array();
        if(!$this->_classNotForLabel) $this->_extras_for_label .= $sClass;
        if(!empty($this->_label))
            $sHtmlInputText .= $this->create_html_label($this->_control_id,$this->_label,$this->_extras_for_label);

        $sHtmlInputText .= "<input ";
        $sHtmlInputText .= "type=\"$this->_type\" ";
        $sHtmlInputText .= "id=\"$this->_control_id\" ";
        $sHtmlInputText .= "name=\"$this->_name\" ";
        $sHtmlInputText .= "value=\"$this->_value\" ";
        if(!empty($this->_maxlength))$sHtmlInputText .= "maxlength=\"$this->_maxlength\" ";
        if($this->_isDisabled) $sHtmlInputText .= "disabled ";
        if($this->_isReadOnly) $sHtmlInputText .= "readonly "; 
        if($this->_isRequired) $sHtmlInputText .= "required "; 
        if($this->_js_onblur) $sHtmlInputText .= "onblur=\"$this->_js_onblur\" "; 
        
        $sHtmlInputText .= $sClass;
        if(!empty($this->_style)) $sHtmlInputText .= "style=\"$this->_style\" ";
        if(!empty($this->_extras)) $sHtmlInputText .= $this->_extras;
        $sHtmlInputText .= ">\n";

        if($this->_useFieldContain) $sHtmlInputText = $sDivFieldContain.$sHtmlInputText.$sDivFieldContainEnd;
        return $sHtmlInputText;
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