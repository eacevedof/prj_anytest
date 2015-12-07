<?php
class Tfw
{
    /**
     * Hace includes. Utilizar las constantes predefinidas son de nombre identico a las carpetas racices
     *
     * @param string $sNombreCarpeta El nombre de la carpeta de primer nivel. Para niveles más iternos usar
     *                             carpeta.DS.subcarpeta.DS.subcarpeta .. 
     * @param string $sNombreArchivo El nombre del archivo si es .php no se debe incluir la extension
     * @param int $hasExtension   Indica si $sNombreArchivo lleva una extension distinta a .php pasar 1
     * @param int $bDuplicar  Por defecto se importa una vez, si se desea reimportar más veces utilizar 1
     */
    public static function IMPORT($sNombreCarpeta="",$sNombreArchivo="", $hasExtension=0, $bDuplicar=0)
    {
        if(!empty($sNombreArchivo))
        {
            $rCarpeta = TFW_PATH_APPROOTDS.$sNombreCarpeta;
            $rArchivo = $rCarpeta.DS.$sNombreArchivo;
            if(!$hasExtension)
            {
                $rArchivo .= ".php";
            }
            //var_dump($rArchivo);
            if(file_exists($rArchivo))
            {
                if(!$bDuplicar)
                {                    
                    $arIncluded = get_included_files();
                    
                    if(!in_array($rArchivo, $arIncluded))
                    {
                        //bug($rArchivo);
                        include($rArchivo);
                        //bug($arIncluded);
                    }
                }
                else
                {
                    include($rArchivo);
                }
            }
            else
            {
                $sEstilo = "background:red; border:1px solid black; color:white; font-family: Courier, 'Courier New', monospace";
                $sMensaje = "<b>Error:</b> <b>$sNombreArchivo</b> no existe en la ruta <b>$rCarpeta </b>"; 
                echo "<br><span style=\"$sEstilo\">$sMensaje</span>";
            }

        }
    }

    public static function html_tag_js_script($sNombreArchivo, $rSubcarpeta="")
    {
        $sCarpetaJs = "html_js";
        $sNombreArchivo .=".js";
        if(!empty($rSubcarpeta))
        {
            $rSubcarpeta .= DS;
        }
        $rHtml_js = TFW_PATH_HTTPWS.$sCarpetaJs.DS.$rSubcarpeta.$sNombreArchivo;
        $sScriptTag = "<script type=\"text/javascript\" src=\"$rHtml_js\" ></script>\n";
        echo $sScriptTag;
        //self::IMPORT($sCarpetaJs, $sNombreArchivo);
    }

    public static function html_tag_js_script_by_url($sUrl)
    {
        $sScriptTag = "<script type=\"text/javascript\" src=\"$sUrl\" ></script>\n";
        echo $sScriptTag;
    }


    public static function html_tag_js_script_google($sNombreScript)
    {
        $arGoogleUrl["jquery_1.4"] = "http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js";
        $rHtml_js = "";
        foreach($arGoogleUrl as $sIndice=>$sUrl)
        {
            if($sIndice==$sNombreScript)
            {
                $rHtml_js = $sUrl;
            }
        }
        
        $sScriptTag = "<script type=\"text/javascript\" src=\"$rHtml_js\" ></script>\n";
        echo $sScriptTag;
        //self::IMPORT($sCarpetaJs, $sNombreArchivo);
    }
    
    public static function html_tag_css_link($sNombreArchivo)
    {
        $sCarpetaJs = "html_css";
        $sNombreArchivo .=".css";
        $rHtml_css = TFW_PATH_HTTPWS.$sCarpetaJs.DS.$sNombreArchivo;
        $sLinkTag = "<link rel=\"stylesheet\" media=\"screen\" href=\"$rHtml_css\" />\n";
        echo $sLinkTag;
        //self::IMPORT($sCarpetaJs, $sNombreArchivo);
    }
    
    public static function html_use_body($sNombreArchivo,$isMessage=1,$sMessage="")
    {
        $sCarpetaBodies = FOL_HTML_SINGLE_FILES.DS."test_bodies";
        if($isMessage)
        {
            $sDivMessage = "<div id=\"divAnyFileName\">$sMessage</div>";
            echo $sDivMessage;
        }
        self::IMPORT($sCarpetaBodies, $sNombreArchivo);
    }
    
    public static function html_use_whole_page($sNombreArchivo)
    {
        $sCarpetaPages = FOL_HTML_WHOLE_FILES.DS."test_pages";
        self::IMPORT($sCarpetaPages, $sNombreArchivo);
    } 
    
    public static function IMPORT_VENDOR($rCarpeta,$sNombreArchivo)
    {
        $hasExtension = 0;
        $bDuplicar = 0;
        $rCarpeta = FOL_MIX_VENDORS.DS.$rCarpeta;
        self::IMPORT($rCarpeta, $sNombreArchivo, $hasExtension, $bDuplicar);
        
    }
}
