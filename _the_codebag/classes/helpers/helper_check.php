<?php
class HelperCheck extends MainHelper
{
    private $_type = "checkbox";
   
    private $_arOpciones;
    private $_values_to_check;
    private $_isGrouped;
   
    private $_name;
    private $_extras;
    private $_label;
    private $_legend;
    private $_inFieldsetDiv=true;
    private $_arDisabled;
    private $_cheksPerLine=6;
    
    public function __construct($arOpciones, $sName, $sLegend="", 
            $arValuesToCheck="", $arValuesDisabled="", $class="", $extras="",$isGrouped=true)
    {
        $this->_name = $sName;
        $this->_arOpciones = $arOpciones;
        //bug($arOpciones); die;
        $this->_legend = $sLegend;
        $this->_values_to_check = $arValuesToCheck;
        $this->_arDisabled = $arValuesDisabled;
        $this->_isGrouped = $isGrouped;
        $this->_class = $class;
        $this->_extras = $extras;
    }

    public function get_html()
    {  
        $sHtmlChecks ="";
        $sHtmlFieldSet = "<fieldset style=\"border:0; margin:0; padding:0;\">\n";
        $sHtmlFieldSetEnd = "</fieldset>\n";
  
        if(!empty($this->_legend)) 
        { 
            $sHtmlChecks .= "<legend ";
            //if(!empty($this->_class)) $sHtmlChecks .= $this->_class;
            $sHtmlChecks .=">";
            $sHtmlChecks .= "$this->_legend</legend>\n";
        }
        $i=0;
        foreach($this->_arOpciones as $valor => $label)
        {
            $isChecked = in_array($valor,$this->_values_to_check);
            $isReadOnly = in_array($valor,$this->_arDisabled);
            $id = $this->_name . "_" . $i;
            $id = str_replace("[]","",$id);
            //$isReadOnly = true;
            //si no es el primero y cumple que el resto es uno (el siguiente) se hace un salto
            //bug(($i%($this->_cheksPerLine))==0);
            if(($i%($this->_cheksPerLine))==0 && $i>0) $sHtmlChecks .= "<br />";
            $sHtmlChecks .= $this->generar_check($id, $valor, $label, $isChecked, $isReadOnly);
            //bug($sHtmlChecks); die;
            $i++;            
        }
        if($this->_inFieldsetDiv) $sHtmlChecks = $sHtmlFieldSet.$sHtmlChecks.$sHtmlFieldSetEnd;

        return $sHtmlChecks;
    }

    private function generar_check($id, $valor, $label, $isChecked=false, $isReadOnly=false)
    {
        $this->_id = $id;
        $this->_label = $label;
       
        $sHtmlCheck ="";
        $sHtmlCheck .= "<input ";
        $sHtmlCheck .= "type=\"" . $this->_type . "\" ";
        $sHtmlCheck .= "id=\"$this->_id\" ";
        
        if($this->_isGrouped)  $sHtmlCheck .= "name=\"".$this->_name."\" ";
        else $sHtmlCheck .= "name=\"".$this->_id."\" ";
        
        $sHtmlCheck .= "value=\"$valor\" ";
        if(!empty($this->_js_onclick)) $sHtmlCheck .= " onclick=\"$this->_js_onclick\"";
        if(!empty($this->_class)) $sHtmlCheck .= "class=\"" . $this->_class . "\" ";
        $sHtmlCheck .= $this->_extras ;
        if($isChecked) $sHtmlCheck .= " checked";
        if($isReadOnly) $sHtmlCheck .= " disabled";
        $sHtmlCheck .= " />\n";
        $sHtmlCheck .= $this->create_html_label($this->_id, $label)."\n";

        return $sHtmlCheck;
    }    

    public function set_name($sValor)
    {
        $this->_name = $sValor;
    }

    public function set_value($sValor)
    {
        $this->_value = $sValor;
    }
   
    public function set_values_to_check($arValues)
    {
        $this->_values_to_check = $arValues;
    }

    public function disabled($arValues)
    {
        $this->_arDisabled = $arValues;
    }
    
    public function set_extras($sValor)
    {
        $this->_extras = $sValor;
    }
    
    public function set_legend($sLegend)
    {
        $this->_legend = $sLegend;
    }
    
    public function not_grouped_name($isOn=false)
    {
        $this->_isGrouped = $isOn;
    }
    
    public function set_checks_per_line($iNumChecks)
    {
        $this->_cheksPerLine = $iNumChecks;
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
}