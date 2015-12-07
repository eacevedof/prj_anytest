<?php
class MainHelper
{
    /**
     * @var string index.php
     */
    protected $_start_uri;
    /**
     * @var string index.php?
     */
    protected $_start_uri_for_params = "";
    /**
     * @var string index.php?module=
     */
    protected $_start_uri_with_param_module = "";
    
    //Para crear uri
    protected $_module = "";
    protected $_tab = "";
    protected $_style = "";
    
    protected $_display = true;
    protected $_arClasses = array();
    protected $_class = "";
    protected $_classNotForLabel = false;
    protected $_no_class = false;
    
    //Esto emula el atributo bloqueado. Si esta a true crea el control autoseleccionado con un
    //único valor en los objetos tipo select
    protected $_isReadOnly = false;
    protected $_isRequired = false;
    protected $_isDisabled = false;
    protected $_isKeyCode = false;
    protected $_useFieldContain = false; //<div data-role="fieldcontain">   
    
    protected $_js_onclick = "";
    protected $_js_onchange = "";
    protected $_js_onkeypress = "";
    protected $_js_onblur = "";
    
    protected $oBD = null;
    
    public function __construct()
    {
        //global $oDB;
        //$this->_start_uri = JQ_DOMAIN_URI_HTTPWS_INDEXPHP;
        //$this->_start_uri_for_params = $this->_start_uri."?";
        //$this->_start_uri_with_param_module = $this->_start_uri_for_params."module=";
        //$this->oBD = $oDB;
    }
    
    public function create_html_label($sFor,$sText,$sExtras="")
    {
        return "<label for=\"$sFor\" $sExtras >$sText</label>\n";
    }
    
    protected function concat_param_value($sParamName,$sValue)
    {
        $sValue=urlencode($sValue);
        return "$sParamName=$sValue";
    }  
    
    protected function build_uri_params_with_keys($arKeysAndValues=array())
    {
        $arDestinyKeys = array();
        $sDestinyKeys = "";
        foreach($arKeysAndValues as $sFieldName=>$sValue)
        {
            $arDestinyKeys[]=$this->concat_param_value($sFieldName, $sValue);;
        }
        if(!empty($arDestinyKeys))
            $sDestinyKeys = implode("&",$arDestinyKeys);
        return $sDestinyKeys;
    }
    
    /**
     *
     * @param string $sModule
     * @param string $sTab
     * @param array $arKeysAndValues
     * @return string index.php?module=$codeModule&tab=$sCodeTab&key1=value1&..&keyN=valueN
     */
    protected function get_full_uri_to_nav($sModule,$sTab="",$arKeysAndValues=array())
    {
        $sModule = strtolower($sModule);
        $sTab = strtolower($sTab);
        $sTabParam = "";$sKeysParams = ""; 
        if(!empty($arKeysAndValues))
            $sKeysParams = "&".$this->build_uri_params_with_keys($arKeysAndValues);
        
        if(!empty($sTab))
            $sTabParam = "&".$this->concat_param_value("tab", $sTab);
        
        return $this->_start_uri_with_param_module . "$sModule$sTabParam$sKeysParams";
    }
    
    protected function extract_fields_and_values($arFields, $arFieldNames)
    {
        $arExtracted = array();
        foreach($arFields as $sFieldName=>$sValue)
        {
            if(in_array($sFieldName, $arFieldNames))
                $arExtracted[$sFieldName] = $sValue;
        }
        return $arExtracted;
    }
       
    /**
     * De un array tipo ("fieldname"=>"value") recupera solo los "value" de los "fieldname"
     * indicados en $arFieldNames
     * @param array $arFields
     * @param array $arFieldNames
     * @param boolean $asArray
     * @param string $sSeparator
     * @return mixed Array or String depende de $asArray
     */
    protected function extract_values($arFields, $arFieldNames, $asArray=false, $sSeparator="-")
    {
        $arExtracted = array(); $sExtracted="";
        foreach($arFields as $sFieldName=>$sValue)
            if(in_array($sFieldName, $arFieldNames)) $arExtracted[] = $sValue;

        if(!empty($arExtracted) && !$asArray)
            $sExtracted = join($sSeparator,$arExtracted);
        elseif(empty($arExtracted) && !$asArray)
            $sExtracted = "";
        else
            $sExtracted = $arExtracted;
        return $sExtracted;
    }  
    
    //Pasar a main helper
    protected function get_class_style_from_array()
    {
        if(!$this->_no_class)
        {
            if(!empty($this->_class)) $this->_class .=" ";

            if($this->_isRequired)
            {   
                $this->_class .= "clsRequired";
            }
            elseif($this->_isKeyCode)
            {
                $this->_class .= "clsCode";
            }
            //Solo si no renombro la clase con set_class se toma normal
            //sino se omite y se aplica solamente la asignada desde el set
            elseif(empty($this->_class))
            {
                $this->_class .= "clsNormal";
            }

            $this->_arClasses[] = $this->_class;
            $sClass = join(" ",$this->_arClasses);
            $sClass = trim($sClass);
            $sClass = "class=\"$sClass\" ";
        }
        else
        {
            $sClass = "";
        }
        //bug($sClass); 
        return $sClass;
    }    
    
    public function show()
    {
        if($this->_display)
            echo $this->get_html();
    }
    
    public function display($showIt=true)
    {
        $this->_display = $showIt;
    }    

    public function set_module($sValue)
    {
        $this->_module = $sValue;
    }
    
    public function isDisabled()
    {
        return $this->_isDisabled;
    }
    
    public function set_tab($sValue)
    {
        $this->_tab = $sValue;
    }
    
    public function set_style($sStyle)
    {
        $this->_style = $sStyle;
    }
    
    public function set_class($sValor)
    {
        $this->_class = $sValor;
    }
    
    public function no_class($noClass=true)
    {
        $this->_no_class = $noClass;
    }
    
    public function class_not_for_label($doNot=true)
    {
        $this->_classNotForLabel = $doNot;
    }
    
    public function required($isRequired=true)
    {
        $this->_isRequired = $isRequired;
    }
    
    public function readonly($isReadOnly=true)
    {
        $this->_isReadOnly = $isReadOnly;
    }
    
    public function disabled($isDisabled=true)
    {
        $this->_isDisabled = $isDisabled;
    }
    
    public function use_fieldcontain($useFieldContain=true)
    {
        $this->_useFieldContain = $useFieldContain;
    }
    
    public function add_class($sClass)
    {
        $this->_arClasses[] = $sClass;
    }
    
    public function get_tab()
    {
        return $this->_tab;
    }
    
    public function get_module()
    {
        return $this->_module;
    }
    
    public function set_js_onclick($sJs)
    {
        return $this->_js_onclick = $sJs;
    }
    
    public function set_js_onchange($sJs)
    {
        return $this->_js_onchange = $sJs;
    }
    
    public function set_js_keypress($sJs)
    {
        return $this->_js_onkeypress = $sJs;
    }

    public function set_js_onblur($sJs)
    {
        $this->_js_onblur = $sJs;
    }
    
    protected function get_icon_path($isIcon,$sIconFile)
    {
        $sIconPath = "images/";
        $sIconPath .= $sIconFile;
        if($isIcon && is_file($sIconPath))
        {
            return $sIconPath;
        }    
        return "";    
    }    
}