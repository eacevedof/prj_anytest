<?php
/**
@author: Eduardo Acevedo Farje
@email: eacevedof@yahoo.es
@web: www.eduardoaf.com
@file: component_database.php
@version: 1.0.2
@date: 18/01/2013 18:18 (SPAIN)
*/
class CDataBase //Singleton
{
    private $_sServer;
    private $_sDBName;
    private $_sUserName;
    private $_sPassword;
    private $_sType;
   
    private $_oLinkId;
    private $_sMessage;
    private $_isError;
   
    /**
    * @var CDataBase
    */
    private static $_oSelf = null;
   
    /**
     *
     * @param string $sServer IP or DNS: ie: 192.168.1.22 or srv_001
     * @param string $sDbName ie: db_payements
     * @param string $sDbUser ie: imroot
     * @param string $sDbPassw ie: ItIsMyAccess
     * @param string $sDbType ie: sqlserver | mysql
     */
    private function __construct($sServer="",$sDbName="",$sDbUser="",$sDbPassw="",$sDbType="mysql")
    {
        if(empty($sServer)){$this->_sServer = TFW_DB_SERVER;}
        if(empty($sDbName)){$this->_sDBName = TFW_DB_NAME;}
        if(empty($sDbUser)){$this->_sUserName = TFW_DB_USER;}
        if(empty($sDbPassw)){$this->_sPassword = TFW_DB_PASSWORD;}
        $this->_sType = strtolower(trim($sDbType));
        $this->_oLinkId = null; //oId de Conexión
        $this->_sMessage = "";
        $this->_isError = false;
    }
   
    /**
    * Este es el pseudo constructor singleton
    * Comprueba si la variable privada $_oSelf tiene un objeto
    * de esta misma clase, sino lo tiene lo crea y lo guarda
    * @return CDataBase
    */
    public static function get_instance($sServer="",$sDbName="",$sDbUser="",$sDbPassw="",$sTipo="mysql")
    {
        if(!self::$_oSelf instanceof self)
        {
            self::$_oSelf = new self($sServer,$sDbName,$sDbUser,$sDbPassw,$sTipo);
        }
        return self::$_oSelf;
    }

    //=================== CONECTAR ===========================
    private function connect_mysql()
    {
        $sDbName = $this->_sDBName;
        if($this->_oLinkId==0)
        {
            $oConnect = mysql_connect
            (
                $this->_sServer,
                $this->_sUserName,
                $this->_sPassword
            );
            if(!is_resource($oConnect))
            {
                $this->_sMessage = "ERROR 0001: No se pudo conectar con la base de datos \"$sDbName\"";
                $this->_isError = true;
                return false;
            }
           
            $isExisteBD = mysql_select_db($this->_sDBName, $oConnect);
            //si no se pudo encontrar esa BD lanza un error
            if(!$isExisteBD)
            {
                $this->_sMessage = "ERROR 0002: La base de datos \"$sDbName\" ";
                $this->_isError = true;
                return false;
            }
            //Hay base de datos y se conecto
            else
            {
                //Guardo el id de conexión
                $this->_oLinkId = $oConnect;
                $this->_sMessage = "Conexión realizada con la bd: \"$sDbName\"";  
                mysql_set_charset('utf8',$this->_oLinkId);
            }
        }
        //Ya existe recurso abierto, oLinkId!=0
        else
        {}
        return true;
    }
   
    private function connect_sqlserver()
    {
        $sDbName = $this->_sDBName;
        if($this->_oLinkId==0)
        {
            $oConnect = mssql_connect
            (
                $this->_sServer,
                $this->_sUserName,
                $this->_sPassword
            );

            if(!is_resource($oConnect))
            {
                $this->_sMessage = "ERROR 0003: No se puede conectar a la base de datos..! ".$this->_sDBName;
                $this->_isError = true;
                return false;
            }
           
            $isExisteBD  = mssql_select_db($this->_sDBName, $oConnect);
            if(!$isExisteBD)
            {
                $this->_sMessage = "ERROR 0004: La base de datos \"$sDbName\" ";
                $this->_isError = true;
                return false;
            }
            //Hay base de datos y se conecto
            else
            {
                $this->_oLinkId = $oConnect;
                $this->_sMessage = "Conexión realizada con la bd: \"$sDbName\"";  
            }
        }
        //Existe recurso abierto
        else
        {}
        return true;
    }
   
