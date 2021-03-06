<?php
/**
* @author Eduardo Acevedo Farje
* @version 1.2.3
* @web http://www.eduardoaf.com/blog-programacion/programacion-php/php-conectar-con-sql-server-utilizando-clase-singleton-cbasedatos/
* Clase tipo SINGLETON para interactuar con bases de datos sqlserver y mysql
*/
class Database 
{
    private $_sServidor;
    private $_sNombreBD;
    private $_sUsuario;
    private $_sClave;
    private $_sTipoBD;
   
    private $_oLinkId;
    private $_sMensaje;
    private $_isError;
    private $_iRowsAffected;
   
    /**
    * @var CBaseDatos
    */
    private static $_oSelf = null;
   
    private function __construct($sServidorBD="",$sNombreBD="",$sUserBD="",$sClaveBD="",$sTipoBD="")
    {
        $this->_sServidor = $sServidorBD;
        $this->_sNombreBD = $sNombreBD;
        $this->_sUsuario = $sUserBD;
        $this->_sClave = $sClaveBD;
        $this->_sTipoBD = $sTipoBD;
        //Se sobreescribe los vacios
        if(empty($sServidorBD))$this->_sServidor = TFW_DB_SERVER;
        if(empty($sNombreBD))$this->_sNombreBD = TFW_DB_NAME;
        if(empty($sUserBD))$this->_sUsuario = TFW_DB_USER;
        if(empty($sClaveBD))$this->_sClave = TFW_DB_PASSWORD;
        if(empty($sTipoBD))$this->_sTipoBD = TFW_DB_TYPE;
        if(empty($this->_sTipoBD)) $this->_sTipoBD = "mysql";
        //object con Id de Conexión
        $this->_oLinkId = null; 
        $this->_sMensaje = "";
        $this->_isError = false;
    }
   
    /**
    * Este es el pseudo constructor singleton
    * Comprueba si la variable privada $_oSelf tiene un objeto
    * de esta misma clase, sino lo tiene lo crea y lo guarda en dicha variable
    * @return CBaseDatos
    */
    public static function get_instancia($sServidorBD="",$sNombreBD="",$sUserBD="",$sClaveBD="",$sTipo="")
    {

        if(!self::$_oSelf instanceof self)
        {
            self::$_oSelf = new self($sServidorBD,$sNombreBD,$sUserBD,$sClaveBD,$sTipo);
        }
        return self::$_oSelf;
    }

    //=================== CONECTAR ===========================
    private function conectar_mysql()
    {
        $sNombreBD = $this->_sNombreBD;
        if($this->_oLinkId==0 || $this->_oLinkId==null)
        {
            $oConnect = mysql_connect
            (
                $this->_sServidor,
                $this->_sUsuario,
                $this->_sClave
            );
            if(!is_resource($oConnect))
            {
                $this->_sMensaje = "ERROR 0001: No se pudo conectar con la base de datos \"$sNombreBD\"";
                $this->_isError = true;
                return false;
            }
           
            $isExisteBD = mysql_select_db($this->_sNombreBD, $oConnect);
            //si no se pudo encontrar esa BD lanza un error
            if(!$isExisteBD)
            {
                $this->_sMensaje = "ERROR 0002: La base de datos \"$sNombreBD\" ";
                $this->_isError = true;
                return false;
            }
            //Hay base de datos y se conecto
            else
            {
                //Guardo el id de conexión
                $this->_oLinkId = $oConnect;
                $this->_sMensaje = "Conexión realizada con la bd: \"$sNombreBD\"";  
                mysql_set_charset('utf8',$this->_oLinkId);
            }
        }
        //Ya existe recurso abierto, oLinkId!=0
        else
        {}
        return true;
    }
   
