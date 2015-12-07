<?php
//=================
//    DATABASE
//=================
define("TFW_DBCONFIG_NUM",2);
//define("TFW_DBCONFIG_NUM",4);//Produccion

switch (TFW_DBCONFIG_NUM) 
{
    //LOCAL 2008
    case 1:
        define("TFW_DB_NAME", "adecco_mapas");
        /** Tu nombre de usuario de MySQL */
        define("TFW_DB_USER", "sa");
        /** Tu contraseña de MySQL */
        define("TFW_DB_PASSWORD", "Sa2008");
        /** Host de MySQL (es muy probable que no necesites cambiarlo) */
        define("TFW_DB_SERVER", "EALEXEIPXP\MSSQLSERVER2008");
        /** Codificación de caracteres para la base de datos. */
        define("TFW_DB_TYPE", "sqlserver");
    break;
    //LOCAL 2005
    case 2:
        define("TFW_DB_NAME", "adecco_mapas_2005");
        define("TFW_DB_USER", "sa");
        define("TFW_DB_PASSWORD", "Sa2005");
        define("TFW_DB_SERVER", "EALEXEIPXP");
        define("TFW_DB_TYPE", "sqlserver");        
    break;
    //TEST
    case 3:
        define("TFW_DB_NAME", "adecco_mapas_2005");
        define("TFW_DB_USER", "sa");
        define("TFW_DB_PASSWORD", "sa");
        define("TFW_DB_SERVER", "sql-test");
        define("TFW_DB_TYPE", "sqlserver");        
    break;
    //PRODUCCION
    case 4:
        define("TFW_DB_NAME", "adecco_mapas_2005");
        define("TFW_DB_USER", "telynet");
        define("TFW_DB_PASSWORD", "lagranja");
        define("TFW_DB_SERVER", "192.168.20.16");
        define("TFW_DB_TYPE", "sqlserver");        
    break;

    default:
    break;
}


//=================
//      CONFIG
//=================
define("TFW_DS","/");
define("TFW_MAIN_DIRNAME","_tfw_codebag");

//=================
//      DEBUG
//=================
define("IP_DEBUG","188.78.248.168");
define("IS_REMOTE_DEBUG",1);
define("IS_DEBUG",0);

//=================
//      GOOGLE
//=================
define("TFW_GOOGLEAPIKEY","AIzaSyCnzLdFE23eT-iSwSkuMDtrKEysccLteSc");