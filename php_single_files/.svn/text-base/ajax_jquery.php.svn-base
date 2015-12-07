<?php
include '../php_boot/boot_main.php';
tfw::IMPORT("php_classes/helpers", "MainHelper.inc",1);
tfw::IMPORT("php_classes/helpers", "HelperSelect.inc",1);
class AjaxController
{
    public function __construct() {
        ;
    }
    
    public function get_select()
    {
        $ar[""]="";
        $ar["v1111"] = "txt1111";
        $ar["v2222"] = "txt2222";
        $ar["v3333"] = "txt3333";
        $ar["v4444"] = "txt4444";
        $ar["v5555"] = "txt5555";
        $ar["v6666"] = "txt6666";
        $ar["v7777"] = "txt7777";
        $ar["v8888"] = "txt8888";
        
        $oSelect = new HelperSelect($ar,"selTestSingle");
        $oSelect->show();
    }

}

$oAjax = new AjaxController();
$oAjax->get_select();