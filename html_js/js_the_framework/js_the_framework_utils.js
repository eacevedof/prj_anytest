/**
 * @Author: Eduardo Acevedo Farje.
 * @Url: eduardoaf.com
 * @File: js_the_framework_utils.js  
 * @Version: 1.0.0;
 */
var TfwUtil =
{
    get_trimmed : function(sText)
    {
        var oCore = TfwCore;

        if(oCore.is_string(sText))
        {
            var sPatern = /^\s*|\s*$/g;
            var sTrimmed = sText.replace(sPatern,"");
            return sTrimmed;
        }
        console.log("Error 15: "+ sText.type +" is not a string");
        return "";

    }
}//Fin TfwUtil
