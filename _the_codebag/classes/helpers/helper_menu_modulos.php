<?php
class HelperMenuModulos extends MainHelper
{
    private $_arMenu = array();
    private $_sMenuId;
    private $_sLiBackground;
    private $_sActiveLi;
    private $_sActiveColor;
    
    public function __construct($arModulos,$sBackGroundColor="",$sMenuId="menu-horizontal")
    {
        //echo "constructed "; die;
        $this->_sMenuId = $sMenuId;
        $this->_arMenu = $arModulos;
        $this->_sLiBackground = $sBackGroundColor;
    }

    public function get_html()
    {  
        $sUrl="main.php?module=";
        $sHtmlHorizontalMenu = "";
        foreach($this->_arMenu as $arMenuItem)
        {
            $sMenuTexto = constant($arMenuItem["Description"]);
            $sModulo = $arMenuItem["Name"];
            //$sStyle= "background:#AABBCC";
            if(!empty($this->_sLiBackground)) $sStyle = "background: $this->_sLiBackground";
            if($this->_sActiveLi==$sModulo) $sStyle = "background: $this->_sActiveColor";
            $sUrlModulo = $sUrl . $sModulo; 
            $sHtmlHorizontalMenu .= $this->get_anchored_li($sUrlModulo, $sMenuTexto,$sStyle);
        }
        
        $sHtmlHorizontalMenu = $this->get_ul($sHtmlHorizontalMenu, $this->_sMenuId);
        return $sHtmlHorizontalMenu;
    }

    private function get_ul($sBetweenTags,$sId="",$sStyle="")
    {
        $sHtmlUl = "<ul";
        if(!empty($sId)) $sHtmlUl.=" id=\"$sId\"";
        if(!empty($sStyle)) $sHtmlUl .= " style=\"$sStyle\"";
        $sHtmlUl .= ">$sBetweenTags</ul>\n";
        return $sHtmlUl;
    }
    
    private function get_li($sBetweenTags,$sStyle="")
    {
        $sHtmlLi = "<li";
        if(!empty($sStyle)) $sHtmlLi .= " style=\"$sStyle\" ";
        $sHtmlLi .= ">\n";
        $sHtmlLi .= $sBetweenTags;
        $sHtmlLi .= "</li>\n";
        return $sHtmlLi;
    }
    
    private function get_anchored_li($sUrl,$sText,$sStyle="")
    {
        $sAnchorHtml = "<a href=\"$sUrl\">$sText</a>";
        return $this->get_li($sAnchorHtml,$sStyle);
    }
    
    private function get_html_ul_submenu($arSubmenus)
    {
        $sHtmlUl = "";
        foreach($arSubmenus as $key=>$arSubmenu)
        {
            $sHtmlUl .= $this->get_anchored_li($arSubmenu["url_list"], $arSubmenu["text_list"]);
            $sHtmlUl .= $this->get_anchored_li($arSubmenu["url_new"], $arSubmenu["text_new"]);
        }
        $sHtmlUl = $this->get_ul($sHtmlUl);
        return $sHtmlUl;
    }
 
    public function set_li_background($sBackGroundColor)
    {
        $this->_sLiBackground = $sBackGroundColor;
    }

    public function set_active_module($sModuleName,$sModuleColor="red")
    {
        $this->_sActiveLi = $sModuleName;
        $this->_sActiveColor = $sModuleColor;
    }
    
}