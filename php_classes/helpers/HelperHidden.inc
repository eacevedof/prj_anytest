<?php
class HelperHidden extends MainHelper
{
    private $_type = "hidden";
    private $_value = "";
    private $_name;

    private $_extras;
    private $_extras_for_label;

    public function __construct
    ($sControlId, $sValue="", $label="", $extras="", $class="", $extrasForLabel="")
    {
        $this->_control_id = $sControlId;
        $this->_value = $sValue;
        $this->_name = $sControlId;
        $this->_label = $label;
        $this->_extras = $extras;
        $this->_class = $class;
        $this->_extras_for_label = $extrasForLabel;
    }

    //<label for="detm_Empresa">Empresa</label> 
    
    public function get_html()
    {  
        $sHtmlHidden = "";
        if(!empty($this->_label))
        {
            $sHtmlHidden .= $this->create_html_label($this->_control_id,$this->_label,$this->_extras_for_label);
        }
       
        $sHtmlHidden .= "<input ";
        $sHtmlHidden .= "type=\"" . $this->_type . "\" ";
        $sHtmlHidden .= "id=\"" . $this->_control_id . "\" ";
        $sHtmlHidden .= "name=\"" . $this->_name . "\" ";
        $sHtmlHidden .= "value=\"" . $this->_value . "\" ";
        //if(!empty($this->_maxlength))
            //$sHtmlHidden .= "maxlength=\"" . $this->_maxlength . "\" ";
        $sHtmlHidden .= $this->_extras ;
        //if(!empty($this->_class)) //Para text
            //$sHtmlHidden .= " class=\"" . $this->_class . "\" ";          
        $sHtmlHidden .= ">\n\r";
        return $sHtmlHidden;
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
        $this->_value = $sValue;
    }
    
    public function set_label($sValue)
    {
        $this->_label = $sValue;
    }
    
    public function set_extras_for_label($sValue)
    {
        $this->_extras_for_label = $sValue;
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