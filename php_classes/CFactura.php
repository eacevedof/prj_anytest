<?php
class CFactura
{
    private $_fecha;
    private $_total;
    private $_subtotal;
    private $_iva;
    private $_numero;
    
    private $_sMensaje;


    public function __construct($fecha, $total, $subtotal, $iva, $numero) 
    {
        $this->_sMensaje = "";
        
        $this->_fecha = $fecha;
        $this->_total = $total;
        $this->_subtotal = $subtotal;
        $this->_iva = $iva;
        $this->_numero = $numero;
        
    }
    
    //===========================     SETS     ===========================
    public function set_fecha($fecha)
    {
        $this->_fecha = $fecha;
    }
    
    public function set_total($total)
    {
        $this->_total = $total;
    }

    public function set_subtotal($subtotal)
    {
        $this->_subtotal = $subtotal;
    }
    
    public function set_iva($iva)
    {
        $this->_iva = $iva;
    }
    
    public function set_numero($numero)
    {
        $this->_numero = $numero;
    }
    
    
    /*
    public function set_propiedad($propiedad)
    {
        $this->_propiedad = $propiedad;
    }*/
    
    //===========================     GETS     ===========================
    public function get_fecha()
    {
        return $this->_fecha;
    }
    
    public function get_total()
    {
        return $this->_total;
    }
    
    public function get_subtotal()
    {
        return $this->_subtotal;
    }
    public function get_iva()
    {
        return $this->_iva;
    }
    public function get_numero()
    {
        return $this->_numero;
    }
        
    public function get_detalle()
    {
        $arDetalle = array
        (
            array("CONCEPTO"=>"Articulo uno ","CANTIDAD"=>55.50),
            array("CONCEPTO"=>"Concepto dos ","CANTIDAD"=>44.50),
            array("CONCEPTO"=>"Descripcion tres ","CANTIDAD"=>125.25)
        );
        return $arDetalle;
    }
    
    
    /*
    public function get_propiedad()
    {
        return $this->_propiedad;
    }
    */
    
    //===========================     METODOS     ===========================    
    public function is_error()
    {
        if(!empty($this->_sMensaje))
        {
            return true;
        }
        return false;
    }
    
    public function get_mensaje()
    {
        return $this->_sMensaje;
    }
}
?>