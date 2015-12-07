<?php
class HelperForeignLinks extends MainHelper
{
    private $_active_module = "";
    private $_code_account = "";
    private $_arAccountFrgLinks = array();

    public function __construct($arModuleTabButtons=array("module"=>"","description"=>""),$sCodeAccount="",$sActiveModule="")
    {
        parent::__construct();
        $this->_arAccountFrgLinks = $arModuleTabButtons;
        $this->_code_account = $sCodeAccount;
        $this->_active_module = $sActiveModule;
    }

    public function get_html()
    {
        $sHtml = "";
        $sHtml .= "<div data-role=\"navbar\" data-theme=\"e\" >\n";
        $sHtml .= $this->get_html_ul();
        $sHtml .= "</div>\n";
        return $sHtml;
    }
  
    private function get_link($sModule)
    {
        $sUrlLink = JQ_DOMAIN_URI_HTTPWS_INDEXPHP_PARAMS_MODULE."$sModule&tab=list&Code_Account=$this->_code_account";
        return $sUrlLink;
    }
    
    private function get_html_ul()
    {
        $arLinks = $this->_arAccountFrgLinks;
        $sHtmlUl = "";
        $sHtmlUl .= "<ul>\n";
        foreach ($arLinks as $arLink) 
        {
            $sLink = $this->get_link($arLink["module"]);
            $sDescription = $arLink["description"];
            
            $sHtmlAnchor = "<a href=\"$sLink\" ";
            
            if($arLink["module"] == $this->_active_module)
                $sHtmlAnchor .= "class=\"ui-btn-active\" ";
            
            $sHtmlAnchor .= ">\n";
            $sHtmlAnchor .= $sDescription;
            $sHtmlAnchor .= "</a>\n";
            $sHtmlUl .= "<li>$sHtmlAnchor</li>\n";
        }
        $sHtmlUl .= "</ul>\n";
        return $sHtmlUl;
    }
    
    public function set_active_module($sModule)
    {
        $this->_active_module = $sModule;
    }
    
    public function set_code_account($sCodeAccount)
    {
        $this->_code_account = $sCodeAccount;
    }
}

/*
 * <!-- navbar -->
<div data-role="navbar">
    <ul>
        <li><a href="index.php?module=activities&tab=list&Code_Account=<? echo $oClient->get_code(); ?>" class="ui-btn-active">Actividades</a></li>
        <li><a href="index.php?module=contacts&tab=list&Code_Account=<? echo $oClient->get_code(); ?>" class="ui-btn-active">Contactos</a></li>
        <li><a href="index.php?module=historial&tab=list&Code_Account=<? echo $oClient->get_code(); ?>" class="ui-btn-active">Cond. Comerciales</a></li>
        <li><a href="index.php?module=historial&tab=list&Code_Account=<? echo $oClient->get_code(); ?>" class="ui-btn-active">Historial</a></li>
        <li><a href="index.php?module=historial&tab=list&Code_Account=<? echo $oClient->get_code(); ?>" class="ui-btn-active">Prop. Comercial</a></li>
    </ul>
</div>
<!-- \navbar -->
 */
