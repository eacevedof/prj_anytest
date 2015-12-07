/**
 * @Author: Eduardo Acevedo Farje.
 * @Url: eduardoaf.com
 * @File: js_the_framework_document.js  
 * @Version: 1.0.0;
 * 
 * DEPENDENCIES: js_the_framework_core.js
 */
var TfwDocument =
{
    oCore : TfwCore,
    
    on_dom_content_loaded: function(oFunction, doBubble)
    {
        var oCore = TfwCore;
        var isBubbling = false;
        if(doBubble != null)
        {
            isBubbling = doBubble;
        }
        //set_event check if function is null before adding it
        this.oCore.set_event(document,"DOMContentLoaded",oFunction, isBubbling);
    } 
}