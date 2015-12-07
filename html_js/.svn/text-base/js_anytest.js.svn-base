function pr(oAnyObject)
{
    //ARCHIVO: lineas_pedido.js
    //var sVersionNavegador = navigator.appVersion;
    var sNombreNavegador = navigator.appName;
    var sAgenteNavegador = navigator.userAgent;
   
    //Navegador es de la familia netscape
    if(sNombreNavegador=="Netscape")
    {
        if(sAgenteNavegador.indexOf("Opera")!=-1)
        {
            //opera.postError(oAnyObject);
        }
        else if(sAgenteNavegador.indexOf("Chrome")!=-1)
        {
            console.debug(oAnyObject);
        }
        else if(sAgenteNavegador.indexOf("Safari")!=-1) 
        {
            console.debug(oAnyObject);
        }
        else if(sAgenteNavegador.indexOf("Firefox")!=-1) 
        {
            if ((window.console.firebug !== undefined) && (window.console.firebug!==null))
            {
                console.debug(oAnyObject);
            }
        }        
    }
    //Por ejemplo internet explorer
    else
    {}
    //pr_div(oAnyObject);
}
function pr_div(sMensaje)
{
    var eDiv;
    eDiv = document.getElementById("divMensaje");
    eDiv.innerHTML = "";
    eDiv.innerHTML = sMensaje;
}

function get_element_by_name(sNombreElemento)
{
    var oElement;
    oElement = document.getElementsByName(sNombreElemento);
    oElement = oElement[0];
    return oElement;
}

function get_value_selected_option(sNombreSelect)
{
    var eSelect = get_element_by_name(sNombreSelect);
    var iNumOpciones = eSelect.length;
    
    for (var i=0; i<iNumOpciones; i++) 
    {
        if(eSelect[i].selected == true) 
        {
            return eSelect[i].value;
        }   
    }    
    return null;
}

function set_select_option_value(sNombreSelect,sValue)
{
    var eSelect = get_element_by_name(sNombreSelect);
    var iNumOpciones = eSelect.length;
    
    for (var i=0; i<iNumOpciones; i++) 
    {
        if (eSelect[i].value == sValue) 
        {
            eSelect[i].selected = true;
        }   
    }
}

function set_visibilidad(sIdElemento,isVisible)
{
    var oElement = document.getElementById(sIdElemento);
    if(isVisible!=null && isVisible!=0)
    {
        oElement.style.visibility="visible";
    }
    else
    {
        oElement.style.visibility="hidden";
    }
}

function set_class(sNombreElemento,sNombreClase)
{
    //archivo: visita_mostrar_select.js
    //sNombreClase: input o inputRO
    var oElement = get_element_by_name(sNombreElemento);
    oElement.setAttribute('class', sNombreClase);
}

function set_readonly_text(sNombreText, isReadOnly)
{
    //archivo: visita_mostrar_select.js
    var eText = get_element_by_name(sNombreText);
    if(isReadOnly!=null && isReadOnly!=false && isReadOnly!=0)
    {
        eText.readOnly=true;
    }
    //isReadOnly =0
    else
    {
        eText.readOnly=false;
    }
}

function set_disabled_select(sNombreSelect, isDisabled)
{
    //archivo: visita_mostrar_select.js
    var eSelect = get_element_by_name(sNombreSelect);
    if(isDisabled!=null && isDisabled!=false && isDisabled!=0)
    {
        eSelect.disabled=true;
    }
    //disabled=0
    else
    {
        eSelect.disabled=false;
    }
}

function dom_ready()
{
    var oCheckBox = oInputs.get_checkbox_by_id("chk_main");

    function check_uncheck_all()
    {
        var iValor = oInputs.is_checkbox_checked(oCheckBox);
        //alert(iValor);
        oInputs.chkboxes_check("frmTest",iValor);
    }

    function enviar_form()
    {
        oForm = oSystem.get_element_by_id("frmTestooo");
        if(! oSystem.is_null(oForm))
        {
            oForm.submit();
        }
        
        
    }
    oBoton = oSystem.get_element_by_id("botTest");
    
    oSystem.set_event(oCheckBox,"click", check_uncheck_all);
    oSystem.set_event(oBoton,"click",enviar_form);
}