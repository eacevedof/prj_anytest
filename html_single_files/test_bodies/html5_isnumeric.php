<script type="text/javascript">

//http://api.jquery.com/jQuery.post/
function pr_div(sTexto)
{
    var eDiv = document.getElementById("divMensaje");
    eDiv.innerHTML = sTexto;
}

function div_alert(eDiv)
{
    console.debug(eDiv.innerHTML);
}

function enviar(eText)
{
    var oJson =
        {
            id: eText.id,
            valor: eText.value

        }
    $.post("index.php", oJson );
    //$.post("index.php", {id:"hugo"} );

}
//Seleccionar o deseleccionar todo
$(document).ready
(

);//Fin .ready()
    </script>
    <div id="divContenido" style="border:2px solid yellow; width: 100%;">
        <header id="page-header">
            <h1>EL H1</h1>
            <nav>
                NAVIGATION
            </nav>
<!-- element -->
        </header>
<!-- SECCION -->
        <section id="secContenido">
<?php
$tests = array(
"42" ,
1337 ,
"1e4" ,
"11.2.8",
"not numeric" ,
Array(),
9.1,
15,
20,00,
20.00,
"1.00",
"-5",
 -5
);
/*
foreach ( $tests as $element ) {
if ( is_numeric ( $element )) {
echo "' { $element } ' is numeric" , PHP_EOL ;
} else {
echo "' { $element } ' is NOT numeric" , PHP_EOL ;
}
}*/
$arFloat['Descuento 1'] = $_POST['info_Descuento'];
$arFloat['Descuento 2'] = $_POST['info_Descuento2'];
$arFloat['Descuento Pronto Pago'] = $_POST['info_Dto_ProntoPago'];
$arFloat['Lim. de Credito'] = $_POST['info_Credito_Caution'];

$isError = false;
$sMensaje ="";
foreach($tests as $sIndice => $sFloat)
{

    if(!is_numeric($sFloat))
    {
        $sMensaje = $sIndice . " no válido!";
        //echo "$sMensaje";
        break;
    }

}
echo "<br><br><br><br>";
echo empty($sMensaje);
echo "<br>";
$sMensaje="";
echo "->";
echo empty($sMensaje);
echo "<-";
echo "<br><br><br><br>";
foreach ( $tests as $element ) 
{

  if ($element == (string) intval($element))
  {
    echo "<br> $element = is ENTERO" , PHP_EOL ;}
  else{
    echo "<br> $element = is NOT ENTERO" , PHP_EOL ;}
}
?>

<form id="frmTest" method="post" action="" onsubmit="">
    <div id="divMensaje" style="border:1px solid red; color:blue;">-</div>

    <div id="divTbl_1">
        <div id="divRow_1_1" onChange="div_alert(this);">
            <div id="divCell_1_1_1" >
                valor:<input type="text" id="txtParametro" value="" onBlur="enviar(this);" />
            </div>
            <div id="divCell_1_1_2" >
                valor:<input type="text" id="txtTipo" value="" onBlur="enviar(this);" />
            </div>
            <div id="divCell_1_1_3" >
                valor:<input type="text" id="txtDescripcion" value="" onBlur="enviar(this);" />
            </div>
        </div>
    </div>
</form>

            <!-- columna derecha -->
            <aside id="asdColumnaDerecha" style="border:2px solid blue; width: 200px; float:right;">
                <nav>
                    <h1>Columna Derecha</h1>
                    <ul>
                        <li>
                            <a target="_blank" href="">Minimal setup</a>
                        </li>
                    </ul>
                </nav>
            </aside>
            
            <!--/fin columna derecha -->
        </section>
<!-- /SECCION -->
    </div>
    <footer style="border:2px solid green; height: 150px; width: 400px;">
        <a href="http://www.the-framework.eduardoaf.com">
        Powered by "The framework"
        </a>

        Creado por
        <a href="http://www.eduardoaf.com">
            <img width="100" alt="Blog de Eduardo Acevedo Farje" src="http://www.eduardoaf.com/wp-content/uploads/img_articulos/logo_eduardoaf_com.png">
        </a>
    </footer>