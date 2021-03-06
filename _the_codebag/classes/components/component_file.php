<?php
/**
 * @author Eduardo Acevedo Farje.
 * @link www.eduardoaf.com
 * @version 1.0.5
 * @name Component File (Antiguo CArchivo)
 * @date 10-01-2013 23:25
 */
class ComponentFile //extends MainComponent 
{
    //const NLW = "\r\n"; //windows new line
    //const NLU = "\n";   //unix new line
    //const NLM = "\r";   //ios new line

    //Sistema operativo del servidor
    private $_server_os; 
    //Separador de directorios
    private $_ds; 
    //Caracter de nueva linea
    private $_nl;
    //Copias
    //private $_path_target_file;
    //private $_path_source_file;
    
    private $_path_target_folder;
    private $_path_source_folder;    
    
    private $_filename_source;
    private $_filename_target;
    
    //key dentro del array $_FILE
    //nombre del control tipo input file
    private $_input_file_name;
    private $_target_content;

    
    //Variables de control
    private $_message = array();
    private $_is_error = false;

    public function __construct($sServerOS="linux")
    {  
        $this->_server_os = strtolower($sServerOS);
        $this->set_directoryseparator_by_os();
        $this->set_newline_by_os();
    }
    
    /**
     * Antes de llamar a este metodo hay que configurar la ruta del directorio de destino donde
     * se desea crear el archivo con set_path_target()
     * Hay que configurar el nombre del archivo con set_filename_target() incluyendo su extensión
     * con is_error() se puede comprobar si ha habido algún problema
     * con get_message() se puede identificar el estado de la operación
     * @return boolean 
     */
    public function create()
    {
        $sPathFolder = $this->fix_folderpath($this->_path_target_folder);
        if(!is_dir($sPathFolder))
        {
            $this->set_error("$this->_filename_target not created. $sPathFolder is not a valid folder");
            return false;    
        }
        
        $sPathFile = $sPathFolder.$this->_filename_target;
        if(is_file($sPathFile))
        {
            $this->set_error("$this->_filename_target not created. File already exists");
            return false;
        }
        
        //soruce file
        //x: Creación y apertura para sólo escritura; coloca el puntero al principio del archivo.
        $oCursor = fopen($sPathFile,"x");
        //bug($this->_target_content,"content");
        if($oCursor !== false)
        {
            fwrite($oCursor,""); //Grabo el caracter vacio
            if(!empty($this->_target_content)) fwrite($oCursor,$this->_target_content);
            fclose($oCursor); //cierro el archivo.
        }
        else
        {
            $this->set_error("$sPathFile not created. fopen() failed. Cursor:".var_export($oCursor,true));
            return false;
        }
        $this->_message = "File: $sPathFile created";
        return true;
    }
    
    /**
     * AÃ±ade un / al final de la ruta de un directorio si hiciera falta
     * @param string $sPathFolder
     * @return string Ruta del directorio bien formada con / al final.
     */
    private function fix_folderpath($sPathFolder)
    {
        $sPathFolder .= $this->_ds;
        //windows
        $sPathFolder = str_replace("\\\\", "\\", $sPathFolder);
        //unix
        $sPathFolder = str_replace("//", "/", $sPathFolder);
        return $sPathFolder;
    }
      
