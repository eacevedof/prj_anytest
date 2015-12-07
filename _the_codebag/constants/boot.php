<?php
define("IS_DEBUG_ALLOWED",
        (IS_DEBUG || 
            (
                (IS_REMOTE_DEBUG && $_SERVER["REMOTE_ADDR"]==IP_DEBUG) || 
                (IS_REMOTE_DEBUG && $_SERVER["REMOTE_ADDR"]=="127.0.0.1")
            ) || key_exists("debug", $_GET)
        )
       );

//constants folder
define("TFW_PATH_DIR",dirname(__FILE__));
define("TFW_PATH_DIRDS",TFW_PATH_DIR.TFW_DS);
//CONFIGURAR
//..lib/codebag/
define("TFW_MAIN_SUBPATH_FROM_FILEDS",TFW_MAIN_SUBPATH_FROM_FILE.TFW_DS);
//..lib/codebag/html/js/
define("TFW_SUBPATH_JSDS",TFW_MAIN_SUBPATH_FROM_FILEDS."html".TFW_DS."js".TFW_DS);
//..lib/codebag/html/style/
define("TFW_SUBPATH_STYLEDS",TFW_MAIN_SUBPATH_FROM_FILEDS."html".TFW_DS."style".TFW_DS);
//..lib/codebag/html/snipets/
define("TFW_SUBPATH_SNIPETSDS",TFW_MAIN_SUBPATH_FROM_FILEDS."html".TFW_DS."snipets".TFW_DS);
//..lib/codebag/plugins/
define("TFW_SUBPATH_PLUGINDS",TFW_MAIN_SUBPATH_FROM_FILEDS."plugins".TFW_DS);