    private function conectar_sqlserver()
    {
        $sNombreBD = $this->_sNombreBD;
        if($this->_oLinkId==0 || $this->_oLinkId==null)
        {
            $oConnect = mssql_connect
            (
                $this->_sServidor,
                $this->_sUsuario,
                $this->_sClave
            );
            
            if(!is_resource($oConnect))
            {
                $this->_sMensaje = "ERROR 0003: No se puede conectar a la base de datos..! ".$this->_sNombreBD;
                $this->_isError = true;
                return false;
            }
           
            $isExisteBD  = mssql_select_db($this->_sNombreBD, $oConnect);
            if(!$isExisteBD)
            {
                $this->_sMensaje = "ERROR 0004: La base de datos \"$sNombreBD\" ";
                $this->_isError = true;
                return false;
            }
            //Hay base de datos y se conectó
            else
            {
                $this->_oLinkId = $oConnect;
                $this->_sMensaje = "Conexión realizada con la bd: \"$sNombreBD\"";  
            }
        }
        //Existe recurso abierto
        else
        {}
        return true;
    }
   
    public function conectar()
    {
        $sTipoBD = $this->_sTipoBD;
        $isConnected = false;
        switch ($sTipoBD)
        {
            case "mysql":
                $isConnected = $this->conectar_mysql();
            break;
            case "sqlserver":
                $isConnected = $this->conectar_sqlserver();
            default:
            break;
        }
        return $isConnected;
    }
    //=================== FIN CONECTAR ===========================
    
    //Metodos para utilización de codificación utf8. Sobre todo para entornos windows
    //como SQLServer 2008
    private function convert_to_utf8($arRow=array(), $origCollation="windows-1252")
    {
        $arRowInUtf8 = array();
        foreach ($arRow as $sFieldName => $sValue)
        {
            $arRowInUtf8[$sFieldName] = iconv($origCollation, "utf-8", trim($sValue));
        }
        return $arRowInUtf8;
    }    
    
    private function convert_to_windows($arRow=array(), $origCollation="utf-8")
    {
        $arRowInWindows = array();
        foreach ($arRow as $sFieldName => $sValue)
        {
            $arRowInWindows[$sFieldName] = iconv($origCollation, "windows-1252", $sValue);
        }
        return $arRowInWindows;
    }        
   
    //==================== QUERY==================================
    private function query_mysql($sSQL, $sNombreTabla="table")
    {
        //Cuando se recupera un objeto desde sesion no cuenta
        //con linkid (linkid = 0)
        if(empty($this->_oLinkId)) $this->conectar();
        
        try
        {
            $arTabla = array();
            $arFilas = array();

            $oResource = mysql_query($sSQL, $this->_oLinkId);
            if($oResource!=false)
            {  
                while($arFila = mysql_fetch_array($oResource, MYSQL_ASSOC))
                {
                    $arFilas[] = $arFila;
                }
                if(!empty($sNombreTabla))
                {
                    $arTabla[$sNombreTabla] = $arFilas;
                }
                else
                {
                    $arTabla = $arFilas;
                }
            }
            else
            {
                $this->_isError = true;
                $this->_sMensaje = "ERROR EN SQL: $sSQL";
                return -1;
            }
            return $arTabla;
        }
        catch (Exception $e)
        {
            $this->_isError = true;
            $this->_sMensaje = "ERROR 0005 SQL: $sSQL,\n".$e->getMessage();
            return -1;
        }
    }
    
    private function query_mssql($sSQL, $sNombreTabla="table")
    {
        //Cuando se recupera un objeto desde sesion no cuenta
        //con linkid (linkid = 0)
        if(empty($this->_oLinkId)) $this->conectar();

        $arTabla = array();
        $arFilas = array();
       
        try
        {
            $oResource = mssql_query($sSQL, $this->_oLinkId);
            //oResource existen filas afectadas, true consulta ok pero sin filas
            //false error al ejecutar consulta
            //$oResource=true ó $oResource
            if($oResource!=false)
            {
                while($arFila = mssql_fetch_array($oResource, MSSQL_ASSOC))
                {
                    $arFilas[] = $this->convert_to_utf8($arFila);
                }
                if(!empty($sNombreTabla)) $arTabla[$sNombreTabla] = $arFilas;
                else $arTabla = $arFilas;
                
                $this->_iRowsAffected = mssql_num_rows($oResource);
                mssql_free_result($oResource);
            }
            //$oResource == false //TODO habría que estudiar en que casos se dá
            //esta condición y en que otros se lanza la excepción
            else
            {
                $this->_isError = true;
                $this->_sMensaje = "ERROR EN SQL: $sSQL";
                return -1;
            }            
            return $arTabla;
        }
        catch (Exception $e)
        {
            $this->_isError = true;
            $this->_sMensaje = "ERROR 0006 SQL: $sSQL,\n".$e->getMessage();
            return -1;
        }
    }
    