    public function connect()
    {
        $sDbType = $this->_sType;
        $isConnected = false;
        switch ($sDbType)
        {
            case "mysql":
                $isConnected = $this->connect_mysql();
            break;
            case "sqlserver":
                $isConnected = $this->connect_sqlserver();
            default:
            break;
        }
        return $isConnected;
    }
    //=================== FIN CONECTAR ===========================
   
    //==================== QUERY==================================
    private function query_mysql($sSQL, $sNombreTabla="table")
    {
        //Cuando se recupera un objeto desde sesion no cuenta
        //con linkid (linkid = 0)
        $oLinkId = $this->_oLinkId;
        if(empty($oLinkId))
            $this->connect();
        try
        {
            $arTabla = array();
            $arFilas = array();
           
            //bug($this,"component_base_datos.query_mysql");
            //bug($sSQL,"component_base_datos.query_mysql");
            $oQuery = mysql_query($sSQL, $this->_oLinkId);
            //bug($oQuery,"component_base_datos.query_mysql.oquery");
            if($oQuery!=false)
            {  ////TODO error importante pq es por un fallo en la sql
                while($arFila = mysql_fetch_array($oQuery, MYSQL_ASSOC))
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
                $this->_sMessage = "ERROR EN SQL: $sSQL";
                return -1;
            }
            return $arTabla;
        }
        catch (Exception $e)
        {
            $this->_isError = true;
            $this->_sMessage = "ERROR 0005 SQL: $sSQL, $e ";
            return -1;
        }
    }
    private function query_mssql($sSQL, $sNombreTabla="table")
    {
        //Cuando se recupera un objeto desde sesion no cuenta
        //con linkid (linkid = 0)
        $oLinkId = $this->_oLinkId;
        if(empty($oLinkId))
            $this->connect();

        $arTabla = array();
        $arFilas = array();
       
        try
        {
            //errorson();
            $oQuery = mssql_query($sSQL, $this->_oLinkId);
            if($oQuery!=false)
            {
                while($arFila = mssql_fetch_array($oQuery, MSSQL_ASSOC))
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
               
                $sMensaje  = "Sentencia SQL con errores: ".mssql_get_last_message()."\n";
                $sMensaje .= "SQL = $sSQL";
                $this->_isError = true;
                $this->_sMessage = $sMensaje;
                return false;
            }            
            return $arTabla;
        }
        catch (Exception $e)
        {
            $this->_isError = true;
            $this->_sMessage = "ERROR 0006 SQL: $sSQL, $e ";
            return -1;
        }
    }
    public function query($sSQL, $sNombreTabla="")
    {
        $sDbType = $this->_sType;
        $arTabla = array();
        switch ($sDbType)
        {
            case "mysql":
                $arTabla = $this->query_mysql($sSQL,$sNombreTabla);
            break;
            case "sqlserver":
                $arTabla = $this->query_mssql($sSQL,$sNombreTabla);
            default:
            break;
        }
        CDebug::set_sql($sSQL, count($sSQL));
        return $arTabla;
    }
    //==================== FIN QUERY ================================
   