    /**
     * Antes de llamar a este metodo hay que configurar la ruta del directorio de origen y destino donde
     * se desea crear el archivo con set_path_source() y set_path_target()
     * Hay que configurar el nombre del archivo de origen y destino con set_filename_source()
     * set_filename_target() incluyendo su extensión
     * con is_error() se puede comprobar si ha habido algún problema
     * con get_message() se puede identificar el estado de la operación
     * @return boolean 
     */
    public function copy()
    {
        $sPathFolderSource = $this->fix_folderpath($this->_path_source_folder);
        $sPathFolderTarget = $this->fix_folderpath($this->_path_target_folder);
        
        if(!is_dir($sPathFolderSource))
        {
            $this->set_error("File not copied. $sPathFolderSource is not a valid folder");
            return false;
        }
        
        if(!is_dir($sPathFolderTarget))
        {
            $this->set_error("File not copied. $sPathFolderTarget is not a valid folder");
            return false;
        }
        
        $sPathSourceFile = $sPathFolderSource.$this->_filename_source;
        $sPathTargetFile = $sPathFolderTarget.$this->_filename_source;
        
        if(!is_file($sPathSourceFile)) 
        {
            $this->set_error("File not copied. $sPathSourceFile File does not exist");
            return false;
        }
    
        /*
        if(is_file($sPathTargetFile)) 
        {
            $this->set_error("File not copied. $sPathTargetFile. File already exists");
            return false;
        }*/
        
        $isCopied = copy($sPathSourceFile, $sPathTargetFile);
        if(!$isCopied)
        {
            $this->set_error("$sPathSourceFile not copied. copy() failed.");
            return false;
        }
        $this->_message = "File: $sPathSourceFile copied";
        return true;        
    }
// <editor-fold defaultstate="collapsed" desc="writelog">
    public function writelog($sType,$message="",$addfile="") 
    {
        $ok=1;
        $sLogFileName = sprintf("$this->_nl[%02d-%02d-%04d %02d:%02d:%02d]",date("d"),date("m"),date("Y"),date("H"),date("i"),date("s"));

        $sPathLogsDir = $this->_path_target_folder;
        $sSeed = "";
        switch($sType)
        {
            case "error":
                $prelog = sprintf("Logs for Errors in the aplication on %s %04d$this->_nl",date("F"),date("Y"));
                if($addfile!="") $addfile="_".$addfile;
                $filetoopen = sprintf("%smsg/errors_%04d%02d%s.log",$sPathLogsDir,date("Y"),date("m"),$addfile);
                //exit($filetoopen);
                if(file_exists($filetoopen)) $prelog="";
                if($sSeed!="") $sLogFileName.=" ".$sSeed." -";
            break;

            case "bdread":
                $prelog=sprintf("Logs for Data changes in the table %s on %s %04d$this->_nl",$addfile,date("F"),date("Y"));
                if($addfile!="") $addfile="_".$addfile;
                $filetoopen=sprintf("%sbd/req/%04d%02d%s.log",$sPathLogsDir,date("Y"),date("m"),$addfile);
                if(file_exists($filetoopen)) $prelog="";
                if($sSeed!="") $sLogFileName.=" ".$sSeed." -";
            break;

            case "login":
                $prelog=sprintf("Logs for login/logout of user %s on %s %04d$this->_nl",$sSeed,date("F"),date("Y"));
                if($addfile!="") $addfile="_".$addfile;
                $filetoopen=sprintf("%slog/%04d%02d_%s%s.log",$sPathLogsDir,date("Y"),date("m"),$sSeed,$addfile);
                if(file_exists($filetoopen)) $prelog="";
            break;

            case "logout":
                $prelog=sprintf("Logs for login/logout of user %s on %s %04d$this->_nl",$sSeed,date("F"),date("Y"));
                if($addfile!="") $addfile="_".$addfile;
                $filetoopen=sprintf("%slog/%04d%02d_%s%s.log",$sPathLogsDir,date("Y"),date("m"),$sSeed,$addfile);
                if(file_exists($filetoopen)) $prelog="";
                $sLogFileName=sprintf(" - [%02d-%02d-%04d %02d:%02d:%02d]",date("d"),date("m"),date("Y"),date("H"),date("i"),date("s"));
            break;

            case "bd_int":
                $prelog=sprintf("Logs for Integrity queries in the table %s on %s %04d$this->_nl",$addfile,date("F"),date("Y"));
                if($addfile!="") $addfile="_".$addfile;
                $filetoopen=sprintf("%sbd/int/%04d%02d%s.log",$sPathLogsDir,date("Y"),date("m"),$addfile);
                if(file_exists($filetoopen)) $prelog="";
                if($sSeed!="") $sLogFileName.=" ".$sSeed." -";
            break;

            case "sync":
                $prelog=sprintf("Logs for Sync on %s %04d$this->_nl",date("F"),date("Y"));
                if($addfile!="") $addfile="_".$addfile;
                $filetoopen=sprintf("%ssync/%04d%02d.log",$sPathLogsDir,date("Y"),date("m"));
                if(file_exists($filetoopen)) $prelog="";
                $sLogFileName=sprintf("$this->_nl[%02d:%02d:%02d]",date("H"),date("i"),date("s"))." -";
            break;

            default: $ok=0;
        }

        if($ok && $oFileOpened=@fopen($filetoopen,"ab")) 
        {
            $sLogFileName.=" ".$message;
            @fwrite($oFileOpened,$prelog.$sLogFileName);
            @fclose($oFileOpened);
        }
    }    
// </editor-fold>    
    public function move()
    {
        $sPathFolderSource = $this->fix_folderpath($this->_path_source_folder);
        $sPathFolderTarget = $this->fix_folderpath($this->_path_target_folder);
        
        if(!is_dir($sPathFolderSource))
        {
            $this->set_error("File not moved. $sPathFolderSource is not a valid folder");
            return false;
        }
        
        if(!is_dir($sPathFolderTarget))
        {
            $this->set_error("File not moved. $sPathFolderTarget is not a valid folder");
            return false;
        }
        
        $sPathSourceFile = $sPathFolderSource.$this->_filename_source;
        $sPathTargetFile = $sPathFolderTarget.$this->_filename_target;
        
        if(!is_file($sPathSourceFile)) 
        {
            $this->set_error("File not moved. $sPathSourceFile File does not exist");
            return false;
        }
        
        if(is_file($sPathTargetFile)) 
        {
            $this->set_error("File not moved. $sPathTargetFile. File already exists");
            return false;
        }
        
        $isCopied = copy($sPathSourceFile, $sPathTargetFile);
        if(!$isCopied)
        {
            $this->set_error("$sPathSourceFile not moved. copy() failed.");
            return false;
        }
        unlink($sPathSourceFile);
        $this->_message = "File: $sPathSourceFile moved";
        return true;
    }
    
