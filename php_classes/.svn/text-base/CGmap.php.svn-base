<?php
class CGMap
{
    private $_pais;
    private $_direccion;
    private $_ciudad;
    private $_cp;
    private $_extra;
    private $_url_google_xml;
    private $_full_url_google_xml;
    private $_direccion_completa;
    private $_oXmlResponsed;
    private $_arEspacioEspana; 
    private $_sMensaje;
    //$fLatitud < 45.18786629495072 && $fLatitud >24.654534254781115  && $fLongitud > -19.80908203125 && $fLongitud < 4.3828125
    
    public function __construct($sPais,$sCiudad,$sDireccion,$sCp, $sExtra) 
    {
        $this->_sMensaje = "";
        //Puntos que delimitan la localizacion en España
        $this->_arEspacioEspana["extremoA"]["fLatitud"] = 45.18786629495072;
        $this->_arEspacioEspana["extremoA"]["fLongitud"] = -19.80908203125;
        $this->_arEspacioEspana["extremoB"]["fLatitud"] = 24.654534254781115;
        $this->_arEspacioEspana["extremoB"]["fLongitud"] = 4.3828125;
        
        $this->_url_google_xml = "http://maps.googleapis.com/maps/api/geocode/xml";
        $this->_pais = $sPais;
        $this->_ciudad = $sCiudad;
        $this->_direccion = $sDireccion;
        $this->_cp = $sCp;
        $this->_extra = $sExtra;
        $this->_full_url_google_xml = $this->_url_google_xml.$this->get_url_address();
        $this->_oXmlResponsed = $this->get_responsed_xml();
        //bug($this->_full_url_google_xml);
    }
    
    private function get_url_address()
    {
        $sPais = $this->_pais;
        $sCiudad = $this->_ciudad;
        $sDireccion = $this->_direccion;
        $sCp = $this->_cp;
        $sExtra = $this->_extra;
        //Carretera de Villaverde a Vallecas, 46, 28021 Madrid, España
        //str_replace(" ","+",urlencode(utf8_encode($sDireccion)))."&sensor=false";
        $sTmpDireccion = "$sDireccion, $sCp, $sCiudad, $sPais, $sExtra";
        $sTmpDireccion = urlencode(utf8_encode($sTmpDireccion));
        $sTmpDireccion = str_replace(" ", "+", $sTmpDireccion);
 
        $sAddress = "?address=";
        $sAddress .= $sTmpDireccion;
        $sAddress .= "&sensor=false";
        return $sAddress;
    }
    
    private function get_responsed_xml()
    {
        $sFullUrlRequest = $this->_full_url_google_xml;
        $oXmlResponse = simplexml_load_file($sFullUrlRequest);
        if($oXmlResponse==false)
        {
            $sMensaje = "No se ha podido recuperar el xml desde la url <br> $sFullUrlRequest";
            $this->_sMensaje = $sMensaje;
            return null;
        }
        return $oXmlResponse;
    }
    
    public function get_xml_object_responsed()
    {
        return $this->_oXmlResponsed;
    }
    
    public function get_url_request()
    {
        return $this->_full_url_google_xml;
    }
    
    public function get_latitud()
    {
        $fLatitud = $this->_oXmlResponsed->result->geometry->location->lat;
        return (float)$fLatitud;
    }
    
    public function get_xml_status()
    {
        $sStatus = (string) $this->_oXmlResponsed->status;
        return $sStatus;
    }
    public function get_longitud()
    {
        $fLongitud = $this->_oXmlResponsed->result->geometry->location->lng; 
        return (float)$fLongitud;
    }
    
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

function curl($sUrl)
{
    //Inicia una nueva sesión y devuelve el manipulador curl para el uso de las funciones:
    //curl_setopt(), curl_exec(), y curl_close(). 
    $oCurlInit = curl_init();
    $sUrl = "http://www.yahoo.es";
    //Configura una opción para una transferencia cURL
    //CURLOPT_URL 	Dirección URL a capturar. 
    curl_setopt($oCurlInit, CURLOPT_URL, $sUrl);
    //CURLOPT_RETURNTRANSFER TRUE para devolver el resultado de la transferencia 
    //como string del valor de curl_exec() en lugar de mostrarlo directamente. 
    curl_setopt($oCurlInit, CURLOPT_RETURNTRANSFER, 1);
    
    //curl_setopt($oCurlInit, CURLOPT_PROXY, "192.168.40.4");
    //curl_setopt($oCurlInit, CURLOPT_HTTPPROXYTUNNEL, 1);
    //var_dump(curl_getinfo($oCurlInit, CURLINFO_HTTP_CODE));

    // Capturar la URL y la pasa al 
    $oCurlExec = curl_exec($oCurlInit);
    if($oCurlExec===false)
    {
        echo "error en curl_exec: ".curl_error($oCurlInit); 
        curl_close($oCurlInit); 
        die();
    }
    //Esta función cierra una sesión CURL y libera todos sus recursos. El recurso CURL, ch, también es eliminado. 
    curl_close ($oCurlInit);    
    return $oCurlExec;
}

