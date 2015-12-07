<?php
//Libreria con elementos globales como: funciones, constantes y la clase lite Tfw
include("../php_boot/boot_main.php");
//IMPORT_VENDOR lo que hace es un include de la clase "fpdf" recuperandolo de la carpeta /proy_anytest/mix_vendors/Fpdf17
Tfw::IMPORT_VENDOR("Fpdf17", "fpdf");
Tfw::IMPORT(FOL_PHP_CLASSES, "CCliente");
Tfw::IMPORT(FOL_PHP_CLASSES, "CFactura");

//Heredo de la clase FPDF
//http://www.fpdf.org/  Version: 1.7
class CPdf extends FPDF
{
    
    /*@author: Eduardo Acevedo Farje.
     *www.eduardoaf.com
     */
    //El código ascci del €
    private $_AsciiEuro;
    
    //r: Ruta. La ruta de la imágen a insertar en el PDF
    private $_rImagen;
    private $_sEmpresaEmisora;
    private $_sCif;
    
    private $_oCliente;
    private $_oFactura;

    
    public function __construct(CCliente $oCliente, CFactura $oFactura, 
                                $sEmpresaEmisora="", $sCif="", $rImagen="../Images/LogoHoja.jpg", 
                                $cOrientacion="P", $sUnidDistancia="mm", 
                                $sTamanoFolio="A4") 
    {
        parent::__construct($cOrientacion, $sUnidDistancia, $sTamanoFolio);
        $this->_AsciiEuro = chr(128);
                
        $this->_sEmpresaEmisora = $sEmpresaEmisora;
        $this->_sCif = $sCif;
        $this->_rImagen = $rImagen;
        
        $this->_oCliente = $oCliente;
        $this->_oFactura = $oFactura;
    }
    
    //Cabecera de página, Titulo y Logo
    private function set_config_header()
    {
        //Arial bold 15
        $iTamanoFuente = 15;
        $this->SetFont("Arial","B",$iTamanoFuente);

        //Configuración del Logo de la empresa
        //ruta a la imágen
        $rImagen = $this->_rImagen;
        $iMargenX = 137;
        $iMargenY = 1;
        $iAnchoImagen = 74;
        $this->Image($rImagen, $iMargenX, $iMargenY, $iAnchoImagen);
        //Movernos a la derecha, 1: dejamos una celda por la izquierda
        $this->Cell(1);
        
        //Configuracion del títutlo de la cabecera:
        $iAncho = 10;
        $iAltura = 10;
        //Los caracteres no castellanos hay que pasarlos a ISO-8859-1 que es
        //el juego con el que trabaja FPDF
        $sTitulo = utf8_decode("Factura nº: ");
        
        //Sin borde
        $iAnchoBorde = 0;
        //Indico que no haga un salto de linea despues de pintar el título sino haría
        //algo como: Factura nº: (salta una linea)
        // 232 y quiero que sea:  Factura nº: 232 (en una sola linea)
        $iSaltosLinea = 0;
        //Alineado a la izquierda
        $cAlineacion = "L";
        $this->Cell($iAncho,$iAltura,$sTitulo,$iAnchoBorde,$iSaltosLinea,$cAlineacion);
    }
 
    //Muestra el Nº al lado de "FACTURA nº:"
    private function set_numero_factura()
    {
        $oFactura = $this->_oFactura;
        $iNumFactura = $oFactura->get_numero();
        //Arial bold 15
        $this->SetFont("Arial","B",15);
        $this->Cell(20);
        //Título
        $this->Cell(10,10,$iNumFactura,0,0,"L");
        //Salto de línea
        $this->Ln(20);
    }
 
    private function set_datos_empresa_emisora()
    {
        $sNombreEmpresa = $this->_sEmpresaEmisora;
        $sCif = $this->_sCif;
        
        $oFactura = $this->_oFactura;
        $dFecha = $oFactura->get_fecha();
        //Convierto 2010-01-01 a 1 de Enero de 2010
        //$sFechaLarga = CUtils::fFechaLarga($dFecha);
        
        //Esto me ayudara a dejar un espacio fijo desde el margen izquierdo
        //de modo que se vea tabulado algo como:
        //          Fecha
        //..115..   Empresa (emisora)
        //          Cif (cif empresa emisora)
        $iAnchoTabular = 115;

        $this->SetFont("Arial","B",12);
        $this->Cell($iAnchoTabular);
        $this->Cell(1,7,"FECHA:",20,0,"L");
        $this->Ln();
        $this->SetFont("Arial","",12);
        $this->Cell($iAnchoTabular);
        $this->Cell(1,7,$dFecha,20,0,"L");
        $this->Ln();
        $this->Cell($iAnchoTabular);
        $this->Cell(1,6,$sNombreEmpresa,20,0,"L");
        $this->Ln();
        $this->Cell($iAnchoTabular);
        $this->Cell(1,6,$sCif,20,0,"L");
        $this->Ln(20);
    }
 
