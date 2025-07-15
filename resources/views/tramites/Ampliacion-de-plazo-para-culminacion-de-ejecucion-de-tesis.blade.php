<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Pantalla con Paneles</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #E0E0E0; /* Gris claro */
            font-family: 'Segoe UI', sans-serif;
            height: 100vh;
            overflow-y: auto;   /* permite scroll vertical */
            overflow-x: hidden; /* oculta scroll horizontal */
            position: relative;
        }

        .sidebar {
            position: absolute;
            top: 0;
            left: 0;
            width: 320px;
            height: 1080px;
            background-color: #22572D; /* Verde oscuro */
        }

        .topbar {
            position: absolute;
            top: 0;
            left: 320px;
            width: 1600px;
            height: 80px;
            background-color: #FFFFFF;
        }

        .contenido {
            position: absolute;
            top: 80px;
            left: 320px;
            width: calc(100% - 320px);
            height: calc(100% - 80px);
            padding: 40px;
        }

        .tipotramite {
            position: absolute;
            top: 113px;
            left: 353px;
            width: 1535px;
            height: 69px;
            background-color: #FFFFFF;
            border-radius: 8px; /* opcional: esquinas suaves bordeadossssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssss*/
        }

        .descripcion {
            position: absolute;
            top: 214px;
            left: 353px;
            width: 558px;
            height: 250px;
            background-color: #FFFFFF;
            border-radius: 8px; /* opcional para esquinas redondeadas */
        }

        .detalles {
            position: absolute;
            top: 214px;
            left: 946px;
            width: 942px;
            height: 833px;
            background-color: #FFFFFF;
            border-radius: 12px; /* opcional */
            box-shadow: 0 0 8px rgba(0, 0, 0, 0.2); /* opcional: para profundidad */
        }

        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@700&display=swap');

        .texto-mesadepartes {
        position: absolute;
        top: 31px;
        left: 50px;
        width: 205px;
        height: 80px;
        font-family: 'Roboto', sans-serif;
        font-weight: 700; /* Roboto Bold */
        font-size: 28px;
        color: #E5C300; /* Amarillo dorado */
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        }

        .texto-uncp {
        position: absolute;
        top: 111px;
        left: 125px;
        width: 53px;
        height: 40px;
        font-family: 'Roboto', sans-serif;
        font-weight: 400; /* Regular */
        font-size: 20px;
        color: #FFFFFF;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        }

        .rectangulo-menu {
        position: absolute;
        left: 20px;
        top: 161px;
        width: 280px;
        height: 50px;
        background-color: rgba(229, 195, 0, 0.2); /* Amarillo dorado al 20% */
        border-radius: 6px; /* Opcional para suavizar bordes */
        }

        .circulo-blanco,
        .circulo-dorado {
            position: absolute;
            left: 36px;
            width: 24px;
            height: 24px;
            border-radius: 50%;
        }

        .circulo-blanco {
            background-color: #FFFFFF;
        }

        .circulo-dorado {
            background-color: #E5C300;
        }

        .textosistema {
            position: absolute;
            top: 18px;
            left: 446px;
            width: 326px;
            height: 53px;
            font-family: 'Roboto', sans-serif;
            font-weight: 600; /* Semibold */
            font-size: 20px;
            color: #000000;
            display: flex;
            align-items: center;
        }

        .flecha-atras {
            position: absolute;
            top: 22px;
            left: 365px;
            width: 39px;
            height: 36px;
            font-size: 32px;
            font-weight: bold;
            color: #000000;
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: color 0.2s ease;
        }

        .flecha-atras:hover {
            color: #22572D; /* Verde oscuro al pasar el mouse */
        }

        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400&display=swap');

        .texto-panel,
        .texto-nuevo,
        .texto-historial {
            position: absolute;
            font-family: 'Roboto', sans-serif;
            font-weight: 400; /* Regular */
            font-size: 18px;
            height: 40px;
            display: flex;
            align-items: center;
        }

        .texto-panel {
            top: 167px;
            left: 72px;
            width: 80px;
            color: #FFFFFF;
        }

        .texto-nuevo {
            top: 227px;
            left: 72px;
            width: 125px;
            color: #E5C300;
        }

        .texto-historial {
            top: 287px;
            left: 72px;
            width: 166px;
            color: #FFFFFF;
        }

        .linea-dorada {
        position: absolute;
        top: 962px;
        left: 15px;
        width: 290px;
        height: 1px;
        background-color: #E5C300;
        }

        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@100;400;700&display=swap');

        .textodescripcion {
            position: absolute;
            top: 241px;
            left: 364px;
            width: 527px;
            height: 615px;
            font-family: 'Roboto', sans-serif;
            color: #000000;
        }

        .titulo-descripcion {
            font-weight: 700; /* Bold */
            font-size: 20px;
            margin-bottom: 8px;
        }

        .detalle-requisito {
            font-weight: 100; /* ExtraLight */
            font-size: 18px;
            margin-bottom: 10px;
        }

        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@700&display=swap');

        .textotipotramite {
            position: absolute;
            top: 113px;
            left: 353px;
            width: 1535px;
            height: 69px;
            font-family: 'Inter', sans-serif;
            font-weight: 700; /* Bold */
            font-size: 36px;
            color: #E5C300;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
        }

        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@100;700&display=swap');

        .textodetalles {
            position: absolute;
            top: 241px;
            left: 984px;
            width: 736px;
            height: 353px;
            font-family: 'Roboto', sans-serif;
            color: #000000;
        }

        .seccion-titulo {
            font-weight: 700; /* Roboto Bold */
            font-size: 20px;
            margin-bottom: 8px;
        }

        .seccion-item {
            font-weight: 100; /* Roboto ExtraLight */
            font-size: 18px;
            margin-left: 15px;
            margin-bottom: 6px;
        }

        .cuadro-sustento {
        position: absolute;
        top: 580px;
        left: 979px;
        width: 870px;
        height: 150px;
        background-color: #FFFFFF;
        border: 1px solid #000000;
        }

        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@100&display=swap');

        .textarea-sustento {
            position: absolute;
            top: 582px;
            left: 984px;
            width: 843px;
            height: 128px;
            border: none;
            resize: none;
            padding: 10px;
            background-color: transparent;
            font-family: 'Inter', sans-serif;
            font-weight: 100; /* ExtraLight */
            font-size: 16px;
            color: rgba(0, 0, 0, 0.5); /* 50% opacidad inicial */
            overflow-y: auto;
            outline: none;
        }

        /* Al escribir, cambia a 100% de opacidad */
        .textarea-sustento:focus {
            color: rgba(0, 0, 0, 1); /* 100% */
        }

        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@700&display=swap');

        .textorequisito {
            position: absolute;
            top: 750px;
            left: 982px;
            width: 189px;
            height: 27px;
            font-family: 'Roboto', sans-serif;
            font-weight: 700; /* Bold */
            font-size: 20px;
            color: #000000;
        }

        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@700&display=swap');

        .textorarchivo {
            position: absolute;
            top: 750px;
            left: 1443px;
            width: 189px;
            height: 27px;
            font-family: 'Roboto', sans-serif;
            font-weight: 700; /* Bold */
            font-size: 20px;
            color: #000000;
        }

        .linea-negra {
        position: absolute;
        top: 784px;
        left: 960px;
        width: 900px;
        height: 2px;
        background-color: #000000;
        }   

        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap');

        .textoreq1 {
            position: absolute;
            top: 803px;
            left: 985px;
            width: 458px;
            height: 27px;
            font-family: 'Roboto', sans-serif;
            font-weight: 100;
            font-size: 16px;
            color: #000000;
        }

        .textoreq2 {
            position: absolute;
            top: 841px;
            left: 985px;
            width: 458px;
            height: 27px;
            font-family: 'Roboto', sans-serif;
            font-weight: 100;
            font-size: 16px;
            color: #000000;
        }

        .textoreq3 {
            position: absolute;
            top: 879px;
            left: 985px;
            width: 458px;
            height: 27px;
            font-family: 'Roboto', sans-serif;
            font-weight: 100;
            font-size: 16px;
            color: #000000;
        }

        .archivo-cuadro {
        position: absolute;
        left: 1451px;
        width: 263px;
        height: 25px;
        background-color: #FFFFFF;
        border: 1px solid #000000;
        }

        .cuadro-archivo {
            position: absolute;
            left: 1451px;
            width: 263px;
            height: 27px;
            border: 1px solid #000000;
            font-family: 'Inter', sans-serif;
            font-size: 16px;
            font-weight: 200;
            color: rgba(0, 0, 0, 0.5); /* 50% opacidad */
            display: flex;
            align-items: center;
            padding-left: 8px;
            box-sizing: border-box;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            background-color: white;
        }

        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300&display=swap');

        .boton-buscar1,
        .boton-buscar2,
        .boton-buscar3 {
            position: absolute;
            left: 1713px;
            width: 78px;
            height: 25px;
            background-color: #E0E0E0;
            border: 1px solid #000000;
            font-family: 'Inter', sans-serif;
            font-size: 16px;
            font-weight: 300; /* Light */
            color: #000000;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            overflow: hidden;
        }

        .boton-buscar1 { top: 800px; }
        .boton-buscar2 { top: 837px; }
        .boton-buscar3 { top: 874px; }

        .boton-buscar1 label,
        .boton-buscar2 label,
        .boton-buscar3 label {
            width: 100%;
            height: 100%;
            text-align: center;
            line-height: 25px;
            cursor: pointer;
        }

        .input-oculto {
            display: none;
        }

        .boton-enviar {
            position: absolute;
            top: 952px;
            left: 1318px;
            width: 199px;
            height: 53px;
            background-color: white;
            color: #22572D;
            border: 2px solid #22572D;
            font-family: 'Inter', sans-serif;
            font-size: 16px;
            font-weight: 300;
            cursor: pointer;
            text-align: center;
            line-height: 53px;
            transition: all 0.3s ease;
        }

        .boton-enviar:hover {
            background-color: #22572D;
            color: white;
        }

        .nombre-usuario {
            position: absolute;
            top: 20px;
            left: 1790px;
            width: 98px;
            height: 40px;
            font-family: 'Roboto', sans-serif;
            font-weight: 600; /* Semibold */
            font-size: 16px;
            color: #000000;
            display: flex;
            align-items: center;
        }

        .nombre-usuario-inferior {
            position: absolute;
            top: 1000px;
            left: 120px;
            width: 98px;
            height: 40px;
            font-family: 'Roboto', sans-serif;
            font-weight: 600; /* Semibold */
            font-size: 18px;
            color: #FFFFFF;
            display: flex;
            align-items: center;
        }

        .circulo-perfil {
            position: absolute;
            top: 994px;
            left: 24px;
            width: 48px;
            height: 48px;
            background-color: #E5C300; /* Dorado */
            border-radius: 50%;
        }
        
        .inicial-usuario {
            position: absolute;
            top: 998px;
            left: 38px;
            width: 20px;
            height: 40px;
            font-family: 'Roboto', sans-serif;
            font-weight: 700; /* Bold */
            font-size: 24px;
            color: #000000;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .btn-cerrar-sesion {
            position: absolute;
            top: 20px;
            left: 1650px;
            width: 110px;
            height: 40px;
            font-family: 'Roboto', sans-serif;
            font-weight: 400;
            font-size: 16px;
            color: rgba(0, 0, 0, 0.75); /* Negro al 75% */
            background: none;
            border: none;
            cursor: pointer;
            text-align: left;
        }
        .btn-cerrar-sesion:hover {
            text-decoration: underline;
        }
        


    </style>
</head>
<body>


    <div class="sidebar">
    <div class="texto-mesadepartes">Mesa de Partes<br>Virtual</div>
    <div class="texto-uncp">UNCP</div>
    </div>

    <div class="topbar">
        <!-- Título, iconos u opciones superiores -->
    </div>

    <div class="tipotramite">
        <!-- Puedes poner texto o buscador aquí -->
    </div>
    
    <div class="descripcion">
    </div>

    <div class="contenido">
        <!-- Formulario o contenido principal -->
    </div>

    <div class="detalles">
    <!-- Aquí puedes poner tu formulario más adelante -->
    </div>

    <div class="rectangulo-menu"></div>
    <div class="rectangulo-menu" style="top: 221px;"></div>
    <div class="rectangulo-menu" style="top: 281px;"></div>

    <div class="circulo-blanco" style="top: 175px;"></div>
    <div class="circulo-dorado" style="top: 234px;"></div>
    <div class="circulo-blanco" style="top: 293px;"></div>

    <div class="textosistema">Sistema de Trámite Documentario</div>



    <div class="texto-panel">Mi Panel</div>
    <div class="texto-nuevo">Nuevo Trámite</div>
    <div class="texto-historial">Historial de Trámites</div>

    <div class="linea-dorada"></div>

    <div class="textodescripcion">
    <div class="titulo-descripcion">Descripción :</div>
    <br>
    <div class="titulo-descripcion">Requisitos</div>
    <br>
    <div class="detalle-requisito">1.- SOLICITUD DIRIGIDA AL DECANO DE LA FACULTAD</div>
    <div class="detalle-requisito">2.- INFORME JUSTIFICATORIO DEL ASESOR</div>
    <div class="detalle-requisito">3.- PAGO POR DERECHO DE TRAMITE DOCUMENTARIO</div>
    </div>

    <div class="textotipotramite">AMPLIACIÓN DE PLAZO PARA CULMINACION DE EJECUCIÓN DE TESIS</div>

    <div class="textodetalles">
    <div class="seccion-titulo">Detalles :</div>
    <div class="seccion-item">• Duración : 4 días</div>
    <div class="seccion-item">• Área Inicio: Unidad de Administración Documentaria</div>
    <div class="seccion-item">• Dependencia: Sin Asignar</div>
    <br>
    <br>
    <div class="seccion-titulo">Requisitos :</div>
    <div class="seccion-item">• SOLICITUD DIRIGIDA AL DECANO DE LA FACULTAD</div>
    <div class="seccion-item">• INFORME JUSTIFICATORIO DEL ASESOR</div>
    <div class="seccion-item">• PAGO POR DERECHO DE TRAMITE DOCUMENTARIO</div>
    <br>
    <br>
    <div class="seccion-titulo">Sustento:</div>
    </div>

    <div class="cuadro-sustento"></div>

    <textarea class="textarea-sustento" id="sustento" onclick="this.select()">Ingresar sustento......</textarea>

    <div class="textorequisito">Requisito</div>

    <div class="textorarchivo">Archivo</div>

    <div class="linea-negra"></div>

    <div class="textoreq1">SOLICITUD DIRIGIDA AL DECANO DE LA FACULTAD</div>
    <div class="textoreq2">INFORME JUSTIFICATORIO DEL ASESOR</div>
    <div class="textoreq3">PAGO POR DERECHO DE TRAMITE DOCUMENTARIO</div>

    <div class="cuadro-archivo" style="top: 800px;" id="cuadro1">Seleccione un archivo......</div>
    <div class="cuadro-archivo" style="top: 837px;" id="cuadro2">Seleccione un archivo......</div>
    <div class="cuadro-archivo" style="top: 874px;" id="cuadro3">Seleccione un archivo......</div>

    <div class="boton-buscar1">
    <label for="archivo1">BUSCAR</label>
    <input type="file" id="archivo1" class="input-oculto" onchange="mostrarNombre(this, 'cuadro1')" />
    </div>

    <div class="boton-buscar2">
    <label for="archivo2">BUSCAR</label>
    <input type="file" id="archivo2" class="input-oculto" onchange="mostrarNombre(this, 'cuadro2')" />
    </div>

    <div class="boton-buscar3">
    <label for="archivo3">BUSCAR</label>
    <input type="file" id="archivo3" class="input-oculto" onchange="mostrarNombre(this, 'cuadro3')" />
    </div>

    <div class="boton-buscar1">
    <label for="archivo1">BUSCAR</label>
    <input type="file" id="archivo1" class="input-oculto" />
    </div>

    <div class="boton-buscar2">
    <label for="archivo2">BUSCAR</label>
    <input type="file" id="archivo2" class="input-oculto" />
    </div>

    <div class="boton-buscar3">
    <label for="archivo3">BUSCAR</label>
    <input type="file" id="archivo3" class="input-oculto" />
    </div>

    <div class="textoselec1">Seleccione un archivo......</div>
    <div class="textoselec2">Seleccione un archivo......</div>
    <div class="textoselec3">Seleccione un archivo......</div>

    
    <div class="nombre-usuario">
    {{ Auth::user()->name }}
    </div>

    <div class="nombre-usuario-inferior">
    {{ Auth::user()->name }}
    </div>

    <div class="circulo-perfil"></div>

    <div class="inicial-usuario">
    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
    </div>

    <a href="{{ url()->previous() }}" class="flecha-atras">←</a>

    <form action="{{ route('logout') }}" method="POST">
    @csrf
    <button type="submit" class="btn-cerrar-sesion">Cerrar sesión</button>
    </form>


    <form action="{{ route('tramites.ampliacion') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <!-- Sustento -->
    <textarea name="sustento" placeholder="Ingresar sustento......" class="sustento-box"></textarea>

    <!-- Archivos -->
    <input type="file" id="archivo1" name="archivo1" class="input-oculto" onchange="mostrarNombre(this, 'cuadro1')" />
    <input type="file" id="archivo2" name="archivo2" class="input-oculto" onchange="mostrarNombre(this, 'cuadro2')" />
    <input type="file" id="archivo3" name="archivo3" class="input-oculto" onchange="mostrarNombre(this, 'cuadro3')" />

    <!-- Botón Enviar -->
    <button type="submit" class="boton-enviar">+ ENVIAR SOLICITUD</button>
    </form>


<script>
function mostrarNombre(input, divId) {
    const div = document.getElementById(divId);
    if (input.files.length > 0) {
        div.textContent = input.files[0].name;
        div.style.color = "#000000"; // cambiar a 100%
    } else {
        div.textContent = "Seleccione un archivo......";
        div.style.color = "rgba(0, 0, 0, 0.5)";
    }
}
</script>

</body>
</html>
