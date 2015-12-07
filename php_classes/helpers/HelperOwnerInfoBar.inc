<?php
class HelperOwnerInfoBar extends MainHelper
{
    private $_h1_title = "";
    private $_p_link_detail = "";
    private $_p_description = "";

    public function __construct($sH1Title="",$sPDescription="",$sPLnkDetail="")
    {
        parent::__construct();
        $this->_h1_title = $sH1Title;
        $this->_p_description = $sPDescription;
        $this->_p_link_detail = $sPLnkDetail;
    }

    public function get_html()
    {
        $sHtml = "";
        $sHtml .= "<div id=\"divInfoBar\" data-role=\"header\" data-theme=\"b\" data-position=\"inline\">\n";
        if(!empty($this->_h1_title))
            $sHtml .= "<h1>$this->_h1_title</h1>\n";

        $sHtml .= "<p>\n";
        if(!empty($this->_p_link_detail)&& !empty($this->_p_description))
            $sHtml .= "<a href=\"$this->_p_link_detail\" data-role=\"button\" data-icon=\"star\" >\n $this->_p_description</a>\n";
        $sHtml .= "</p>\n";
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
    
    public function get_link_detail()
    {
        return $this->_p_link_detail;
    }
    
    public function set_h1_title($sValue)
    {
        $this->_h1_title = $sValue;
    }
    
    public function set_p_description($sValue)
    {
        $this->_p_description = $sValue;
    }
    
    public function set_link_detail($sValue)
    {
        $this->_p_link_detail = $sValue;
    }

}

