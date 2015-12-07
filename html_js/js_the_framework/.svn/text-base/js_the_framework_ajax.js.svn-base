var TfwAjax =
{
    //CONSTANTES CON LOS ESTADOS
    READYSTATE_UNINTIALIZED : 0,
    READYSTATE_LOADING : 1,
    READYSTATE_LOADED : 2,
    READYSTATE_INTERACTIVE : 3,
    READYSTATE_COMPLETE : 4,

    //Esta funcion devuelve el objeto creado si no ha habido problemas en su intento
    //sino devuelve un booleano false
    get_object_xmlhttprequest : function()
    {
        var oXmlRequest = false;
        //Si el navegador soporta XMLHttpRequest entonces es un navegador estandar
        if(window.XMLHttpRequest)
        {
            oXmlRequest = new XMLHttpRequest();
        }
        else if(window.ActiveXObject)//sino comprobamos que sea IE
        {
            //Como MICROSOFT maneja dos ActiveX para trabajar con TfwAjax, pruebo los 2
            try
            {
                oXmlRequest = new ActiveXObject("Microsoft.XMLHTTP");
            }
            catch (sExepcion)
            {
                alert("Excepcion: "+sExepcion);
                oXmlRequest = new ActiveXObject("Msxml2.XMLHTTP");
            }

        }
        return oXmlRequest;
    },
   
    send_input_by_post : function (sUrlDestino, arInput)
    {
        
        var eDivMensaje = document.getElementById('divMensaje');
        var oXmlRequest = TfwAjax.get_object_xmlhttprequest();
        
        if(oXmlRequest)
        {
            var oJson = TfwAjax.get_input_in_json(arInput);
            var sParametros = TfwAjax.get_json_in_url(oJson);
            
            oXmlRequest.open("POST", sUrlDestino,true);
            oXmlRequest.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            oXmlRequest.setRequestHeader("Content-length", sParametros.length);
            oXmlRequest.setRequestHeader("Connection", "close");

            oXmlRequest.onreadystatechange = function()
            {
                if(oXmlRequest.readyState == TfwAjax.READYSTATE_COMPLETE)
                {
                    eDivMensaje.innerHTML = oXmlRequest.responseText;
                }
            }
            
            oXmlRequest.send(sParametros);
            console.debug(oXmlRequest);
        }
        else
        {
            alert("no se pudo crear el objeto XMLHTTPRequest");
        }
    },
    

    
    /*
     * For check, select (and radio ) controls
     **/
    get_multi_input_in_json: function(sInputId)
    {
        var oCore = TfwCore;
        var arSelectedValues = [];
        var oJson = null;
        
        var eMultiInput = document.getElementById(sInputId);
        if(oCore.is_checkbox(eMultiInput))
        {
            //console.debug(eMultiInput);
        }
        else if(oCore.is_select_multiple(eMultiInput))
        {
            arSelectedValues = TfwControl.get_selected_options_values(eMultiInput);
            oJson = {};
            oJson[sInputId] = arSelectedValues;
        }
        //console.debug(oJson);
        return oJson;
    },
    
    get_json_in_url: function(oJson)
    {
        var sUrl = '';
        for(var sPropiedad in oJson)
        {
            sUrl += sPropiedad+'='+oJson[sPropiedad];
            sUrl += '&';
        }
        return sUrl;
    },
    
    get_json_array_in_url: function(oJson)
    {
        var sUrl = '';
        for(var sPropiedad in oJson)
        {
            var arValores = oJson[sPropiedad];
            for(var i in arValores)
            {
                sUrl += sPropiedad+'[]='+arValores[i];
                sUrl += '&';
            }
        }
        return sUrl;
    }
}