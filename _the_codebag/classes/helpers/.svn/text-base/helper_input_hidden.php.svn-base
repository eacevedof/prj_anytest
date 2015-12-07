<?php
class HelperHidden extends MainHelper
{
    private $_type = "hidden";
    private $_value = "hidValue";
    private $_name = "hidName";
    private $_extras ="";

    public function __construct
    ($sControlId, $sValue="", $extras="")
    {
        $this->_control_id = $sControlId;
        //$this->_value = ComponentText::clean_for_html($sValue);
        $this->_value = $sValue;
        $this->_name = $sControlId;
        $this->_extras = $extras;
        $this->_class = $class;
    }

    //<label for="detm_Empresa">Empresa</label> 
    
    public function get_html()
    {  
        $sHtmlHidden = "";
        $sHtmlHidden .= "<input ";
        $sHtmlHidden .= "type=\"" . $this->_type . "\" ";
        $sHtmlHidden .= "id=\"" . $this->_control_id . "\" ";
        $sHtmlHidden .= "name=\"" . $this->_name . "\" ";
        $sHtmlHidden .= "value=\"" . $this->_value . "\" ";
        //if(!empty($this->_maxlength))
            //$sHtmlHidden .= "maxlength=\"" . $this->_maxlength . "\" ";
        $sHtmlHidden .= $this->_extras ;
        if(!empty($this->_class)) //Puede servir para recuperar en conjunto con jquery
            $sHtmlHidden .= " class=\"" . $this->_class . "\" ";          
        $sHtmlHidden .= ">\n";
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
    
    public function set_class($sValor) 
    {
        $this->_class = $sValor;
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

    public function get_extras()
    {
        return $this->_extras;
    }
    
}