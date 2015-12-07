<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="google-site-verification" content="" />
    <title>PRUEBA</title>
    <meta name="description" content="" />
    <meta name="robots" content="index, nofollow" />

    <link type="image/x-icon" href="images/favicon.ico"  rel="icon" />
    <link rel="stylesheet" media="screen" href="css/test_2.css" />
    <script type="text/javascript">

//Tipo object
var oNulo = null;
//Tipo undefined
var uNoDefinido = undefined;
//Tipo undefined
var uNoAsignado;
//Tipo boolean
var isBoolean = true;
//Tipos Number
var iNumber = 28;
var fNumber = 28.895;
//Tipos String
var sNumber = '28';
var sCadena = 'esto es una cadena de texto';
//Tipo function
var oFunction = function mi_funcion(){ };

//Tipo Object
var arArray1 = new Array();
arArray1 = ['arArray1 creado con new Array()',1,1.5];

//Tipo Object Equivalente a new Array();
var arArray2 = [];
arArray2[0] = 'arArray2 creado con []';
arArray2[1] = 2;
arArray2[2] = 2.5;

/*
Array no válido, devuelve un objeto vacio "[]" porque entiende que se esta
creando propiedades y no indices. Seria algo como 
class CObject
{
    
}

class CArray extends CObject
{
    
}
    
$oArray = new CArray();
*/
var arArray3 = new Array();
arArray3['a'] = 'arArray3 creado con new Array() pero con indices tipo string';
arArray3['b'] = 2;

//Tipo Object. Creado con constructor.
var oAnObject1 = new Object();
oAnObject1['info'] = 'objeto creado con new Object() oInstancia[propiedad]';
oAnObject1['prop_1'] = 'item1';
oAnObject1['prop_2'] = 1;
oAnObject1['prop_3'] = 1.5;

/*Tipo Object. Instancia de Object. Creado sin constructor. 
 *Notación JSON. Equivalente al anterior
 *Se crea propiedades con: oInstancia.propiedad
 */
var oAnObject2 = {};
oAnObject2.info = 'objeto creado con {} oInstancia.propiedad';
oAnObject2.prop_1 = 'item2';
oAnObject2.prop_2 = 2;
oAnObject2.prop_3 = 2.5;


/*Tipo Object. Instancia de Object. Creado sin constructor. 
 *Notación JSON. Equivalente al anterior
 *Se crea propiedades con: oInstancia['propiedad']
 */
var oAnObject3 = {};
oAnObject3['info'] = 'objeto creado con {} oInstancia.[propiedad]';
oAnObject3['prop_1'] = 'item2';
oAnObject3['prop_2'] = 2;
oAnObject3['prop_3'] = 2.5;

/*Tipo Object. Instancia de Object. Creado sin constructor.
 *Notación JSON. Esta forma hace 2 pasos en uno. 
 *Emula la construccion con new y la creacion con oInstancia.propiedad = valor ó
 *oInstancia['propiedad'] = valor
 */
var oAnObject4 =
{
    info: 'objeto sin constructor. creado con notacion JSON',
    prop_1: 'item3',
    prop_2: 3,
    prop_3: 3.5
};

/*
 *Añadiendo propiedades con prototype. Esto es una operación inválida.
  Siguiendo con el php anterior, se podria añadir una propiedad al vuelo:
  
  $oArray->nueva_propiedad = "esto es una propiedad";
  
  Intentando aplicar lo mismo en javascript genera ERROR:
  oAnObject4.prototype is undefined
  
  Si sabes por que, explicamelo :)
 */        
/*
var oAnObject5 = {}; 
oAnObject5.prototype.info = 'objeto intentando crear propiedad al vuelo con prototype';
oAnObject5.prototype.prop_4 = 'item3';
oAnObject5.prototype.prop_5 = 22;
oAnObject5.prototype.prop_6 = 33.5;
*/

/*
 *Intentando una operación absurda. Pero por probar que no quede.
 *No se puede construir desde una instancia 
 *ERROR: oAnObject1 is not a constructor
 *
var oAnObject6 = new oAnObject1(); 
oAnObject6.prototype.info2 = 'objeto creado con new oAnObject2() intentando extenderlo con prototype';
oAnObject6.prototype.prop_4 = 'item3';
oAnObject6.prototype.prop_5 = 22;
oAnObject.prototype.prop_6 = 33.5;
*/

//Tipo Object.
var dFecha = new Date();

