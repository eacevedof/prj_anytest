<?php
class HelperHorizontalMenu extends MainHelper
{
    private $_arMenu = array();
    //private $_menu_i = "";
    private $_menu_texto;
    //private $_menu_url = "";
    private $_menu_nodo_link;
    private $_submenu_texto;
    private $_submenu_url;
    private $_menu_id;
    
    
    public function __construct($sMenuId,$arMenu,$sMenuTexto,$sMenuNodoLink,$sSubTexto,$sSubUrl)
    {
        //echo "constructed "; die;
        $this->_menu_id = $sMenuId;
        $this->_arMenu = $arMenu;
        $this->_menu_texto = $sMenuTexto;
        $this->_menu_nodo_link = $sMenuNodoLink;
        $this->_submenu_texto = $sSubTexto;
        $this->_submenu_url = $sSubUrl;
    }

    //<label for="detm_Empresa">Empresa</label> 
    
    public function get_html()
    {  
        
        $sHtmlHorizontalMenu = "";
        foreach($this->_arMenu as $arMenuItem)
        {
            $arSubmenus = $this->get_array_for_submenu($arMenuItem);
            //bug($arSubmenus);
            $sMenuTexto = $arMenuItem[$this->_menu_texto];
            $sSubmenu = $this->get_html_ul_submenu($arSubmenus);
            $sHtmlHorizontalMenu .= $this->get_li($sMenuTexto.$sSubmenu);
        }
        $sHtmlHorizontalMenu = $this->get_ul($sHtmlHorizontalMenu,$this->_menu_id);
        return $sHtmlHorizontalMenu;
    }

    private function get_ul($sBetweenTags,$sId="")
    {
        $sHtmlUl = "<ul";
        if(!empty($sId)) $sHtmlUl.=" id=\"$sId\"";
        $sHtmlUl .= ">$sBetweenTags</ul>\n";
        return $sHtmlUl;
    }
    
    private function get_li($sBetweenTags)
    {
        return "<li>$sBetweenTags</li>\n";
    }
    
    private function get_anchored_li($sUrl,$sText)
    {
        $sAnchorHtml = "<a href=\"$sUrl\">$sText</a>";
        return $this->get_li($sAnchorHtml);
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
    
    private function get_array_for_submenu($arMenuItem)
    {
        /**
         *nuevo: http://localhost/proy_adeccomapas/web/main.php?module=users&view=new
listado: http://localhost/proy_adeccomapas/web/main.php?module=users 
         */
        $arReturn = array();
        $arSubmenus = $arMenuItem[$this->_menu_nodo_link];
        foreach($arSubmenus as $sKey =>$arSubmenu)
        {
            $sUrlList = "main.php?module=".$arSubmenu[$this->_submenu_url];
            $sUrlNew = $sUrlList."&view=new";
            $arReturn[$sKey]["url_list"] = $sUrlList;
            $arReturn[$sKey]["url_new"] = $sUrlNew;
            $arReturn[$sKey]["text_list"] = "listado ". $arSubmenu[$this->_submenu_texto];
            $arReturn[$sKey]["text_new"] = "Nuevo " . $arSubmenu[$this->_submenu_texto];
        }
        return $arReturn;    
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

    public function set_control_id($sValor)
    {
        $this->_control_id = $sValor;
    }

    public function set_extras($sValor)
    {
        $this->_extras = $sValor;
    }


    //=============== GET ======================  
    public function get_control_id()
    {
        return $this->_control_id;
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