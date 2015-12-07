<?php
//$oBD = CBaseDatos::get_instancia(null,null,null,null,"mysql");
/**
* @var CBaseDatos 
*/
$oBD = CBaseDatos::get_instancia();
$isConnected = $oBD->conectar();
//bug($isConnected);

//bug($oBD);
$sSQL = "SELECT * FROM blog_usuario";
$arTabla = $oBD->query($sSQL);
bug($arTabla);
$sSQL = "INSERT INTO blog_usuario (id_creador)
         VALUES (2)";
$oBD->execute($sSQL);
$sSQL = "DELETE FROM blog_usuario WHERE id_creador=2";
$oBD->execute($sSQL);
bug($oBD->get_mensaje());

?>
