<?php

class CSearch //extends MainComponent
{
    private $_arTablaCampos;
    private $_arListaTemporal;
    private $_arListaResultados;


    public function __construct($arTablaCampos=array())
    {
        $this->_arTablaCampos = $arTablaCampos;
        $this->_arListaResultados = array();
        $this->_arListaTemporal = array();
        $this->buscar();
    }
    
    private function buscar()
    {
        
        $arTablas = array
                     (  
                        "nombreTabla1"=>array
                        (
                            "camposBuscar"=>array("id","campo1","campo2","campo3"),
                            "camposIds"=>array("id","id2","id3"),
                            "modelo"=>"modelo1",
                            "ruta"=>"ruta1"
                        ),
                        "nombreTabla2"=>array
                        (
                            "camposBuscar"=>array("id","campo1","campo2","campo3"),
                            "camposIds"=>array("id","id2","id3"),
                            "modelo"=>"modelo2",
                            "ruta"=>"ruta2"
                        )            
                     );
        
        
        
        
        
        
        //$arEmul["tabla"]=array("campo1","campo2","campo3");
        
        foreach($arTablas as $arTabla )
        {
            foreach($arTabla as $sConfiguracion=>$arLista)
            {
                print_r("key:".$sConfiguracion);
                echo "<br>";
                //print_r($arCampos);
                foreach($arLista as $i=>$sNombreCampo)
                {
                    echo $sNombreCampo; echo "<br>";
                    
                    $sSELECT = "SELECT ";
                    $sFROM = "FROM ";
                    $sWHERE = "WHERE ";
                    
                    //$sSQL = "SELECT $id FROM $sNombreTabla "
                }
                echo "<br>";
            }
        }
    }
    
    
    public function buscar_ids()
    {
        
    }
    
    
}

?>