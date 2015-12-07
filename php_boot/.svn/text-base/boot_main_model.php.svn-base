<?php
/**
* @author Eduardo Acevedo Farje
* @web www.eduardoaf.com
* @file main_model.php Picked from "The Framework"
*/
class MainModel
{
    protected $_oBD;
    protected $_sTabla;     
    //protected $_sMensaje;
    protected $_id;
    //private $oTfw;   
    
    public function __construct($sNombreTabla, $id)
    {
        $this->_oBD = CBaseDatos::get_instancia();
        $this->_oBD->conectar();
        $this->_sTabla = $sNombreTabla;
        $this->_id = $id;
    }
    
    public function query($sSQL)
    {
        $arTabla = array();
        $sTipoBD = $this->_oBD->get_tipo_bd();
        switch ($sTipoBD) 
        {
            case "mysql":
                $arTabla = $this->query_mysql($sSQL);
            break;
            case "sqlserver":
                $arTabla = $this->query_mssql($sSQL);
            default:
            break;
        }
        return $arTabla;
    }
    
    public static function search($sSQL)
    {
        $arTabla = array();
        $sTipoBD = $this->_oBD->get_tipo_bd();
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
   
    private function query_mysql($sSQL)
    {
        $arTabla = array();
        try
        {
            //$this->oTfw->set_sql($sSQL);
            $oResult = mysql_query($sSQL, $this->_oBD->get_link_id());
            //@mysql_query("SET NAMES utf8");

            while($arFila = mysql_fetch_array($oResult, MYSQL_ASSOC))
            {
                $arTabla[$this->_sTabla][] = $arFila; 
            }
            //Array que tiene como indices los nombres de los campos
            return $arTabla;
        }
        catch (Exception $e)
        {
            die("Metodo query: Error al ejecutar la sentencia SQL = $sSQL");
        }
    } 
    
    private static function search_mysql($sSQL)
    {
        $oBD = CBaseDatos::get_instancia();
        $oBD->conectar();
        
        $arTabla = array();
        try
        {
            $oResult = mysql_query($sSQL, $oBD->get_link_id());
            //@mysql_query("SET NAMES utf8"); 
            
            $i=0;
            while($arFila = mysql_fetch_array($oResult, MYSQL_ASSOC))
            {
                $arTabla[$i] = $arFila; 
                $i++;
            }
            //Array que tiene como indices los nombres de los campos
            return $arTabla;
        }
        catch (Exception $e)
        {
            die("Error al ejecutar la search");
        }
    } 
    
    public function query_object()
    {
        $arTabla = array();
        $sTipoBD = $this->_oBD->get_tipo_bd();
        switch ($sTipoBD) 
        {
            case "mysql":
                $arTabla = $this->query_object_mysql($sSQL);
            break;
            case "sqlserver":
                $arTabla = $this->query_mssql($sSQL);
            default:
            break;
        }
        return $arTabla;     
    }
    
    public function execute()
    {
        $sTipoBD = $this->_oBD->get_tipo_bd();
        switch ($sTipoBD) 
        {
            case "mysql":
                $this->execute_mysql($sSQL);
            break;
            case "sqlserver":
                $this->execute_mssql($sSQL);
            default:
            break;
        }
        return $arTabla;    
    }
    
    private function query_object_mysql($sSQL)
    {
        $arTabla = array();
        //Con esto se hace un debug de las sqls
        //            $this->oTfw->set_sql($sSQL);
        $oResult = mysql_query($sSQL, $this->_oBD->get_link_id());

        //@mysql_query("SET NAMES utf8"); 
        if($oResult)
        {
            while($arFila = mysql_fetch_object($oResult))
            {
                $arTabla[] = $arFila; 
            }
        }
        else
        {
            die("Metodo query_object: Error al ejecutar la sentencia SQL = $sSQL");  
        }
        //$arTabla tiene como indices los nombres de los campos
        return $arTabla;
    }   
    
    private function execute_mysql($sSQL)
    {
        try
        {
            $oResult = mysql_query($sSQL);
            if (!$oResult)
            {
                $sMensaje  = "Sentencia SQL con errores: " . mysql_error() . "\n";
                $sMensaje .= "SQL ="  . $sSQL;
                die($sMensaje);
            }
        }
        catch(Exception $e)
        {

        }        
    }
    
    private function query_mssql($sSQL)
    {
        $arTabla = array();
        try
        {
            //$this->oTfw->set_sql($sSQL);
            $oResult = mssql_query($sSQL, $this->_oBD->get_link_id());
            //@mssql_query("SET NAMES utf8");

            while($arFila = mssql_fetch_array($oResult, MSSQL_ASSOC))
            {
                $arTabla[$this->_sTabla][] = $arFila; 
            }
            //Array que tiene como indices los nombres de los campos
            return $arTabla;
        }
        catch (Exception $e)
        {
            die("Metodo query: Error al ejecutar la sentencia SQL = $sSQL");
        }
    } 
    
    private static function search_mssql($sSQL)
    {
        $oBD = CBaseDatos::get_instancia();
        $oBD->conectar();
        
        $arTabla = array();
        try
        {
            $oResult = mssql_query($sSQL, $oBD->get_link_id());
            //@mssql_query("SET NAMES utf8"); 
            
            $i=0;
            while($arFila = mssql_fetch_array($oResult, MSSQL_ASSOC))
            {
                $arTabla[$i] = $arFila; 
                $i++;
            }
            //Array que tiene como indices los nombres de los campos
            return $arTabla;
        }
        catch (Exception $e)
        {
            die("Error al ejecutar la search");
        }
    } 
    
    private function query_object_mssql($sSQL)
    {
        $arTabla = array();
        //Con esto se hace un debug de las sqls
        //            $this->oTfw->set_sql($sSQL);
        $oResult = mssql_query($sSQL, $this->_oBD->get_link_id());

        //@mssql_query("SET NAMES utf8"); 
        if($oResult)
        {
            while($arFila = mssql_fetch_object($oResult))
            {
                $arTabla[] = $arFila; 
            }
        }
        else
        {
            die("Metodo query_object: Error al ejecutar la sentencia SQL = $sSQL");  
        }
        //$arTabla tiene como indices los nombres de los campos
        return $arTabla;
    }   
    
    private function execute_mssql($sSQL)
    {
        try
        {
            //$this->oTfw->set_sql($sSQL);
            $oResult = mssql_query($sSQL);
            //@mssql_query("SET NAMES utf8"); 
            
            if (!$oResult)
            {
                $sMensaje  = "Sentencia SQL con errores: " . mssql_error() . "\n";
                $sMensaje .= "SQL ="  . $sSQL;
                die($sMensaje);
            }
        }
        catch(Exception $e)
        {

        }        
    }   
    
    /**
    * Obtiene un array con dos campos, por defecto "id" y  "nombre_es"
    * 
    * @param mixed $campo = nombre_es sino se pasa nada
    * @param mixed $campo_clave  = id sino se pasa nada
    */
    public function get_lista($campo=null, $campo_clave=null)
    {
        if(empty($campo_clave))
        {
            $campo_clave="id";
        }
        
        if(empty($campo))
        {
            $campo = "nombre_es"; 
        }
        
        $sSelect = "SELECT $campo_clave, $campo ";  
        
        $sSQL = $sSelect . 
                "FROM $this->_sTabla  
                ORDER BY $campo ASC
                ";
        $arObject = $this->query_object($sSQL);
        
        foreach($arObject as $oSeudo)
        {
            $arLista[$oSeudo->id] = $oSeudo->{$campo};
        }
        
        //bug($arLista);
        return $arLista;        
    }
    
    public function get_mysql_last_id()
    {
        $sSQL="SELECT LAST_INSERT_ID() AS last_id";
        $arObject = $this->query_object($sSQL);
        //bug($arObject);
        $last_id = $arObject[0]->last_id;
        return $last_id;
    }
         
    public function get_id()
    {
        return $this->_id;
    }
    
    public function get_slug($sString, $sCharEspacio="-")
    {
        $sSlug = $sString;
        
        $sArCharSucios = array
        (
            //caracter valido => caracteres invalidos
            '' => array
                (
                    "\'", "\"", "'", "|", "@", "#", "·", "$", "%", "&", "¬", "(", ")", "=", "?", "¿", 
                    "[", "]", "*", "+",  "\\", "/", "ª", "º", "{", "}", "<", ">", ";", ",", ":",
                    "¡", "!", "^"
                ),
            'a' => array("á", "Á", "ä", "Ä", "â", "Â" ),
            'e' => array("é", "É", "ë", "Ë", "ê", "Ê" ),
            'i' => array("í", "Í", "ï", "Ï", "î", "Î" ),
            'o' => array("ó", "Ó", "ö", "Ö", "ô", "Ô" ),
            'u' => array("ú", "Ú", "ü", "Ü", "û", "Ü" ),
            'n' => array("ñ", "Ñ")
        );
        
        //Lo pasamos todo a minusculas
        $sSlug = strtolower($sSlug);
        
        //Relizamos la sustitucion de los caracteres extraños
        foreach($sArCharSucios as $cIndice => $sArValor)
        {
            foreach($sArValor as $cCharSucio)
            { 
                $sSlug = str_replace($cCharSucio, $cIndice, $sSlug);
            }
        } 
        
        //Los espacios se cambian por el char en el argumento
        $sSlug = str_replace(" ", $sCharEspacio, $sSlug);
        
        return $sSlug;       
    }

    protected function get_nombre_tabla()
    {
        return $this->_sTabla;
    }
}
?>