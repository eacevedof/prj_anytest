<?php
$sLoquesehace = "\$name = \"nombre_de_una_variable\"<br>";
$sLoquesehace .= "\$\$name = \"contenido para var: nombre_de_una_variable\"";

$name = "nombre_de_una_variable";
//$$name = "contenido para var: nombre_de_una_variable";
$loque = $$name;

bug($sLoquesehace," asignacion:");

bug($nombre_de_una_variable,"nombre_de_una_variable");
bug($name,"\$name");
bug($$name,"\$\$name");
bug($loque,"\$loque");
bug("$name{$$name}","\$name{\$\$name}");
    