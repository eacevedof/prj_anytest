<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="google-site-verification" content="" />
    <title>ORDEN DE EVENTOS EN INPUT-TEXT</title>
    <meta name="description" content="" />
    <meta name="robots" content="index, nofollow" />

    <link type="image/x-icon" href="images/favicon.ico"  rel="icon" />
    <link rel="stylesheet" media="screen" href="css/test_2.css" />
    <script type="text/javascript">

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
                           onload="console.debug('onload'); alert('onload');"
                           onblur="console.debug('onblur'); //alert('onblur');"
                           onchange="console.debug('onchange'); alert('onchange');"
                           onfocus="console.debug('onfocus'); //alert('onfocus');"
                           onkeydown="console.debug('onkeydown'); alert('onkeydown');"
                           onkeypress="console.debug('onkeypress'); alert('onkeypress');"
                           onkeyup="console.debug('onkeyup'); alert('onkeyup');"
                           onselect="console.debug('onselect'); alert('onselect');"
                           onunload="console.debug('onunload'); alert('onunload');"
                            
                    />     
                  <!--
                  <input type="text" id="txtTest" value=" hola you!" name="txtTest" 
                           onload="console.debug('onload');"
                           onblur="console.debug('onblur');"
                           onchange="console.debug('onchange');"
                           onclick="console.debug('onclick');"
                           ondblclick="console.debug('ondblclick');"
                           onfocus="console.debug('onfocus');"
                           onkeydown="console.debug('onkeydown');"
                           onkeypress="console.debug('onkeypress');"
                           onkeyup="console.debug('onkeyup');"
                           onmousedown ="console.debug('onmousedown');"
                           onmousemove ="console.debug('onmousemove');"
                           onmouseout="console.debug('onmouseout');"
                           onmouseover="console.debug('onmouseover');"
                           onmouseup="console.debug('onmouseup');"
                           
                    />
                  -->
                  <!--
                    <input type="text" id="txtTest" value=" hola you!" name="txtTest" 
                           onafterupdate="console.debug('afterupdate');"
                           onbeforeupdate="console.debug('beforeupdate');"
                           onerrorupdate="console.debug('errorupdate');" 
                           onblur="console.debug('onblur');"
                           onchange="console.debug('onchange');"
                           onclick="console.debug('onclick');"
                           ondblclick="console.debug('ondblclick');"
                           ondrag="console.debug('ondrag');"
                           ondragend="console.debug('ondragend');"
                           ondragenter="console.debug('ondragenter');"
                           ondragstart="console.debug('ondragstart');"
                           ondrop="console.debug('ondrop');"
                           onfilterchange="console.debug('filterchange');"
                           onfocus="console.debug('onfocus');"
                           onhelp="console.debug('onhelp');"
                           onkeydown="console.debug('onkeydown');"
                           onkeypress="console.debug('onkeypress');"
                           onkeyup="console.debug('onkeyup');"
                           onlosecapture="console.debug('onlosecapture');"
                           onmousedown ="console.debug('onmousedown');"
                           onmousemove ="console.debug('onmousemove');"
                           onmouseout="console.debug('onmouseout');"
                           onmouseover="console.debug('onmouseover');"
                           onmouseup="console.debug('onmouseup');"
                           onpropertychange="console.debug('onpropertychange');"
                           onresize="console.debug('onresize');"
                           onselectstart="console.debug('onselectstart');"
                           
                    />
                  -->

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
