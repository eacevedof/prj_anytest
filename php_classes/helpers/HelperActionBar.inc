<?php
class HelperActionBar extends MainHelper
{
    private $_h1_title;
    private $_p_description;
    private $_link_search;
    private $_link_refresh;

    public function __construct($sH1Title="",$sPDescription="",$sLnkSearch="",$sLnkRefresh="", $sModule="",$sTab="",$arParams="")
    {
        parent::__construct();
        $this->_h1_title = $sH1Title;
        $this->_p_description = $sPDescription;
        $this->_link_search = $sLnkSearch; //Modulo, list
        $this->_link_refresh = $sLnkRefresh; //Modulo, detail
    }

    public function get_html()
    {
        $sHtml = "";
        $sHtml .= "<div id=\"divActionBar\" data-role=\"header\" data-theme=\"b\" data-position=\"inline\">\n";
        if(!empty($this->_h1_title))
            $sHtml .= "<h1>$this->_h1_title</h1>\n";
        if(!empty($this->_p_description))
            $sHtml .= "<p>$this->_p_description</p>\n";
        if(!empty($this->_link_search))
            $sHtml .= "<a href=\"$this->_link_search\" data-role=\"button\" data-icon=\"search\" data-iconpos=\"notext\" class=\"ui-btn-left jqm-home\">\n Listado</a>\n";
        if(!empty($this->_link_refresh))
            $sHtml .= "<a href=\"$this->_link_refresh\" data-role=\"button\" data-icon=\"refresh\" data-iconpos=\"notext\" class=\"ui-btn-right jqm-home\">\n Actualizar</a>\n";
        $sHtml .= "</div>\n"; 
        return $sHtml;
    }
    
    public function get_h1_title()
    {
        return $this->_h1_title;
    }
    
    public function get_p_description()
    {
        return $this->_p_description;
    }
    
    public function get_link_search()
    {
        return $this->_link_refresh;
    }
    
    public function get_link_refresh()
    {
        return $this->_link_refresh;
    }
    
    public function set_h1_title($sValue)
    {
        $this->_h1_title = $sValue;
    }
    
    public function set_p_description($sValue)
    {
        $this->_p_description = $sValue;
    }
    
    public function set_link_search($sValue)
    {
        $this->_link_refresh = $sValue;
    }
    
    public function set_link_refresh($sValue)
    {
        $this->_link_search = $sValue;
    }    
}

/**
 <div id="divFormMenu" data-role="header" data-theme="b" data-position="inline">
    <h1>Modulo(objeto)</h1>
    <p>Nuevo ó Código</p>
    <a href="#" data-role="button" data-icon="search" data-iconpos="notext" class="ui-btn-right jqm-home">
        refrescar
    </a>
    <a href="#" data-role="button" data-icon="refresh" data-iconpos="notext" class="ui-btn-left jqm-home">
        refrescar
    </a>    
</div>
 */