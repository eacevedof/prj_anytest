<?php
class HelperJavascript extends MainHelper
{
    private $_arRequiredFields = array();
    private $_arTxtOnReady = array();
    
    private $_jstxt_funconready_content = "";
    private $_jstxt_required_fields;
    private $_jstxt_between_script_tag;
    
    
    public function __construct()
    {
        parent::__construct();
    }

    private function html_js_open_tag()
    {
        return "<script type=\"text/javascript\">\n";
    }
    
    private function html_js_close_tag()
    {
        return "</script>\n";
    }
    
    public function get_script_tag_with_content($sJsBetweenScriptTag="")
    {
        if(empty($sJsBetweenScriptTag))
           $sJsBetweenScriptTag = $this->_jstxt_between_script_tag; 
        $sJs = $this->html_js_open_tag();
        $sJs .= $sJsBetweenScriptTag;
        $sJs .= "\n";
        $sJs .= $this->html_js_close_tag();
        return $sJs;
    }
    
    public function get_func_on_ready()
    {
        $sJsTxtContent = $this->build_line_sentence($this->_arTxtOnReady);
        $sJs = "function on_ready()\n";
        $sJs .= "{\n";
        $sJs .= $sJsTxtContent;
        $sJs .= "}\n";
        $sJs .= "jQuery(document).ready(on_ready());\n";
        return $sJs;
    }
    
    private function build_line_sentence($arJsSenteceLine=array())
    {
        $sJs = "";
        foreach($arJsSenteceLine as $sJsSentence)
        {
            $sJs .= "\t". $sJsSentence ."\n";
        }
        return $sJs;        
    }
    
    private function set_array_required_fields_as_text()
    {
        $arFieldNames = $this->_arRequiredFields;
        
        $sJs = "oMtb.arRequiredTxt = [";
        $arFields = array();
        foreach($arFieldNames as $sFieldName)
        {
            $arFields[] = "'$sFieldName'";
        }
        $sJson = join(",",$arFields);
        if(!empty($sJson))
            $sJs.=$sJson;
        $sJs .= "];";
        //$sJs como texto por si se desea recuperar esta sentencia js
        $this->_jstxt_required_fields = $sJs;
        //$sJs en el array que se introducira en on_ready
        //$this->_arTxtOnReady[] = $sJs;
        //$sJs = oMtb.arRequiredTxt = ['det_Name','det_Direccion','det_Propietario'];
    }
    
    public function get_document_onready()
    {
        $this->_jstxt_between_script_tag = $this->get_func_on_ready();
        $this->_jstxt_between_script_tag .= $this->get_txt_required_fields();
        return $this->get_script_tag_with_content();
    }
    
    public function get_txt_required_fields()
    {
        $this->set_array_required_fields_as_text();
        return $this->_jstxt_required_fields;
    }
    
    public function show_advisor($sMessage,$iTime=5)
    {
        $this->_arTxtOnReady[] = "oMtb.show_advisor('$sMessage',$iTime);";
    }
    
    public function add_snipet($sJsSnipet)
    {
        $this->_arTxtOnReady[] = $sJsSnipet;
    }
    
    public function set_jsfunc_on_ready_content($sJsTxtContent)
    {
        $this->_jstxt_funconready_content = $sJsTxtContent;
    }    
    
    public function set_js_snipet($sJsScript="")
    {
        $this->_jstxt_between_script_tag = $sJsScript;
    }    
    
    public function set_required_fields($arFormFieldNames=array())
    {
        $this->_arRequiredFields = $arFormFieldNames;
    }
    
    public function add_required_field($sFormField)
    {
        $this->_arRequiredFields[] = $sFormField;
    }    
}