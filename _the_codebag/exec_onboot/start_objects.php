<?php
Debug::config(IS_DEBUG_ALLOWED);
//BD
$oDB = Database::get_instancia();
//$oDB->conectar();
//bug($oDB); die;
//JS
$oHlpCss = new HelperCss();
$oHlpCss->add_plug_filehref("debug","css_debug");
//$oHlpCss->add_ext_filehref("classic","styles/");

$oHlpJavascript = new HelperJavascript();
$oHlpJavascript->add_plug_filesrc("google_maps", "js_google_maps_3");
//$oHlpJavascript->add_tfw_filesrc("jquery-1.7.2","jquery");
//$oHlpJavascript->add_tfw_filesrc("js_functions");
//$oHlpJavascript->add_tfw_filesrc("js_natc_ajax");

//$oHlpJavascript->show_tag_links();
//$oHlpJavascript->add_js_line($sScriptLine);