<?php
class HelperJavascript extends MainHelper
{
    private $_sSubPathPlugin = "";
    private $_sSubPathJs = "";
    private $_sSubPathExt = "";
    
    private $_arPathFiles = array("type"=>"custom|jquery","filename");
    private $_arJsLines = array();
    
    public function __construct($sSubPathExt="", $arSubPathFiles=array())
    {
        parent::__construct();
        $this->_arPathFiles = $arSubPathFiles;
        $this->_sSubPathJs = TFW_SUBPATH_JSDS;
        $this->_sSubPathPlugin = TFW_SUBPATH_PLUGINDS;
        $this->_sSubPathExt = $sSubPathExt;
    }
    
    private function add_filesrc($sFileName,$sType,$sPath)
    {
        //$sPath = "js/";
        if(!strpos($sFileName,".js"))$sFileName .= ".js";
        if(!empty($sType)) $sPath .= "$sType/";
        $sPath .= $sFileName;
        if(!in_array($sPath, $this->_arPathFiles))
            $this->_arPathFiles[] = $sPath; 
    }
    
    private function html_js_open_tag()
    {
        return "<script type=\"text/javascript\">\n";
    }
    
    private function html_js_close_tag()
    {
        return "</script>\n";
    }
    
    private function html_lines_between_tags()
    {
        $sLines = "";
        foreach($this->_arJsLines as $sLine)
            $sLines .= $sLine ."\n";
        return $sLines;
    }
    
    public function get_script_tag_with_content()
    {
        $sJs = $this->html_js_open_tag();
        $sJs .= $this->html_lines_between_tags();
        $sJs .= $this->html_js_close_tag();
        return $sJs;
    }
    
    public function show_script_tag_with_content()
    {
        echo $this->get_script_tag_with_content();
    }
    
    public function add_file($sFilePath)
    {
        $this->_arPathFiles[] = $sFilePath;
    }

    public function add_tfw_filesrc($sFileName,$sType="custom")
    {
        $this->add_filesrc($sFileName,$sType,$this->_sSubPathJs);
    }

    public function add_plug_filesrc($sFolderName,$sFileName)
    {
        $sPath = $this->_sSubPathPlugin.$sFolderName.TFW_DS."js".TFW_DS;
        $this->add_filesrc($sFileName,null,$sPath); 
    }
    
    public function add_ext_filesrc($sFileName,$sSubPath="")
    {
         if(empty($this->_sSubPathExt))
            if(empty($sSubPath))$sSubPath = "js".TFW_DS;
        else
            $sSubPath = $this->_sSubPathExt;
        $this->add_filesrc($sFileName,null,$sSubPath);
    }
    
    public function add_js_line($sScriptLine)
    {
        $this->_arJsLines[] = $sScriptLine;
    }
    
    private function get_html_tag_script_link($sSrcPath)
    {
        $sScriptTag = "";
        if(!empty($sSrcPath))
        $sScriptTag = "<script type=\"text/javascript\" src=\"$sSrcPath\"></script>\n";
        return $sScriptTag;
    }
    
    public function get_html_tag_links()
    {
        $sLinks = "";
        foreach($this->_arPathFiles as $sSrcPath)
        {
            $sLinks .= $this->get_html_tag_script_link($sSrcPath);
        }
        return $sLinks;
    }
    
    public function show_tag_links()
    {
        echo $this->get_html_tag_links();
    }
    
    public function set_path_files($arPaths=array())
    {
        $this->_arPathFiles = $arPaths;
    }
 }