<?php
/**
 * @author Eduardo Acevedo Farje.
 * @link www.eduardoaf.com
 * @version 1.0.0
 * @name Component Mailing
 * @date 10-01-2013 23:25
 */
//http://www.forosdelweb.com/f18/configuracion-php-ini-function-mail-523713/
class ComponentMailing extends MainComponent
{
    private $_email_origen = "test@telynet.com";
    private $_email_destino;
    private $_asunto;
    private $_contenido;
    private $_cabeceras;
    
    private $_is_error = false;
    private $_mensaje;
    
    public function __construct($sEmailDestino,$sAsunto,$sContenido)
    {
        $this->_email_destino = $sEmailDestino;
        $this->_asunto = $sAsunto;
        $this->_contenido = $sContenido;
    }
    
    public function enviar()
    {  
        /*$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
        $cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

        // Cabeceras adicionales
        $cabeceras .= 'To: Mary <mary@example.com>, Kelly <kelly@example.com>' . "\r\n";
        $cabeceras .= 'From: Recordatorio <cumples@example.com>' . "\r\n";
        $cabeceras .= 'Cc: birthdayarchive@example.com' . "\r\n";
        $cabeceras .= 'Bcc: birthdaycheck@example.com' . "\r\n";
        */
        $sEmailsDestino = $this->_email_destino;
        $sAsunto = $this->_asunto;
        $sContenido = $this->_contenido;
        
        $sCabeceras = $this->_cabeceras;
        if(empty($sCabeceras))  $sCabeceras = "From: Recordatorio <$this->_email_origen>    \r\n";
        $mxStatus = mail($sEmailsDestino, $sAsunto, $sContenido, $sCabeceras);
        if($mxStatus == false)
        {
            $this->_is_error = true;
            $this->_mensaje = "Error al enviar correo!";
        }
        return $this->_is_error;
    }
    
    public function set_asunto($sAsunto)
    {
        $this->_asunto = $sAsunto;
    }
        
    public function set_email_origen($sEmail)
    {
        $this->_email_origen = $sEmail;
    }
    
    public function set_email_destino($sEmail)
    {
        $this->_email_destino = $sEmail;
    }
    
    public function set_cabeceras($sCabeceras)
    {
        $this->_contenido = $sCabeceras;
    }
    
    public function set_contenido($sContenido)
    {
        $this->_contenido = $sContenido;
    }

    
}