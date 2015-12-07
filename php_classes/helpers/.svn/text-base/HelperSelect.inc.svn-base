<?php
class HelperSelect extends MainHelper
{
    private $_arOptions;
    private $_mx_value_to_select = "";
    private $_selected_as_hidden ="";
    
    private $_name;
    private $_isMultiple;
    private $_size;
    
    private $_extras;
    private $_extras_for_label;
    private $_null_option = "";

    public function __construct
    ($arOptions, $sControlId, $label="",$mxValueToSelect ="", $isMultiple=false,
    $size="1", $extras="", $class="", $extrasForLabel="", $isReadOnly=false)
    {
        //$this->add_blank_item($arOptions, "", "");
        $this->_arOptions = $arOptions;
        //array or string
        $this->_mx_value_to_select = $mxValueToSelect;
        
        $this->_control_id = $sControlId;
        $this->_isMultiple = $isMultiple;
        $this->_name = $sControlId;
        $this->_size = $size;
        $this->_label = $label;
        $this->_extras = $extras;
        $this->_class = $class;
        $this->_extras_for_label = $extrasForLabel;
        $this->_isReadOnly = $isReadOnly;
    }

    //<label for="detm_Empresa">Empresa</label> 
    
    public function get_html()
    {  
        $sHtmlSelect = "";
        
        $sDivFieldContain = "<div data-role=\"fieldcontain\">\n";
        $sDivFieldContainEnd = "</div>\n";        
        
        $sClass = $this->get_class_style_from_array();
        if(!$this->_classNotForLabel) $this->_extras_for_label .= $sClass;        
        if(!empty($this->_label))
            $sHtmlSelect .= $this->create_html_label($this->_control_id,$this->_label,$this->_extras_for_label);
       
        $sHtmlSelect .= "<select ";
        $sHtmlSelect .= "id=\"$this->_control_id\" ";
        
        if($this->_isMultiple) $sHtmlSelect .= "name=\"$this->_name[]\" ";
        else $sHtmlSelect .= "name=\"$this->_name\" ";
        
        $sHtmlSelect .= "size=\"$this->_size\" ";
        if($this->_isMultiple) $sHtmlSelect .= "multiple ";
        if($this->_isDisabled) $sHtmlSelect .= "disabled ";
        //if($this->_isReadOnly) $sHtmlSelect .= "readonly "; no existe esta propiedad para select
        if($this->_isRequired) $sHtmlSelect .= "required "; 
        if(!empty($this->_js_onchange)) $sHtmlSelect .= "onchange=\"$this->_js_onchange\" ";
        if(!empty($this->_extras)) $sHtmlSelect .= $this->_extras ;
        $sHtmlSelect .= " $sClass>\n";
        
        if(!is_array($this->_mx_value_to_select)) $mxValueToSelect = (string)$this->_mx_value_to_select;
        else $mxValueToSelect = $this->_mx_value_to_select;
        
        //No es readonly
        if(!$this->_isReadOnly)        
        {
            if(!$this->_isMultiple)
            {    
                foreach($this->_arOptions as $valor=>$texto)
                {
                    $sOptionValue = (string)$valor;
                    $isSelected = ($mxValueToSelect==$sOptionValue);
                    $sHtmlSelect .= $this->generar_option($valor, $texto, $isSelected);
                }
            }
            //Multiple
            else
            {
                //if($this->_name=="sch_Meses") bug("is multiple"); bug(is_array($this->_mx_value_to_select),"is array");
                //mxValue puede ser array o no
                foreach($this->_arOptions as $valor=>$texto)
                {
                    if(is_array($mxValueToSelect))
                        $isSelected = in_array($valor, $mxValueToSelect);
                        //if($this->_name=="sch_Meses") bug($texto,"texto en options")
                    else
                        $isSelected = ($mxValueToSelect==((string)$valor));
                    $sHtmlSelect .= $this->generar_option($valor, $texto, $isSelected);
                }
            }
        }
        //ReadOnly=true
        else
        {
            if(!$this->_isMultiple)
            {
                
                //Hay dos opciones y una es vacia.
                if(count($this->_arOptions)<=2 && key_exists("", $this->_arOptions))
                {
                    unset($this->_arOptions[""]);
                    $arItemReadonly = $this->_arOptions;
                }   
                else
                {    
                    //recupera el valor de autoselección
                    $arItemReadonly = $this->get_item_readonly($this->_arOptions, $mxValueToSelect);
                }
                foreach($arItemReadonly as $sValue => $sText)
                    $sHtmlSelect .= $this->generar_option($sValue, $sText, true);
            }
            //es multiple
            else
            {
                //bug("is multiple"); bug(is_array($this->_isMultiple),"is multiple");
                //Falta implementar
            }
        }
       
        $sHtmlSelect .= "</select>\n";
        $sHtmlSelect .= $this->_selected_as_hidden;
        if($this->_useFieldContain) $sHtmlSelect = $sDivFieldContain.$sHtmlSelect.$sDivFieldContainEnd;
        return $sHtmlSelect;
    }
   
    private function get_item_readonly($arOptions,$sValueToSelect)
    {
        $arItemReadOnly = array(""=>"");
        foreach($arOptions as $sValue=>$sText)
        {
            if($sValueToSelect == (string)$sValue)
            {    
                $arItemReadOnly = array($sValue=>$sText);
                return $arItemReadOnly;
            }
        }
        return $arItemReadOnly;
    }
    
    private function generar_option($sValor,$sTexto,$isSelected=false)
    {
        $sOption = "";
        $sOption .= "\t<option ";
        $sOption .= "value=\"$sValor\" ";
        if($isSelected) $sOption .= "selected ";
        $sOption .= ">";
        $sOption .= $sTexto;                  
        $sOption .= "</option>\n";
       
        return $sOption;
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

    public function set_value_to_select($sValue)
    {
        $this->_mx_value_to_select = $sValue;
    }
    
    public function set_label($sValue)
    {
        $this->_label = $sValue;
    }
    
    public function set_extras_for_label($sValue)
    {
        $this->_extras_for_label = $sValue;
    }
    
    public function set_null_option_text($sValue)
    {
        $this->_null_option = $sValue;
    }
    /**
     * Usar en caso de aplicar el atributo disabled: set_extras("disabled");
     */
    public function set_selected_value_as_hidden_on()
    {
        $sName = $this->_control_id;
        $sValue = $this->_mx_value_to_select;
        $this->_selected_as_hidden = "<input type=\"hidden\" name=\"$sName\" id=\"$sName\" value=\"$sValue\" />\n";
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
    
    public function get_selected_value()
    {
        return $this->_mx_value_to_select;
    }
    
    public function get_label()
    {
        return $this->_label;
    }
    
}

