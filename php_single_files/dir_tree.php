<?php
//phpinfo();

$sProjectDir = "/Applications/MAMP/htdocs/proy_anytest";

function get_folders($sPathDir,$arNotToCountOn=array(),$sDS="/")
{
    $arFolders = array();
    
    if ($oDirHandler = opendir($sPathDir)) 
    {
        while(($dirElement = readdir($oDirHandler))!==false) 
        {
            $sTmPath = $sPathDir . $sDS . $dirElement;
            //bug("dirElement=$dirElement");bug($arNotToCountOn); bug("inarray=".in_array($dirElement, $arNotToCountOn));
            if(is_dir($sTmPath) && $dirElement!="." && $dirElement!=".." && !in_array($dirElement, $arNotToCountOn))
            {
                $arFolders[] = $dirElement;
            }
        }
        closedir($oDirHandler);
    }
    //bug($arFolders); 
    return $arFolders;
}


function has_dir($sPathDir,$arNotToCountOn=array(),$sDS="/")
{
    if($oDirHandler = opendir($sPathDir)) 
    {
        while(($dirElement = readdir($oDirHandler))!==false) 
        {
            $sTmPath = $sPathDir . $sDS . $dirElement; 
            //bug(is_dir($sTmPath),$sTmPath); 
            //bug($arNotToCountOn);
            if(is_dir($sTmPath) && $dirElement!="." && $dirElement!=".." && !in_array($dirElement, $arNotToCountOn))
            {
                closedir($oDirHandler);
                return true;
            }
        }
        closedir($oDirHandler);
    }
    return false;
}

function dir_tree($sPathDir,$arNotToCountOn=array(),$sDS="/")
{
    $arTree = array();
    if(is_dir($sPathDir))
    {
        $arTree[] = $sPathDir;
        //bug($sPathDir,"is dir");
        //bug($arNotToCountOn);
        if(has_dir($sPathDir,$arNotToCountOn,$sDS))
        {
            //bug($sPathDir,"has folders");
            $arSubDir = get_folders($sPathDir,$arNotToCountOn,$sDS);
            //bug($arSubDir,"subdir");
            foreach($arSubDir as $sFolderName)
            {
                $sPath = $sPathDir .$sDS. $sFolderName;
                //$arTree[] = dir_tree($sPath);
                foreach(dir_tree($sPath,$arNotToCountOn,$sDS) as $sPaths)
                {
                    $arTree[] = $sPaths;
                }
            }
        }
        
    }
    return $arTree; 
}

function load_recursive_include_path($sPathDir, $arNotToCountOn=array(), $sDS="/")
{
    //bug($arNotToCountOn);die;
    $arDirPaths = dir_tree($sPathDir,$arNotToCountOn, $sDS);
    $sDirPaths = implode(PATH_SEPARATOR,$arDirPaths);
    if(!empty($sDirPaths))
    {
        $sDirPaths = get_include_path().PATH_SEPARATOR.$sDirPaths;
        set_include_path($sDirPaths);
    }
}
//bug($_SERVER["DOCUMENT_ROOT"]);
//bug(dir_tree($sProjectDir));
load_recursive_include_path($sProjectDir,array(".svn"));
bug(get_include_path());
bug(explode(PATH_SEPARATOR,  get_include_path()));
include "ajax.php";


?>