    //TODO: Adaptarlo a multi os.
    public function add_content($sContent)
    {
        $sContent = $this->_nl.$sContent;
        $sPathFolder = $this->fix_folderpath($this->_path_target_folder);
        if(!is_dir($sPathFolder))
        {
            $this->set_error("$this->_filename_target not modified. $sPathFolder is not a valid folder");
            return false;    
        }
        
        $sPathFile = $sPathFolder.$this->_filename_target;
        
        if(!is_file($sPathFile))
        {
            $this->set_error("$this->_filename_target not modified. File does not exist. Will try to create it");
            //return false;
        }
        
        //ab: Actualización del archivo al final de la ultima linea. b, solo para
        //WINDOWS
        $oCursor=fopen($sPathFile,"ab");
        if($oCursor===false)
        {
            $this->set_error("$this->_filename_target not modified. fopen() failed");
            return false;
        }
        //int fwrite ( resource $handle , string $string [, int $length ] )  
        $mxWritten = fwrite($oCursor,$sContent);
        if($mxWritten===false)
        {
            fclose($oCursor);
            $this->set_error("$this->_filename_target not modified. fwrite() failed");
            return false;
        }
        fclose($oCursor);
        $this->_message = "File: $sPathFile modified. N. Chars: $mxWritten";
        return true;  
    }
    
    public function replace()
    {
        $sPathFolderSource = $this->fix_folderpath($this->_path_source_folder);
        $sPathFolderTarget = $this->fix_folderpath($this->_path_target_folder);
        
        if(!is_dir($sPathFolderSource))
        {
            $this->set_error("File not replaced. $sPathFolderSource is not a valid folder");
            return false;
        }
        
        if(!is_dir($sPathFolderTarget))
        {
            $this->set_error("File not replaced. $sPathFolderTarget is not a valid folder");
            return false;
        }
        
        $sPathSourceFile = $sPathFolderSource.$this->_filename_source;
        $sPathTargetFile = $sPathFolderTarget.$this->_filename_target;
        
        if(!is_file($sPathSourceFile)) 
        {
            $this->set_error("File not replaced. $sPathSourceFile File does not exist");
            return false;
        }
        
        if(is_file($sPathTargetFile)) unlink($sPathTargetFile);
                
        $isCopied = copy($sPathSourceFile, $sPathTargetFile);
        if(!$isCopied)
        {
            $this->set_error("$sPathSourceFile not replaced. copy() failed.");
            return false;
        }
        $this->_message = "File: $sPathSourceFile moved";
        return true;        
    }
    
    public function source_remove()
    {
        $sPathFolder = $this->fix_folderpath($this->_path_source_folder);
        if(!is_dir($sPathFolder))
        {
            $this->set_error("$this->_filename_source not created. $sPathFolder is not a valid folder");
            return false;    
        }
        
        $sPathFile = $sPathFolder.$this->_filename_source;
        if(!is_file($sPathFile))
        {
            $this->set_error("$this->_filename_source not removed. File does not exist");
            return false;
        }
        
        //soruce file
        //x: Creación y apertura para sólo escritura; coloca el puntero al principio del archivo.
        $isRemoved = unlink($sPathFile); 
        if(!$isRemoved)
        {
            $this->set_error("$sPathFile not created. unlink() failed.");
            return false;
        }
        $this->_message = "File: $sPathFile removed";
        return true;        
    }
    
