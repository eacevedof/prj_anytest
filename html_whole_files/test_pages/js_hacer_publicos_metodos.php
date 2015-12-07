<!DOCTYPE html>
<html lang="es">
<head>
    <title>Prueba Encapsulacion abierta de metodos privados</title>
    <meta charset="utf-8" />
    <script type="text/javascript">
    var bug = function(value,title)
    {
        if(window.console != undefined)
        {    
            if(title!=null) console.debug(title);
            console.debug(value);
        }
    };
    //BridgeDBPlugin.Login()
    var BridgeDBPlugin = function()
    {
            /* privates attributes */
            var dbname="name";

            /* publics attributes */
            var attrpublic="val attr";

            /* private */
            var privfunc = function(val)
            {
                    attrpublic = val;
                    cordova.exec(null, null, "BridgeDBPlugin", "init", null);
            }


            /* public */
            var init = function()
            {
                    console.log("[BridgeDBPluginModule][init] Inicio");
                    cordova.exec(null, function(err)
                    {
                            callback('Nothing to echo.');
                    }, "BridgeDBPlugin", "init", [dbname]);
                    console.log("[BridgeDBPluginModule][init] Fin");
            }


            var login = function()
            {
                    console.log("[BridgeDBPluginModule][login] Inicio");
                    console.log("[BridgeDBPluginModule][login] Fin");
                    return "login";
            }


            /* publications */
            //return
            //objeto anonimo y estatico
            return {
                attrPublic: attrpublic,
                Init: init,
                Login: login
            };
            //return x;

    };

    var oBridge = new BridgeDBPlugin();
    bug(oBridge,"bridge");
    bug(oBridge.Login(),"login");
    </script>
</head>
<body>

</body>
</html>