<?php

session_start();
include("boot_constants.php");
include("boot_functions.php");
include("boot_class.php");
include(TFW_PATH_APPROOTDS."config_it.php");
include("boot_component_file.php");
include("boot_component_base_datos.php");
include("boot_main_model.php");

tfw::IMPORT_VENDOR("FirePHPCore","FirePHP.class");