    public function target_remove()
    {
        $sPathFolder = $this->fix_folderpath($this->_path_target_folder);
        if(!is_dir($sPathFolder))
        {
            $this->set_error("$this->_filename_target not created. $sPathFolder is not a valid folder");
            return false;    
        }
        
        $sPathFile = $sPathFolder.$this->_filename_target;
        if(!is_file($sPathFile))
        {
            $this->set_error("$this->_filename_target not removed. File does not exist");
            return false;
        }
        
        //soruce file
        //x: Creación y apertura para sólo escritura; coloca el puntero al principio del archivo.
        $isRemoved = unlink($sPathFile); 
        if(!$isRemoved)
        {
            $this->set_error("$sPathFile not created. unlink() failed.");
            return false;
        }
        $this->_message = "File: $sPathFile removed";
        return true;    
    }
    
    
    public function rename()
    {
        $sPathFolderSource = $this->fix_folderpath($this->_path_source_folder);
        
        if(!is_dir($sPathFolderSource))
        {
            $this->set_error("File not renamed. $sPathFolderSource is not a valid folder");
            return false;
        }
        
        $sPathSourceFile = $sPathFolderSource.$this->_filename_source;
        $sPathTargetFile = $sPathFolderSource.$this->_filename_target;
        
        if(!is_file($sPathSourceFile)) 
        {
            $this->set_error("File not renamed. $sPathSourceFile File does not exist");
            return false;
        }
        
        if(is_file($sPathTargetFile)) unlink($sPathTargetFile);
                
        $isRenamed = rename($sPathSourceFile, $sPathTargetFile);
        if(!$isRenamed)
        {
            $this->set_error("$sPathSourceFile not renamed. rename() failed.");
            return false;
        }
        $this->_message = "File: $sPathSourceFile renamed to $this->_filename_target";
        return true;
        //rename("/tmp/archivo_tmp.txt", "/home/user/login/docs/mi_archivo.txt");
    }
    
    /**
     * Antes de llamar a este metodo hay que configurar la ruta del directorio de destino donde
     * se desea subir el archivo con set_path_target().
     * Se debe asignar el nombre del archivo de destino con set_filename_target().
     * Hay que configurar el nombre del control (element html) input file con set_input_file_name();
     * con is_error() se puede comprobar si ha habido algún problema
     * con get_message() se puede identificar el estado de la operación
     * @param string $sFileName Si se utiliza este parámetro se omite el valor asignado desde set_filename_target
     * @return boolean Estado de la operación
     */
    public function upload($sFileName="")
    {
        //filSubir es el input type=file con name=filSubir
        if($_FILES[$this->_input_file_name]["error"] == UPLOAD_ERR_OK)
        {
            $sPathFileTemp = $_FILES[$this->_input_file_name]["tmp_name"];
            $sPathFolderTarget = $this->fix_folderpath($this->_path_target_folder);
            
            if(!is_dir($sPathFolderTarget))
            {
                $this->set_error("File not uploaded. $sPathFolderTarget is not a valid folder");
                return false;
            }
            
            if(empty($sFileName)) $sFileName = $this->_filename_target;
                
            $sPathFileTarget = $sPathFolderTarget . $sFileName;
            if(file_exists($sPathFileTarget))unlink($sPathFileTarget);
            
            $isMovido = move_uploaded_file($sPathFileTemp, $sPathFileTarget);
            //bug($sPathFileTemp,"temp"); bug($sPathFileTarget,"target"); bug($isMovido,"ismovido");
            if(!$isMovido)
            {
                $this->set_error("File not uploaded. It was not able to move file from temp folder: $sPathFileTemp to $sPathFolderTarget");
                return false;
            }
            $this->_message = "File successful uploaded";
            return true;
        }
        elseif ($_FILES[$this->_input_file_name]["error"] == UPLOAD_ERR_INI_SIZE)
        {
            $this->set_error("File not uploaded. File size is larger than which is defined in php.ini");
            return false;
        }
        else
        {
            $this->set_error("File not uploaded. Error: ".$_FILES[$this->_input_file_name]["error"]);
            return false;
        }
    }
    