    private function set_datos_cliente()
    {
        $oCliente = $this->_oCliente;
        $sNombreEmpresa = $oCliente->get_empresa();
        $sCif = $oCliente->get_cifnif();
        $sDireccion = $oCliente->get_direccion();
        $sCodigoPostal = $oCliente->get_codigo_postal();
        $sCiudad = $oCliente->get_ciudad();
        
        $this->SetFont("Arial","BU",12);
        $this->Cell(0,7,"FACTURAR A:",0,0,"L");
        $this->Ln();
        $this->SetFont("Arial","B",12);
        $this->Cell(0,7,$sNombreEmpresa,0,0,"L");
        $this->Ln();
        $this->SetFont("Arial","",12);
        $this->Cell(0,7,$sCif,0,0,"L");
        $this->Ln();
        $this->Cell(0,7,$sDireccion,0,0,"L");
        $this->Ln();
        $this->Cell(0,7,"$sCodigoPostal - $sCiudad",0,0,"L");
        $this->Ln(20);
    }
 
    private function set_datos_detalle()
    {
        //Símbolo del euro
        $cEuro = $this->_AsciiEuro;
        $arDetalles = $this->_oFactura->get_detalle();
        
        $this->SetFont("Arial","B",12);
        
        //Esto formara la cabecera de la tabla de detalle algo como:
        // |            Concepto            |   Cantidad    |
        $arLabelsCabeceras = array("Concepto","Cantidad");
        //Anchuras de las columnas, coindicen con la posición de las cabeceras
        $arAnchoColumna = array(150,35);        

        $iAltura = 7;
        $iAnchoBorde = 1;
        $iSaltosLinea = 0;
        //Centrado
        $cAlineacion = "C";
        
        //Dibujo las cabeceras
        foreach($arLabelsCabeceras as $iIndice => $sTituloCabecera)
        {
            $iAnchoColumna = $arAnchoColumna[$iIndice];
            $this->Cell($iAnchoColumna,$iAltura,$sTituloCabecera,$iAnchoBorde,$iSaltosLinea,$cAlineacion);
        }
        //Despues de dibujar la linea con las cabeceras se hace un salto
        $this->Ln();

        //Reconfiguro la fuente para que no sea en negrita
        $this->SetFont("Arial","",12);
        
        $iAltura = 6;
        //Dibujo el detalle de la factura $arDetalles es del tipo n x ("CONCEPTO"=>"..","CANTIDAD"=>"")
        foreach($arDetalles as $arDetalle)
        {
            //Columna concepto
            $sConcepto = $arDetalle["CONCEPTO"];
            $iAnchoColumna = $arAnchoColumna[0];
            $this->Cell($iAnchoColumna, $iAltura, $sConcepto,"LR");
            //Columna cantidad
            $iAnchoColumna = $arAnchoColumna[1];
            $fCantidad = $arDetalle["CANTIDAD"];
            $sMonto = number_format($fCantidad,2,",","");
            $sMonto = "$sMonto $cEuro";
            $this->Cell($iAnchoColumna, $iAltura, $sMonto,"LR",0,"R");
            
            $this->Ln();
        }

        //Línea de cierre
        $iAnchoTotal = array_sum($arAnchoColumna);
        $this->Cell($iAnchoTotal,0,"","T");
        $this->Ln();
    }

