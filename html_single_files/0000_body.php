<?php
$arBodies[0] = "gmap_js_functions";
$arBodies[1] = "gmap_peticion_xml";

$arBodies[1000] = "html5_control_atributos";
$arBodies[1001] = "html5_control_orden_eventos";
$arBodies[1002] = "html5_isnumeric";
$arBodies[1003] = "html5_todos_los_controles";
$arBodies[1004] = "html5_todos_los_controles_form";
$arBodies[1005] = "html5_canvas_signature";

$arBodies[2000] = "js_ambito_vars";
$arBodies[2001] = "js_proto_lib_otext";
$arBodies[2002] = "js_proto_lib_select";
$arBodies[2003] = "js_proto_lib_otext";
$arBodies[2004] = "js_the_framework";
$arBodies[2005] = "js_traza_de_tipos";
$arBodies[2006] = "js_traza_tipos";
$arBodies[2007] = "js_ajax";
$arBodies[2008] = "js_jquery_ajax";

$arBodies[3000] = "monsanto_producto_formulario";
$arBodies[3001] = "monsanto_test_enabled";

$arBodies[4001] = "php_blank";
$arBodies[4002] = "php_funcion_empty";
$arBodies[4003] = "php_fpdf";
$arBodies[4004] = "php_cbasedatos";
$arBodies[4005] = "php_preg_match";
$arBodies[4006] = "php_dir_tree";
$arBodies[4007] = "php_logs";
$arBodies[4008] = "php_doble_dollar";
$arBodies[4009] = "php_whatsapi";

$iCargarBody = 1005;
$showMensaje = 1;

$sBody = $arBodies[$iCargarBody];
?>
<body>
    <div id="divMensaje">*</div>
<?php
    Tfw::html_use_body($sBody,$showMensaje,$sBody);
?>
</body>