/*Tipo function.
 *Al crear la clase de este modo crea una recursividad infinita. 
 *Crea una propiedad constructor que cuenta con las propiedades originales más un constructor nuevo
 *esto se repite de forma infinita. No sé por que.
 *Se crea la propiedad __proto__
 */
var Clase1 = function(){}; //
Clase1.prototype.info1 = 'Clase1 definida con function(){}. propiedades con prototype';
Clase1.prototype.prop_4 = 'item3';
Clase1.prototype.prop_5 = 22;
Clase1.prototype.prop_6 = 33.5;

/**
 *Tipo function.
 *Si previamente he añadido una propiedad con prototype esto escribiendo sobre 
 *la clase principal object.info1
 *por lo tanto las instancias de Clase2 ya contarian con esta propiedad y 
 *cuyo valor por defecto seria 'Clase1 def..'
 *en el momento de la construcción. Despues estaría sobrescribiendo
 */
var Clase2 = function()
{
    this.info1 = 'Clase2 definida con function(){}. propiedades con this.';
    this.prop_4 = 'item5';
    this.prop_5 = 222;
    this.prop_6 = 333.55;
}

/**
 *Tipo function.
 *Las clases Clase3 y Clase3G son iguales. Solo difieren en los ambitos
 *Si todo este codigo lo estariamos creando dentro de un espacio de nombre
 *no podriamos instanciar Clase3 de la forma:
 *
 *  var oC3 = new MiEspacio.Clase3(); //Genera error de ambito
 *
 *mientras que con la Clase3G si se podría porque es de ambito global.
 *
 *  var oC3 = new MiEspacio.Clase3G(); 
 *
 */
var Clase3 = function(param1, param2, oInsClase2)
{
    this.prop1 = param1;
    this.prop2 = param2;
    this.oObject2 = oInsClase2;
}

function Clase3G(param1, param2, oInsClase2)
{
    this.prop1 = param1;
    this.prop2 = param2;
    this.oObject2 = oInsClase2;
}

/*Herencia de clases.
 *En js la herencia se hace en dos pasos. 
 *Primero se define la clase
 *y despues se extiende con prototype
 *
 *En php seria:
 *  class Clase4
 *  {
 * 
 *  }
 */
var Clase4 = function()
{};

/*En php:
 *  class Clase4 extends Clase2
 *  {
 * 
 *  }
 */
Clase4.prototype = new Clase2();
Clase4.info1 = 'Clase4 hereda de Clase2';

var oClase1 = new Clase1();
var oClase2 = new Clase2();
/**
 *Para los objetos oClase3 y oClase3B:
 *El código en php:
 *  class Clase3
 *  {
 *      public $prop1;
 *      public $prop2;
 *      public $oObject2;
 *      
 *      public __construct($param1, $param2, $oInsClase2)
 *      {
 *          $this->prop1 = $param1;
 *          $this->prop2 = $param2;
 *          $this->oObject2 = $oInsClase2;
 *      }
 *  }
 *
 */
var oClase3 = new Clase3('item_1',222, oClase2);
var oClase3G = new Clase3G('item_1',222, oClase2);
//oClase4 es "instanceof" de Clase2 y Clase3
var oClase4 = new Clase4();





function trace_it
(
    oNulo,
    uNoDefinido,
    uNoAsignado,
    isBoolean,
    iNumber,
    fNumber,
    sNumber,
    sCadena,
    oFunction,
    arArray1,
    arArray2,
    arArray3,
    oAnObject1,
    oAnObject2,
    oAnObject3,
    oAnObject4,
    dFecha,
    Clase1,
    Clase2,
    Clase3,
    Clase3G,
    Clase4,
    oClase1,
    oClase2,
    oClase3,
    oClase3G,
    oClase4
)
{
    console.debug(arguments);
    for(key in arguments)
    {
        console.debug(arguments[key]);
        console.log('es de tipo: ' + typeof arguments[key]);
    }
}

//Ejecuto la función
trace_it
(
    oNulo,
    uNoDefinido,
    uNoAsignado,
    isBoolean,
    iNumber,
    fNumber,
    sNumber,
    sCadena,
    oFunction,
    arArray1,
    arArray2,
    arArray3,
    oAnObject1,
    oAnObject2,
    oAnObject3,
    oAnObject4,
    dFecha,
    Clase1,
    Clase2,
    Clase3,
    Clase3G,
    Clase4,
    oClase1,
    oClase2,
    oClase3,
    oClase3G,
    oClase4
);
    </script>

