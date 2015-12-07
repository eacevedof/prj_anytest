<?php
class HelperDate extends MainHelper
{
    private $_type = "date";
    private $_value = "";
    private $_name;
    private $_maxlength; //Para text
    private $_data_role_box = "datebox";
    private $_inFieldsetDiv = true;
    
    //private $_asInpuText = false;
    private $_extras;
    private $_extras_for_label;
    private $_convert_date_before_show = true;

    public function __construct
    ($sControlId, $sValue="", $label="", $extras="", $iMaxLength="", $class="", $extrasForLabel="")
    {
        $this->_control_id = $sControlId;
        $this->_value = $sValue;
        $this->_maxlength  = $iMaxLength;
        $this->_name = $sControlId;
        $this->_label = $label;
        $this->_extras = $extras;
        $this->_class = $class;
        $this->_extras_for_label = $extrasForLabel;
    }

    private function to_user_date($sHydraDate)
    {
        $sUserDate = "";
        if(!empty($sHydraDate))
        {
            //bug($sHydraDate); die; 2001 10 25
            $sYear = substr($sHydraDate,0,4);
            $sMonth = substr($sHydraDate,4,2);
            $sDay = substr($sHydraDate,6,2);
            $sUserDate = "$sDay/$sMonth/$sYear";
            //bug($sHydraDate."-".$sHydraDate);
        }
        return $sUserDate;
    }
    
    public function get_html()
    {  
        if($this->_isReadOnly){$this->_type = "text"; $this->_data_role_box="";}
        $sHtmlFieldSet = "<fieldset data-role=\"controlgroup\" data-type=\"horizontal\">\n";
        $sHtmlFieldSetEnd = "</fieldset>\n";
       
        $sClass = $this->get_class_style_from_array();
        $this->_extras_for_label .= $sClass;
        
        $sHtmlDate = "";
        if(!empty($this->_label))
            $sHtmlDate .= $this->create_html_label($this->_control_id,$this->_label,$this->_extras_for_label);
       
        $sHtmlDate .= "<input ";
        $sHtmlDate .= "type=\"" . $this->_type . "\" ";
        $sHtmlDate .= "id=\"" . $this->_control_id . "\" ";
        $sHtmlDate .= "name=\"" . $this->_name . "\" ";
        if($this->_convert_date_before_show)
            $this->_value = $this->to_user_date($this->_value);
        $sHtmlDate .= "value=\"$this->_value\" ";
        if($this->_isDisabled) $sHtmlDate .= "disabled ";
        if($this->_isReadOnly) $sHtmlDate .= "readonly "; 
        if($this->_isRequired) $sHtmlDate .= "required ";         
        if(!empty($this->_data_role_box)) $sHtmlDate .= "data-role=\"$this->_data_role_box\" ";        
        if(!empty($this->_maxlength)) $sHtmlDate .= "maxlength=\"" . $this->_maxlength . "\" ";
        $sHtmlDate .= $this->_extras ;
        if(!empty($this->_class)) //Para text
            $sHtmlDate .= " class=\"" . $this->_class . "\" ";          
        $sHtmlDate .= ">\n";
        
        if($this->_inFieldsetDiv)
            $sHtmlDate = $sHtmlFieldSet.$sHtmlDate.$sHtmlFieldSetEnd;
        
        return $sHtmlDate;
    }
   
 
    public function set_control_id($sValor)
    {
        $this->_control_id = $sValor;
    }

    public function set_name($sValor)
    {
        $this->_name = $sValor;
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

    public function set_today()
    {
        $this->_convert_date_before_show = false;
        $this->_value = date("d/m/Y");
    }


    public function in_fieldsetdiv($isOn=true)
    {
        $this->_inFieldsetDiv = $isOn;
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
            <fieldset data-role="controlgroup" data-type="horizontal">
                    <label for="det_DateP" class="clsRequired" >Fecha</label>    
                    <input type="date" data-role="datebox" name="det_DateP" id="det_DateP" 
                           value="<? echo (!$isNew) ? to_user_date($oActivity->get_datep()) : $oSite->get_today_date(); ?>" 
                            required <?echo (!$isNew)? "readonly":""; ?> class="clsRequired" />
                </fieldset>
 */