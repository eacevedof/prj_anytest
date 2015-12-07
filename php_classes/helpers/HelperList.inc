<?php
class HelperList extends MainHelper
{
    private $_arDataList = array();
    private $_iPage = 1;
    private $_iNumPages = 1;
    private $_iTotalRegs = 0;
    private $_arKeysNames = array();
    private $_sH3FieldName = "";
    private $_arLabels = array();
    
    public function __construct($code_module,
            $arDataList=array(),$arKeysNames=array(), $arLabels=array(), 
            $sH3FieldName="", $iPage=1,$iNumPages=1, $iTotalRegs=0, $code_tab="detail")
    {
        parent::__construct();
        $this->_code_module = $code_module;
        $this->_code_tab = $code_tab;
        $this->_arDataList = $arDataList;
        //La primera vez que se liste $iPage estara en null, se asume que es la primera
        $this->_iPage = $iPage;
        if(empty($this->_iPage)) $this->_iPage = 1;
        $this->_iNumPages = $iNumPages;
        $this->_iTotalRegs = $iTotalRegs;
        $this->_arKeysNames = $arKeysNames;
        $this->_sH3FieldName = $sH3FieldName;
        $this->_arLabels = $arLabels;
        //bug($this,"this");
    }
    
    private function get_html_divider($iNumRows="", $iPagina="", $iNumPaginas="")
    {
        $sHtmlLi = "<li data-role=\"list-divider\" class=\"list_divider\" div_rel=\"\">\n";
        $sHtmlLi .= "<span class=\"ui-li-count\">Resultado: $iNumRows Regs. ";
        if($iNumRows>0)
            $sHtmlLi .= "- Pag. $iPagina / $iNumPaginas ";
        $sHtmlLi .= "</span>\n";
        $sHtmlLi .= "</li>\n";
        return $sHtmlLi;
    }

    private function get_html_p_strong($sTxtStrong)
    {
        $sHtmlP = "<p class=\"ui-li-aside\" style=\"margin:-5px 10px 0px 0px;\">
                        <strong>$sTxtStrong</strong>
                    </p>";
        return $sHtmlP;
    }

    private function get_html_main_tag_h3($sH3Text)
    {
        $sHtmlH3 = "<h3>$sH3Text</h3>";
        return $sHtmlH3;
    }

    private function get_html_p_field_value($sWidth,$sValue)
    {
        $sHtmlP = "<p style=\"margin-top:1px; display:inline; float:left; width:$sWidth%;\">$sValue</p>\n";
        return $sHtmlP;
    }
    
    private function get_html_p_field_values($arValues=array())
    {
        $iValues = count($arValues);
        if($iValues==0) $iValues=1;
        $fWidth = 100 / $iValues;
        $fWidth = number_format($fWidth, 2);
        $sHtmlP = "";
        foreach($arValues as $key=>$sValue)
        {
            $sHtmlP .= $this->get_html_p_field_value($fWidth, $sValue);
        }
        return $sHtmlP;
    }

    public function get_html()
    {
        $iNumRows = $this->_iTotalRegs;
        $sHtmlLiRows = "";
        $sHtmlLiRows .= $this->get_html_divider($iNumRows, $this->_iPage, $this->_iNumPages);
        
        if(!empty($this->_arDataList))
            foreach($this->_arDataList as $iRow=>$arFields)
            {
                $arKeysAndValues = $this->extract_fields_and_values($arFields, $this->_arKeysNames);
                $sHrefPath = $this->get_full_uri_to_nav($this->_code_module, $this->_code_tab, $arKeysAndValues);
                $sStrong = $this->extract_values($arFields, $this->_arKeysNames);
                $sH3Text = $arFields[$this->_sH3FieldName];
                $arValues = $this->extract_values($arFields, $this->_arLabels, 1);
                //bug($arValues); die;
                $sHtmlLiRows .= "<li data-inline=\"true\" divider_rel=\"div_rel\" >\n";
                $sHtmlLiRows .= "<a href=\"$sHrefPath\" ";
                $sHtmlLiRows .= "data-ajax=\"false\" ";
                $sHtmlLiRows .= ">\n";
                $sHtmlLiRows .= $this->get_html_p_strong($sStrong);
                $sHtmlLiRows .= $this->get_html_main_tag_h3($sH3Text);
                $sHtmlLiRows .= $this->get_html_p_field_values($arValues);
                $sHtmlLiRows .= "</a>\n";
                $sHtmlLiRows .= "</li>\n";
            }
        return $sHtmlLiRows;
    }
    

}