    public function query($sSQL, $sNombreTabla="")
    {
        $sTipoBD = $this->_sTipoBD;
        $arTabla = array();
        switch ($sTipoBD)
        {
            case "mysql":
                $arTabla = $this->query_mysql($sSQL,$sNombreTabla);
            break;
            case "sqlserver":
                $arTabla = $this->query_mssql($sSQL,$sNombreTabla);
            default:
            break;
        }
        return $arTabla;
    }
    //==================== FIN QUERY ================================
   
    //==================== QUERY OBJECT ================================
    private function query_object_mysql($sSQL)
    {
        try
        {
            $arTabla = array();
            //TODO comprobar lo que devuelve _query
            $oResource = mysql_query($sSQL, $this->_oLinkId);
            while($arFila = mysql_fetch_object($oResource))
            {
                $arTabla[] = $arFila;
            }
            return $arTabla;
        }
        catch (Exception $e)
        {
            $this->_isError = true;
            $this->_sMensaje = "ERROR 0011 SQL: $sSQL,\n".$e->getMessage();
            return -1;
        }
    }
    
    private function query_object_mssql($sSQL)
    {
        try
        {
            $arTabla = array();
            //TODO comprobar lo que devuelve _query
            $oResource = mssql_query($sSQL, $this->_oLinkId);
            
            while($arFila = mssql_fetch_object($oResource))
            {
                $arTabla[] = $arFila;
            }
            $this->_iRowsAffected = mssql_num_rows($oResource);
            mssql_free_result($oResource);            
            return $arTabla;
        }
        catch (Exception $e)
        {
            $this->_isError = true;
            $this->_sMensaje = "ERROR 0012 SQL: $sSQL,\n".$e->getMessage();
            return -1;
        }
    }
    
    public function query_object($sSQL)
    {
        $sTipoBD = $this->_sTipoBD;
        $arTabla = array();
        switch ($sTipoBD)
        {
            case "mysql":
                $arTabla = $this->query_object_mysql($sSQL);
            break;
            case "sqlserver":
                $arTabla = $this->query_object_mssql($sSQL);
            default:
            break;
        }
        return $arTabla;    
    }    
    //==================== FIN QUERY OBJECT ================================

    //==================== EXECUTE ================================
    private function execute_mysql($sSQL)
    {
        //Cuando se recupera un objeto desde sesion no cuenta
        //con linkid (linkid = 0)
        if(empty($this->_oLinkId)) $this->conectar();

        try
        {
            $oResource = mysql_query($sSQL, $this->_oLinkId);
            if($oResource!=false)
            {  
                $this->_iRowsAffected = mysql_affected_rows();
                //Al escribir no se puede utilizar
                //mysql_free_result($oResource);        
                $this->_isError = false;
                $this->_sMensaje = "executed: $sSQL";
                return true;
            }
            else
            {
                $this->_isError = true;
                $this->_sMensaje = "ERROR EN SQL: $sSQL";
                return -1;
            }            
        }
        catch(Exception $e)
        {
            $sMensaje  = "Excepción: ".$e->getMessage();
            $sMensaje .= "\nSQL = $sSQL";
            $this->_isError = true;
            $this->_sMensaje = $sMensaje;
            return -1;
        }
    }
   
