<?php
//echo "index.php"; die;
//error_reporting(E_ALL);
//CHANGE THIS HERE AND IN boot_constants.php
define("DS","/");
include("php_boot".DS."boot_main.php");
if(TFW_USEWHOLEPAGES!=1)
  
    Tfw::IMPORT(FOL_HTML_SINGLE_FILES,"0010_html");
   

else 

    //bug(get_included_files(),FOL_HTML_WHOLE_FILES);
    Tfw::IMPORT(FOL_HTML_WHOLE_FILES,"0000_page");
    //bug(get_included_files());

?>
