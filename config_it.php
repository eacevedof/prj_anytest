<?php
/**
 * Define wether to use just body or whole pages
 * false: use bodies
 * true: use whole pages
 */
define("TFW_USEWHOLEPAGES",1);

define("TFW_GOOGLEAPIKEY","AIzaSyCnzLdFE23eT-iSwSkuMDtrKEysccLteSc");

define("TFW_DBCONFIG_NUM",2);
switch(TFW_DBCONFIG_NUM) 
{
    //LOCAL 2008
    case 1:
        define("TFW_DB_NAME", "adecco_mapas");
        define("TFW_DB_USER", "sa");
        define("TFW_DB_PASSWORD", "Sa2008");
        define("TFW_DB_SERVER", "EALEXEIPXP\MSSQLSERVER2008");
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
?>