    //TODO se puede mejorar con un bucle
    private function set_resumen_totales()
    {
        //Símbolo del euro
        $cEuro = $this->_AsciiEuro;
        $oFactura = $this->_oFactura;
        
        $this->SetFont("Arial","B",12);
 
        $arLabels = array
        (
            "subtotal"=>"Subtotal: ",
            "iva"=>"Iva: ",
            "total"=>"Total: "
        );
 
        //Anchuras de las columnas
        $arAnchoColumna = array("concepto"=>150,"cantidad"=>35);
        $iAltoCelda = 6;
        foreach ($arLabels as $sIndice =>$sLabel)
        {
            switch ($sIndice) 
            {
                case "subtotal":
                    $sEuros = number_format($oFactura->get_subtotal(),2,",","");
                break;
                case "iva":
                    $sEuros = number_format($oFactura->get_iva(),2,",","");
                break;
                case "total":
                    $sEuros = number_format($oFactura->get_total(),2,",","");
                break;
                default:
                    $sEuros = "0,00";
                break;
            }
            $sEuros = "$sEuros $cEuro";
            //Label
            $this->Cell($arAnchoColumna["concepto"],$iAltoCelda, $sLabel, "LR",0,"R");
            //Cantidad
            $this->Cell($arAnchoColumna["cantidad"],$iAltoCelda, $sEuros, "LR",0,"R");
            $this->Ln();            
        }
        //Línea de cierre
        $iAnchoTotal = array_sum($arAnchoColumna);
        $this->Cell($iAnchoTotal,0,"","T");
    }
    
    //Pie de página
    private function set_config_footer()
    {
        $iNumPagina = $this->PageNo();
        //Posición: a 15mm (1,5) cm del final
        $this->SetY(-31);
        //Arial Bold italic 8
        $this->SetFont("Arial","B",8);
        //Número de página
        $sTextoCelda = "Página $iNumPagina/{nb}";
        $sTextoCelda = utf8_decode($sTextoCelda);
        $cAlineacion = "C";
        //Ver la configuracion de los parametros en la linea 49
        $this->Cell(0,10, $sTextoCelda, 0,0, $cAlineacion);
    }
    
    /**
     * IMPORTANTE: Este metodo se encarga del rasterizado del contenido
     * pasado a formato PDF.  
     * No se puede llamar a este metodo despues de haber enviado cabeceras al
     * navegador. No porque sea mi metodo, es que la clase FPDF tiene esa restricción
     * El error provocado es este:
     * FPDF error: Some data has already been output, can't send PDF file (output started at ...
     */
    public function generar_factura()
    {
        //Iniciamos el objeto Página sobre el que se dibujará el contenido del
        //PDF
        $this->AddPage();
        //Activamos la opción para que muestre el número de páginas
        $this->AliasNbPages();
        
        //LOS METODOS EXTENDIDOS:
        //Posiciona el logotipo de la hoja, en este caso para emular un papel membretado
        //el logo es una imagen .jpg de tamaño A4
        $this->set_config_header();
        //Asignamos el número de factura a: Factura nº:, creado en el paso anterior
        $this->set_numero_factura();        
        //Dibujamos la fecha de la factura y los datos de nuestra empresa
        //Lleva un salto de linea de 10
        $this->set_datos_empresa_emisora();
        //Saltamos 10 lineas extra, un pequeño parche
        $this->Ln(8);
        //Dubujamos los datos del cliente: Nombre, Nif, Domicilio
        //lleva un salto de línea de 20
        $this->set_datos_cliente();
        //Dibujamos el detalle desglosado de la factura: Concepto, Cantidad
        $this->set_datos_detalle();
        //Dibujamos el resumen de: subtotal, iva y total
        $this->set_resumen_totales();
        //Configuramos lo que mostrará en el pie de página: Página i/n
        $this->set_config_footer();
        //En este punto todo el documento está generado, con este metodo
        //lo imprimimos en PDF
        $this->Output();
    }
    
    public function set_imagen($rImagen)
    {
        $this->_rImagen = $rImagen;
    }
 
}

$firephp = FirePHP::getInstance(true);
//La clase CCliente deberia ser un modelo, aqui estoy emulando el objeto.
$oCliente = new CCliente("E.M.P. Cliente S.L", "12345678", "San Fermin 12", "28006", "Madrid");
$oFactura = new CFactura("1 de Enero de 2011", 250.50, 225.25, 25.25, "FAC0000123");
$firephp->log($oFactura, "label");
//$oPdf = new CPdf($oCliente, $oFactura, $arDetalles, $sEmpresaEmisora, $sCif, $cOrientacion, $sUnidDistancia, $sTamanoFolio)
$oFacturaPdf = new CPdf($oCliente, $oFactura, "M.I Empresa. S.A", "MI9876543");
//$rImagen = guarda algo como: h ttp://localhost/proy_anytest/html_images/LogoHoja.jpg
$rImagen = TFW_PATH_HTTPWS.FOL_HTML_IMAGES.DS."LogoHoja.jpg";
$oFacturaPdf->set_imagen($rImagen);
$oFacturaPdf->generar_factura();

?>