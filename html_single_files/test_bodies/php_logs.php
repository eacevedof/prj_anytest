<?php

$oLogs = new ComponentFile();
$sLogsPath = TFW_PATH_APPROOTDS."logs";
/*
bug($sLogsPath);
bug(is_dir($sLogsPath));
$oLogs->set_path_folder_source($sLogsPath);
$oLogs->set_filename_source("milog.txt");
$oLogs->create();
bug($oLogs);
bug($oLogs->get_message(),"message");
$oLogs->add_content("Esto es una linea a guardar en el archivo");
$oLogs->add_content("Esto es otra linea se crea en una nueva?");
bug($oLogs->get_message());

$oLogs->set_filename_target("cambiado.txt");
$oLogs->rename();
//$oLogs->set_path_folder_target($sLogsPath.DS."start");
//$oLogs->copy();
 * 
 */
$oLogs = new ComponentLogs($sLogsPath);
$oLogs->sql_read("user000899_20120501.txt", "01:00:04", "SELECT * FROM core_users");
bug($oLogs->get_message());
