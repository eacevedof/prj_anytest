/**
 * @Author: Eduardo Acevedo Farje.
 * @Url: eduardoaf.com
 * @File: js_the_framework_core_function.js  
 * @Version: 1.0.0;
 * DEPENDENCIES: js_framework_core.js
 */
var TfwFunction =
{
//IMPORT
//http://www.daniweb.com/web-development/javascript-dhtml-ajax/threads/78817
    empty : function(oAnyObject)
    {
        var isEmpty = false;
        
        isEmpty = 
        (
            oAnyObject==null || oAnyObject==undefined ||
            oAnyObject===null || oAnyObject===undefined ||   
            oAnyObject==false || oAnyObject=='undefined' ||
            oAnyObject===false || oAnyObject==='undefined' ||
            oAnyObject==0 || oAnyObject=='0' || oAnyObject=='' ||
            oAnyObject===0 || oAnyObject==='0' || oAnyObject===''
        );
        return isEmpty;
    },
    
    count: function(oArray)
    {
        return oArray.length;
    }
}
//==============================  END TfwFunction =================================