    private function set_directoryseparator_by_os()
    {
        switch($this->_server_os) 
        {
            case "windows":
            case "w":
                $this->_ds = "\\";
            break;
            case "linux":
            case "l":
            case "unix":
            case "u":
            case "mac":
            case "m":
            case "ios":
                $this->_ds = "/";
            break;
            default:
                $this->_message = "server os not provided";
                $this->_ds = "/";
            break;
        }
    }
    
    private function set_newline_by_os()
    {
        switch($this->_server_os) 
        {
            case "windows":
            case "w":
                $this->_nl = "\r\n";
            break;            
            case "linux":
            case "l":
            case "unix":
            case "u":
                $this->_nl = "\n";
            break;
            case "mac":
            case "m":
            case "ios":
                $this->_nl = "\r";
            break;

            default:
                $this->_message = "server os not provided";
                $this->_ds = "\n";
            break;
        }
    }
    
    public function target_exists()
    {
        $sPathFolderSource = $this->fix_folderpath($this->_path_target_folder);
        $sPathTargetFile = $sPathFolderSource.$this->_filename_target;
        if(is_file($sPathTargetFile)) return true;
        return false;
    }
    
    //=======================
    // SETTERS
    //=======================
    private function set_error($sMessage)
    {
        $this->_is_error = true;
        $this->_message[] = $sMessage;
    } 
    
    public function set_path_target($sPathFile){$this->_path_target_file = $sPathFile;}
    public function set_path_source($sPathFile){$this->_path_source_file = $sPathFile;}
    public function set_filename_source($sFileName){$this->_filename_source = $sFileName;}
    public function set_filename_target($sFileName){$this->_filename_target = $sFileName;}
    public function set_path_folder_source($sPathFolder){$this->_path_source_folder = $sPathFolder;}
    public function set_path_folder_target($sPathFolder){$this->_path_target_folder = $sPathFolder;}
    public function set_target_content($sContent){$this->_target_content = $sContent;}
    /**
     * En caso de querer subir un archivo
     * @param string $sInputFileName Nombre del control tipo "file" necesario para
     * cargar el archivo que se enviará al servidor
     */
    public function set_input_file_name($sInputFileName){$this->_input_file_name = $sInputFileName;}
    
    //=======================
    // GETTERS
    //=======================
    public function is_error(){return $this->_is_error;}
    public function get_message(){return $this->_message;}
    public function get_path_folder_target(){return $this->_path_target_folder;}

}


// <editor-fold defaultstate="collapsed" desc="NOT IN USE - CLASS TO DEVELOP">
class ComponentLogs extends ComponentFile
{
    private $_path_folder_logroot;
    private $_path_folder_bdread;
    private $_path_folder_bdwrite;
    private $_path_folder_error;
    
    public function __construct($sPathFolderLogRoot="") 
    {
        parent::__construct();
        $this->_path_folder_logroot = $sPathFolderLogRoot;
        $this->_path_folder_bdread = $this->_path_folder_logroot.DS."bd".DS."read";
        $this->_path_folder_bdwrite = $this->_path_folder_logroot.DS."bd".DS."write";
        $this->_path_folder_error = $this->_path_folder_logroot.DS."error";
    }
    
    /**
     * Crea logs al ejecutar sqls de lectura
     * @param string $sFileName Código usuario_anyo_mes_día
     * @param string $sTitle hora:minuto:segundo rowsaffected
     * @param string $sSQL sentencia tipo SELECT 
     */
    public function sql_read($sFileName,$sTitle,$sSQL)
    {
        $this->set_path_folder_source($this->_path_folder_bdread);
        $this->set_filename_source($sFileName);
        $this->add_content($sTitle.WNL.$sSQL);
    }
    
    /**
     * Crea logs al ejecutar sqls de escritura
     * @param string $sFileName Código usuario_anyo_mes_día
     * @param string $sTitle hora:minuto:segundo rowsaffected
     * @param string $sSQL sentencia tipo INSERT, UPDATE y DELETE 
     */
    public function sql_write($sFileName,$sTitle,$sSQL)
    {
        $this->set_path_folder_source($this->_path_folder_bdwrite);
        $this->set_filename_source($sFileName);
        $this->add_content($sTitle.WNL.$sSQL);
    }
    
    public function error($sFileName,$sTitle,$sDescription)
    {
        $this->set_path_folder_source($this->_path_folder_error);
        $this->set_filename_source($sFileName);
        $this->add_content($sTitle.WNL.$sDescription);
    }
}
//</editor-fold>
