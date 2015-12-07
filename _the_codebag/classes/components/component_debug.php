<?php
class Debug
{
    private static $_isSqlsOn = false;
    private static $_isMessagesOn = false;
    private static $_isPhpInfoOn = false;
    private static $_isIncludedOn = false;
    
    private static $_arMessages = array();
    private static $_arSqls = array();
    private static $_arIncluded = array();
    
   
    public static function config($isSqlsOn=false, $isMessagesOn=false, $isPhpInfoOn=false, $isIncludedOn=false)
    {
        self::$_isSqlsOn = $isSqlsOn;
        self::$_isMessagesOn = $isMessagesOn;
        self::$_isPhpInfoOn = $isPhpInfoOn;
        self::$_isIncludedOn = $isIncludedOn;
    }

    private static function add_newline($sSQL)
    {
        if(!strpos($sSQL,"\nFROM"));
            $sSQL = str_replace("FROM","\nFROM",$sSQL);
        if(!strpos($sSQL,"\nINNER"));
            $sSQL = str_replace("INNER","\nINNER",$sSQL);
        if(!strpos($sSQL,"\nLEFT"));
            $sSQL = str_replace("LEFT","\nLEFT",$sSQL);
        if(!strpos($sSQL,"\nRIGHT"));
            $sSQL = str_replace("RIGHT","\nRIGHT",$sSQL);
        if(!strpos($sSQL,"\nWHERE"));
            $sSQL = str_replace("WHERE","\nWHERE",$sSQL);
        if(!strpos($sSQL,"\nAND"));
            $sSQL = str_replace("AND","\nAND",$sSQL);
        if(!strpos($sSQL,"\nORDER BY"));
            $sSQL = str_replace("ORDER BY","\nORDER BY",$sSQL);
        return $sSQL;
    }
    
    public static function set_sql($sSQL,$iCount)
    {
        $sSQL = self::add_newline($sSQL);
        if(self::$_isSqlsOn)
            self::$_arSqls[] = array("SQL Statement"=>$sSQL,"Rows Affected"=>$iCount);
    }
    
    public static function set_message($sMessage,$sTitle="")
    {
        if(self::$_isMessagesOn)
            self::$_arMessages[] = array("Title"=>$sTitle,"Message"=>$sMessage);
    }
    
    public static function set_vardump($var,$sTitle="")
    {
        self::set_message(var_export($var, true),$sTitle);
    }


    public static function get_php_info()
    {
        if(self::$_isPhpInfoOn)
            return phpinfo();
    }
    
    public static function get_messages_in_array()
    {
        if(self::$_isMessagesOn)
            return self::$_arMessages;
    }

    public static function get_messages_in_html_table()
    {
        if(self::$_isMessagesOn)
            echo self::build_html_table(self::$_arMessages);
    }
    
    public static function get_sqls_in_array()
    {
        if(self::$_isSqlsOn)
            return self::$_arSqls;
    }

    public static function get_sqls_in_html_table()
    {
        if(self::$_isSqlsOn)
            echo self::build_html_table(self::$_arSqls);
    }
    
    public static function set_messages_on($isMessagesOn)
    {
        self::$_isMessagesOn = $isMessagesOn;
    }
    
    public static function set_sqls_on($isSqlsOn)
    {
        self::$_isSqlsOn = $isSqlsOn;
    }
    
    public static function set_php_info_on($isPhpInfoOn)
    {
        self::$_isPhpInfoOn = $isPhpInfoOn;
    }
    
    public static function is_php_info_on()
    {
        return self::$_isPhpInfoOn;
    }
    
    public static function is_sqls_on()
    {
        return self::$_isSqlsOn;
    }
    
    public static function is_messages_on()
    {
        return self::$_isMessagesOn;
    }
    
    private static function build_html_tr_header($arArray=array())
    {
        $sHtmlTrHd = "";
        if(!empty($arArray))
        {    
            $sHtmlTrHd .="<tr><th>Nº</th>\n";

            $arRow = $arArray[0];
            foreach($arRow as $sTitle=>$sValue)
            {
                $sHtmlTrHd .= "<th>$sTitle</th>\n";
            }
            $sHtmlTrHd .= "</tr>\n";
        }
        return $sHtmlTrHd;
    }
    
    private static function get_style_td_background($iRow)
    {
        if(($iRow%2)==0)
            return "clsTrEven";
        return "clsTrUneven";
    }
    
    private static function build_html_table($arArray=array())
    {
        $isDebug = (IS_DEBUG || 
                    ((IS_REMOTE_DEBUG && $_SERVER["REMOTE_ADDR"]==IP_DEBUG) || 
                    (IS_REMOTE_DEBUG && $_SERVER["REMOTE_ADDR"]=="127.0.0.1"))
                    );
        $sHtmlTable = "";
        if($isDebug)
        {    
            if(!empty($arArray))
            {
                $sHtmlTable .= "<table id=\"tblDebug\">\n";
                $sHtmlTable .= self::build_html_tr_header($arArray);
                foreach($arArray as $iRow=>$arRow)
                {
                    $sTdStyle = self::get_style_td_background($iRow);
                    $sHtmlTable .= "<tr>\n";
                    $sHtmlTable .= "<td class=\"$sTdStyle\">$iRow</td>\n";
                    foreach($arRow as $iFieldName => $sFieldValue)
                    {
                        if($iFieldName=="SQL Statement")
                            $sFieldValue = "<pre class=\"$sTdStyle\">$sFieldValue</pre>";
                        $sHtmlTable .= "<td class=\"$sTdStyle\">$sFieldValue</td>\n";
                    }
                    $sHtmlTable .= "</tr>\n";
                }
                $sHtmlTable .= "</table>\n";
            }
        }
        return $sHtmlTable;
    }
}