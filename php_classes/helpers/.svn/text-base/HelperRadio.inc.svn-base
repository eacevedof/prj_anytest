<?php
class HelperRadio extends MainHelper
{
    private $_type = "radio";
   
    private $_arOpciones;
    private $_value_to_check;
   
    private $_name;
    private $_extras;
    private $_label = "";
    private $_inFieldsetDiv=true;
    
    public function __construct($arOpciones, $sNombreGrupo, $sLabel="", $sValueToCheck="", $class="", $extras="")
    {
        $this->_arOpciones = $arOpciones;
        $this->_value_to_check = $sValueToCheck;
       
        $this->_name = $sNombreGrupo;
        $this->_label = $sLabel;

        $this->_class = $class;
        $this->_extras = $extras;
    }

    public function get_html()
    {  
        $sHtmlFieldSet = "<fieldset data-role=\"controlgroup\" data-type=\"horizontal\">\n";
        $sHtmlFieldSetEnd = "</fieldset>\n";
        
        $sClass = $this->get_class_style_from_array();
        $this->_extras_for_label .= $sClass;        
        
        $sHtmlRadio ="";
        if(!empty($this->_label)) $sHtmlRadio .= "<legend $this->_extras_for_label><b>$this->_label</b></legend>\n";

        $i=0;
        foreach($this->_arOpciones as $valor => $label)
        {
            $isChecked = ($this->_value_to_check == $valor);
            $id = $this->_name . "_" . $i;
            $id = str_replace("[]","",$id);
            $sHtmlRadio .= $this->generar_radio($id, $valor, $label, $isChecked);
            $i++;            
        }
        if($this->_inFieldsetDiv)
            $sHtmlRadio = $sHtmlFieldSet.$sHtmlRadio.$sHtmlFieldSetEnd;
        return $sHtmlRadio;
    }

    private function generar_radio($id, $valor, $label, $isChecked=false)
    {
        $this->_id = $id;
        $this->_label = $label;
       
        $sHtmlRadio ="";
        $sHtmlRadio .= "<input ";
        $sHtmlRadio .= "type=\"" . $this->_type . "\" ";
        $sHtmlRadio .= "id=\"$id\" ";
        $sHtmlRadio .= "name=\"" . $this->_name . "\" ";
        $sHtmlRadio .= "value=\"$valor\" ";
        if(!empty($this->_class)) $sHtmlRadio .= "class=\"" . $this->_class . "\" ";
        $sHtmlRadio .= $this->_extras ;
        if($isChecked)
        {
            $sHtmlRadio .= " checked" ;
        }
        $sHtmlRadio .= " />\n";
        $sHtmlRadio .= $this->create_html_label($id, $label)."\n";

        return $sHtmlRadio;
    }    
   
    public function set_id($sValor)
    {
        $this->_id = $sValor;
    }

    public function set_name($sValor)
    {
        $this->_name = $sValor;
    }

    public function set_value($sValor)
    {
        $this->_value = $sValor;
    }
   
    public function set_value_to_check($sValor)
    {
        $this->_value_to_check = $sValor;
    }

    public function set_extras($sValor)
    {
        $this->_extras = $sValor;
    }
    
    public function set_label($sValor)
    {
        $this->_label = $sValor;
    }
    
    //=============== GET ======================  
    public function get_id()
    {
        return $this->_id;
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
}