    //==================== TODO SEARCH ================================
    private static function search_mysql($sSQL)
    {
        //falta parametros en el consructor y en la función,
        //como el tipo de bd, sino se asumiria solo las constantes
        //y seria unicamente para hacer queries sobre mysql
        $oBD = self::get_instance();
        $isConnected = $oBD->connect();
        if($isConnected)
        {
            $arTabla = array();
            try
            {
                $oQuery = mysql_query($sSQL, $oBD->get_link_id());
                while($arFila = mysql_fetch_array($oQuery, MYSQL_ASSOC))
                {
                    $arTabla[] = $arFila;
                }
                return $arTabla;
            }
            catch (Exception $e)
            {
                die("ERROR 0008: No se pudo ejecutar la función search. $e");
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
        $oBD = CDataBase::get_instance();
        $oBD->connect();
        if($isConnected)
        {
            $arTabla = array();
            try
            {
                $oQuery = mssql_query($sSQL, $oBD->get_link_id());
                while($arFila = mssql_fetch_array($oQuery, MSSQL_ASSOC))
                {
                    $arTabla[] = $arFila;
                }
                return $arTabla;
            }
            catch (Exception $e)
            {
                die("ERROR 0010: No se pudo ejecutar la función search. $e");
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
        switch ($sDbType)
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
   
    //==================== QUERY OBJECT ================================
    private function query_object_mysql($sSQL)
    {
        //bug($sSQL,"query_object_mysql");
        try
        {
            $arTabla = array();
            //TODO comprobar lo que devuelve _query
            $oQuery = mysql_query($sSQL, $this->_oLinkId);
            while($arFila = mysql_fetch_object($oQuery))
            {
                $arTabla[] = $arFila;
            }
            return $arTabla;
        }
        catch (Exception $e)
        {
            $this->_isError = true;
            $this->_sMessage = "ERROR 0011 SQL: $sSQL, $e ";
            return -1;
        }
    }  
    private function query_object_mssql($sSQL)
    {
        try
        {
            $arTabla = array();
            //TODO comprobar lo que devuelve _query
            $oQuery = mssql_query($sSQL, $this->_oLinkId);
            while($arFila = mssql_fetch_object($oQuery))
            {
                $arTabla[] = $arFila;
            }
            return $arTabla;
        }
        catch (Exception $e)
        {
            $this->_isError = true;
            $this->_sMessage = "ERROR 0012 SQL: $sSQL, $e ";
            return -1;
        }
    }  
    public function query_object($sSQL)
    {
        $sDbType = $this->_sType;
        $arTabla = array();
        switch ($sDbType)
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
    private function execute_mysql($sSQL)
    {
                //Cuando se recupera un objeto desde sesion no cuenta
        //con linkid (linkid = 0)
        $oLinkId = $this->_oLinkId;
        if(empty($oLinkId))
            $this->connect();

        try
        {
            //Zero if execution was successful. Non-zero if an error occurred.
            //The error code and message can be obtained by calling mysql_stmt_errno() and mysql_stmt_error().
            $isResource = mysql_query($sSQL);
            if(!$isResource)
            {
                $sMensaje  = "Sentencia SQL con errores: ".mysql_error()."\n";
                $sMensaje .= "SQL = $sSQL";
                $this->_isError = true;
                $this->_sMessage = $sMensaje;
                return false;
            }
        }
        catch(Exception $e)
        {
            $sMensaje  = "Exepcion: $e \n";
            $sMensaje .= "SQL = $sSQL";
            $this->_isError = true;
            $this->_sMessage = $sMensaje;
            return false;
        }
        $this->_isError = false;
        $this->_sMessage = "executed: $sSQL";
        return true;
    }
   
    private function execute_mssql($sSQL)
    {
                //Cuando se recupera un objeto desde sesion no cuenta
        //con linkid (linkid = 0)
        $oLinkId = $this->_oLinkId;
        if(empty($oLinkId))
            $this->connect();

        try
        {
            //Zero if execution was successful. Non-zero if an error occurred.
            //The error code and message can be obtained by calling mysql_stmt_errno() and mysql_stmt_error().
            $isResource = mssql_query($sSQL);
            if(!$isResource)
            {
                $sMensaje  = "Sentencia SQL con errores: ".mssql_get_last_message()."\n";
                $sMensaje .= "SQL = $sSQL";
                $this->_isError = true;
                $this->_sMessage = $sMensaje;
                return false;
            }
        }
        catch(Exception $e)
        {
            $sMensaje  = "Exepcion: $e \n";
            $sMensaje .= "SQL = $sSQL";
            $this->_isError = true;
            $this->_sMessage = $sMensaje;
            return false;
        }
        $this->_isError = false;
        $this->_sMessage = "executed: $sSQL";
        return true;
    }  

    public function execute($sSQL)
    {
        $sDbType = $this->_sType;
        switch ($sDbType)
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
   
    //GEETTTSSS==================
    private function get_servidor()
    {
        return $this->_sServer;
    }

    public function get_usuario()
    {
        return $this->_sUserName;
    }

    private function get_clave()
    {
        return $this->_sPassword;
    }

    public function get_mensaje()
    {
        return $this->_sMessage;
    }
   
    public function get_nombre_bd()
    {
        return $this->_sDBName;
    }

    private function get_link_id()
    {
        return $this->_oLinkId;
    }        
   
    public function get_tipo_bd()
    {
        return $this->_sType;
    }
 
    public function is_error()
    {
        return $this->_isError;
    }
}