    private function execute_mssql($sSQL)
    {
        //Cuando se recupera un objeto desde sesion no cuenta
        //con linkid (linkid = 0)
        if(empty($this->_oLinkId)) $this->conectar();

        try
        {
            $oResource = mysql_query($sSQL, $this->_oLinkId);
            if($oResource!=false)
            {  
                $this->_iRowsAffected = mssql_affected_rows();
                //mssql_free_result($oResource);        
                $this->_isError = false;
                $this->_sMensaje = "executed: $sSQL";
                return true;
            }
            else
            {
                $this->_isError = true;
                $this->_sMensaje = "ERROR EN SQL: $sSQL";
                return -1;
            }            
        }
        catch(Exception $e)
        {
            $sMensaje  = "Excepción: ".$e->getMessage();
            $sMensaje .= "\nSQL = $sSQL";
            $this->_isError = true;
            $this->_sMensaje = $sMensaje;
            return -1;
        }
    }  

    public function execute($sSQL)
    {
        $sTipoBD = $this->_sTipoBD;
        switch ($sTipoBD)
        {
            case "mysql":
                return $this->execute_mysql($sSQL);
            break;
            case "sqlserver":
                return $this->execute_mssql($sSQL);
            break;
            default:
            break;
        }
        return null;
    }
    //==================== FIN EXECUTE ================================
    
    /*
    //==================== TODO SEARCH ================================
     * METODOS PENDIENTES DE HACER
    private static function search_mysql($sSQL)
    {
        //falta parametros en el consructor y en la función,
        //como el tipo de bd, sino se asumiria solo las constantes
        //y seria unicamente para hacer queries sobre mysql
        $oBD = self::get_instancia();
        $isConnected = $oBD->conectar();
        if($isConnected)
        {
            $arTabla = array();
            try
            {
                $oResource = mysql_query($sSQL, $oBD->get_link_id());
                while($arFila = mysql_fetch_array($oResource, MYSQL_ASSOC))
                {
                    $arTabla[] = $arFila;
                }
                return $arTabla;
            }
            catch (Exception $e)
            {
                die("ERROR 0008: No se pudo ejecutar la función search. ".$e->getMessage());
            }            
        }
        //Error de conexion
        else
        {
            die("ERROR 0007: No se pudo conectar");
        }
    }
    private static function search_mssql($sSQL)
    {
        $oBD = self::get_instancia();
        $isConnected = $oBD->conectar();
        if($isConnected)
        {
            $arTabla = array();
            try
            {
                $oResource = mssql_query($sSQL, $oBD->get_link_id());
                while($arFila = mssql_fetch_array($oResource, MSSQL_ASSOC))
                {
                    $arTabla[] = $arFila;
                }
                return $arTabla;
            }
            catch (Exception $e)
            {
                die("ERROR 0010: No se pudo ejecutar la función search. ".$e->getMessage());
            }            
        }
        //Error de conexion
        else
        {
            die("ERROR 0009: No se pudo conectar");
        }
    }
    public static function search($sSQL)
    {
        $arTabla = array();
        switch ($sTipoBD)
        {
            case "mysql":
                $arTabla = self::search_mysql($sSQL);
            break;
            case "sqlserver":
                $arTabla = self::search_mssql($sSQL);
            default:
            break;
        }
        return $arTabla;
    }
    //==================== FIN SEARCH ================================
    */
    
    //================== GET ==================================
    private function get_servidor()
    {
        return $this->_sServidor;
    }

    public function get_usuario()
    {
        return $this->_sUsuario;
    }

    private function get_clave()
    {
        return $this->_sClave;
    }

    public function get_mensaje()
    {
        return $this->_sMensaje;
    }
   
    public function get_nombre_bd()
    {
        return $this->_sNombreBD;
    }

    private function get_link_id()
    {
        return $this->_oLinkId;
    }        
   
    public function get_tipo_bd()
    {
        return $this->_sTipoBD;
    }
    
    public function is_error()
    {
        return $this->_isError;
    }
    
    public function get_rows_afected()
    {
        return $this->_iRowsAffected;
    }
}