</head>
<body>
    <div id="divFondo"></div>
    <!-- DIVCONTENIDO -->
    <div id="divContenido">
        <div id="divPublicidad" >publicidad</div>
        <!-- HEADER -->
        <header id="headPrincipal" class="" >
            <hgroup>
                <h1>The Framework</h1>
                <h2>...el framework MVC más rápido y ligero!!</h2>
            </hgroup>
        </header>
        <!--/HEADER-->
        <nav id="navMenuPrincipal" >
            <ul id="ulMenuPrincipal" >
                <li>
                    <a href="#">opcion</a>
                </li>
                <li>
                    <a href="#">opcion 2</a>
                </li>
                <li>
                    <a href="#">opcion 3</a>
                </li>
                <li>
                    <a href="#">opcion 4</a>
                </li>
                <li>
                    <a href="#">opcion 5</a>
                </li>                
            </ul>
        </nav>
        
        <!--asdColumnaIzquierda-->
        <aside id="asdColumnaIzquierda" >
            <nav>
                <h1>Functions</h1>
                <ul>
                    <li>
                        <a target="_blank" href="">sqlCustom</a>
                    </li>
                    <li>
                        <a target="_blank" href="">alert</a>
                    </li>
                    <li>
                        <a target="_blank" href="">getFromSQL</a>
                    </li>                    
                </ul>
            </nav>
            
            <nav>
                <h1>Properties</h1>
                <ul>
                    <li>
                        <a target="_blank" href="">markable</a>
                    </li>
                    <li>
                        <a target="_blank" href="">editable</a>
                    </li>
                    <li>
                        <a target="_blank" href="">creatable</a>
                    </li>                    
                </ul>
            </nav>
        </aside>
        <!--/asdColumnaIzquierda -->
        
        <article id="artPrincipal" class="">
            <hgroup>
                <h1>Esto es "The Framework" - Tfw</h1>
                <h2>La más liviana plataforma de desarrollo en PHP!</h2>
            </hgroup>
            <p>
                "The Framework" es como su nombre lo indica una plataforma de funciones estructuradas
                basadas en el patrón MVC.
            </p>
            
            <!-- secContenido -->
            <section id="secFormularioBusqueda" >
                <h1>Buscar en "The Framework"</h1>
                <p>
                    Busca lo que desees desde aquí.
                </p>
                <form id="frmTest" method="post" action="<? echo $_SERVER["PHP_SELF"]; ?>" onsubmit="">
                    <div id="divMensaje" >-</div>
                    <input type="text" id="txtTest" value=" hola you!" name="txtTest" 
                           onblur="
                               trace_it
                               (
                                    oNulo,
                                    uNoDefinido,
                                    uNoAsignado,
                                    isBoolean,
                                    iNumber,
                                    fNumber,
                                    sNumber,
                                    sCadena,
                                    oFunction,
                                    arArray1,
                                    arArray2,
                                    arArray3,
                                    oAnObject1,
                                    oAnObject2,
                                    oAnObject3,
                                    oAnObject4,
                                    dFecha,
                                    Clase1,
                                    Clase2,
                                    Clase3,
                                    Clase3G,
                                    Clase4,
                                    oClase1,
                                    oClase2,
                                    oClase3,
                                    oClase3G,
                                    oClase4
                                );" />

                    <input type="checkbox" class="" value="120" id="chk_main" >
                    <input type="checkbox" class="" value="120" name="chk_id[]" id="chk_id_01">
                    <input type="checkbox" class="" value="231" name="chk_id[]" id="chk_id_02">
                    <input type="checkbox" class="" value="21" name="chk_id[]" id="chk_id_03">
                    <input type="checkbox" class="" value="356" name="chk_id[]" id="chk_id_04">

                    <input type="button" id="botTestA" value="test" onclick="" class="clsBoton clsBotonAzul"/>
                    <input type="button" id="botTestV" value="test" onclick="" class="clsBoton clsBotonVerde" />
                </form>
                
            </section>
            
            <section id="secArticuloDestacado" >
                <header>
                    <h1>el titulo de una seccion</h1>
                </header>
                <p>
                        Al contrario del pensamiento popular, el texto de Lorem Ipsum no es simplemente texto aleatorio.
                        Tiene sus raices en una pieza cl´sica de la literatura del Latin, que data del año 45 antes de 
                        Cristo, haciendo que este adquiera mas de 2000 años de antiguedad. Richard McClintock, un profesor
                        de Latin de la Universidad de Hampden-Sydney en Virginia, encontró una de las palabras más oscuras 
                        de la lengua del latín, "consecteur", en un pasaje de Lorem Ipsum, y al seguir leyendo distintos 
                        textos del latín, descubrió la fuente indudable. Lorem Ipsum viene de las secciones 1.10.32 y 1.10.33 
                        de "de Finnibus Bonorum et Malorum" (Los Extremos del Bien y El Mal) por Cicero, escrito en el año 
                        45 antes de Cristo. Este libro es un tratado de teoría de éticas, muy popular durante el Renacimiento. 
                        La primera linea del Lorem Ipsum, "Lorem ipsum dolor sit amet..", viene de una linea en la sección
                </p>
            </section>
            <hr />
            <section>
                <h2>¿Cómo se interpretan los <strong>eventos</strong> en <strong>javascript</strong>? </h2>
                <p>
            Actualmente estoy trabajando con un CRM hecho en AJAX en su totalidad (Hydra).  
            Llegué a un punto en el que necesitaba saber el orden de ejecución de los eventos sobre un input de tipo text 
            (o textbox).
                    
                </p>

                <h3>La lista de <strong>gestores de eventos</strong> es la siguiente: </h3>
                <ul>
                    <li>onabort</li> 
                    <li>onblur</li>
                    <li>onchange</li>
                    <li>onclick</li>
                    <li>ondblclick</li>
                    <li>onerror</li>
                    <li>onfocus</li>
                    <li>onkeydown</li>
                    <li>onkeypress</li>
                    <li>onkeyup</li>
                    <li>onload</li>
                    <li>onmousedown</li>
                    <li>onmousemove</li>
                    <li>onmouseout</li>
                    <li>onmouseover</li>
                    <li>onmouseup</li>
                    <li>onreset</li>
                    <li>onselect</li>
                    <li>onsubmit</li>
                    <li>onunload</li>
                </ul>
                <p>
                    De la lista anterior se puede deducir el evento asociado al gestor quitando la palabra "on", quedando algo como:
                    abort, blur, change, etc..
                </p>
                <p>
                    Los gestores son funciones a la escucha de la ejecución del evento al que esta asociado.  Es decir, el gestor onkeypress
                    está a la escucha de la ejecución del evento keypress.
                    <br />
                </p>
                <h3>Un ejemplo genérico de cualquier gestor de evento</h3>
                <pre class="brush: js">
                    function on"nombre_evento"([oFuncionEjecutar_1]..[oFuncionEjecutar_n])
                    {
                        var event; //El objeto evento
                    }
                </pre>
                <p>
                    El gestor tiene como argumento opcional una función o lista de funciones a ser llamadas cuando se "dispare" el evento.
                    Cuenta con una variable local <strong>event</strong> que es, valga la redundancia, una instancia del objeto 
                    <strong>event</strong>
                    <br />
                    Este objeto varía en sus propiedades según el gestor.  Por ejemplo, para el gestor <strong>onkeypress</strong> cuenta con
                    las propiedades: <strong>keyCode</strong> y <strong>keyChar</strong>.
                </p>
                <pre class="brush: js">
                    //Siguiendo el ejemplo anterior obtendriamos algo parecido
                    function onkeypress()
                    {
                        var event; ...
                        event = new keypress();
                        //console es la clase de firebug utilizada para depurar
                        //es una especie de alert, con la diferencia que si pasas un objeto te muestra sus propiedades
                        console.debug(event);
                        //Mostrara
                        //event.keyCode 
                        //event.charCode
                    }

                </pre>

                
                <p>
                    
                    Supongamos que deseamos definir una función a ser ejecutada sobre un determinado evento.
                </p>
                <pre class="brush: html"></pre>
                <pre class="brush: js"></pre>
            
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
                
            </section>
            <!--/secContenido -->
        </article>
        
        <!--asdColumnaDerecha-->
        <aside id="asdColumnaDerecha" >
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
        <div style="clear:both;"></div>
        <footer id="footPie" >
            <nav>
                <a href="http://www.the-framework.eduardoaf.com">
                Powered by "The framework"
                </a>

                Creado por
                <a href="http://www.eduardoaf.com">
                    <img width="100" alt="Blog de Eduardo Acevedo Farje" src="http://www.eduardoaf.com/wp-content/uploads/img_articulos/logo_eduardoaf_com.png">
                </a>
            </nav>
        </footer>        
    </div>
    <!--/DIVCONTENIDO -->

</body>

</html>
