 <script type="text/javascript">
//window.onload = al_cargar();
//window.document.readyState == 4

/*console.debug(document);
var a = document.addEventListener;
console.debug(document.addEventListener);
if (document.addEventListener)
{
    //http://www.desarrolloweb.com/articulos/saber-cuando-dom-esta-listo-sin-utilizar-onload.html
    //http://www.whatwg.org/specs/web-apps/current-work/#dom-document-readystate
    //loading, interactive y complete
    console.log(window.document.readyState);
    document.addEventListener("DOMContentLoaded", al_cargar, false);
}*/

//http://api.jquery.com/jQuery.post/
function pr_div(sTexto)
{
    var eDiv = document.getElementById("divMensaje");
    eDiv.innerHTML = sTexto;
}

function div_alert(eDiv)
{
    console.debug(eDiv.innerHTML);
}

//Importo mi clase
var oSystem = Tfw.CSystem;
var oInputs = Tfw.CInputs;
var oUtils = Tfw.CUtils;
var oPrime = Tfw.CPrime;

oPrime.document_ready(al_cargar);


function al_cargar()
{
   // oInputs.chkboxes_check("frmTest");

/*
    console.log(oInputs.get_text_value_by_id('txtTest'));
    console.log("tipo null: " + oSystem.get_type(null));//Es object
    console.log("tipo int 0: " + oSystem.get_type(0));//Es int
    console.log("tipo '0': " + oSystem.get_type('0'));//Es string
    console.log("tipo '': " + oSystem.get_type(''));//Es string
    console.log("tipo : " + oSystem.get_type());//Es string
    console.log("tipo true: " + oSystem.get_type(true));//Es string
    console.log("tipo false: " + oSystem.get_type(false));//Es string
    console.log("tipo oSystem: " + oSystem.get_type(oSystem));//Es string
    console.log(oSystem.get_type_by_id('txtmmmuu'));
    //console.log(oSystem.get_type_by_id(null));
*/
    var oCheckBox = oInputs.get_checkbox_by_id("chk_main");

        function select_unselect()
        {
            var iValor = oInputs.is_checkbox_checked(oCheckBox);
             oInputs.chkboxes_check("frmTest",iValor);
        }
        
    oSystem.set_event(oCheckBox,"click",select_unselect);

}
</script>
    <!-- DIVCONTENIDO -->
    <div id="divContenido">
        <!-- HEADER -->
        <header id="headPrincipal" class="clsHeadPrincipal" >
            <hgroup>
                <h1>EL H1 del header </h1>
                <h2>El H2 del header</h2>
            </hgroup>
            <nav>
                NAVIGATION
            </nav>
        </header>
        <!--/HEADER-->

        <!-- secContenido -->
        <section id="secContenido" >

            <form id="frmTest" method="post" action="" onsubmit="">
                <div id="divMensaje" style="border:1px solid red; color:blue;">-</div>
                <input type="text" id="txtTest" value=" hola you!" name="txtTest" />

                <input type="checkbox" class="" value="120" id="chk_main">
                <input type="checkbox" class="" value="120" name="chk_id[]" id="chk_id_01">
                <input type="checkbox" class="" value="231" name="chk_id[]" id="chk_id_02">
                <input type="checkbox" class="" value="21" name="chk_id[]" id="chk_id_03">
                <input type="checkbox" class="" value="356" name="chk_id[]" id="chk_id_04">

                <input type="button" id="botTest" value="test" onclick="al_cargar();" />

            </form>

            <!--asdColumnaDerecha-->
            <aside id="asdColumnaDerecha" style="border:2px solid blue; width: 200px; float:right;">
                <nav>
                    <h1>Columna Derecha</h1>
                    <ul>
                        <li>
                            <a target="_blank" href="">Minimal setup</a>
                        </li>
                    </ul>
                </nav>
            </aside>
            <!--/asdColumnaDerecha -->

        </section>
        <!--/secContenido -->

        <footer style="border:2px solid green; height: 150px; width: 400px;">
            <a href="http://www.the-framework.eduardoaf.com">
            Powered by "The framework"
            </a>

            Creado por
            <a href="http://www.eduardoaf.com">
                <img width="100" alt="Blog de Eduardo Acevedo Farje" src="http://www.eduardoaf.com/wp-content/uploads/img_articulos/logo_eduardoaf_com.png">
            </a>
        </footer>
    </div>
    <!--/DIVCONTENIDO -->
