<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Sistema de Trámite Documentario</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            height: 100vh;
            overflow: hidden;
        }

        .container {
            display: flex;
            height: 100vh;
        }

        .sidebar {
            background-color: #245624;
            color: white;
            width: 250px;
            padding: 20px;
            box-sizing: border-box;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .sidebar h2 {
            font-size: 18px;
            margin-bottom: 20px;
        }

        .sidebar a {
            display: block;
            color: white;
            padding: 10px;
            margin: 5px 0;
            text-decoration: none;
            border-radius: 5px;
        }

        .sidebar a.active {
            background-color: #F5C518;
            color: black;
        }

        .user-info {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        .user-info .avatar {
            background: yellow;
            color: black;
            padding: 10px;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 5px;
        }

        .main {
            flex: 1;
            display: flex;
            flex-direction: column;
            background-color: #f5f5f5;
            overflow-y: auto;
        }

        .topbar {
            background-color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 30px;
            font-size: 17px;
            font-weight: 500;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .topbar-left {
            display: flex;
            align-items: center;
            gap: 10px;
            color: #666;
        }

        .topbar-right {
            display: flex;
            align-items: center;
            gap: 15px;
            color: #666;
            font-weight: normal;
        }

        .topbar-right span {
            font-size: 15px;
        }

        .topbar a {
            text-decoration: none;
            color: #666;
            font-weight: normal;
        }

        .content {
            padding: 30px;
            flex: 1;
            overflow-y: auto;
        }

        .back-arrow {
            font-size: 20px;
            cursor: pointer;
            user-select: none;
        }
    </style>
</head>
<body>

    <div class="container">

        <!-- MENÚ LATERAL -->
        <div class="sidebar">
            <div>
                <h2>Mesa de Partes Virtual<br>UNCP</h2>
                <a href="#">Mi Panel</a>
                <a href="#" class="active">Nuevo Trámite</a>
                <a href="#">Historial de Trámites</a>
            </div>
            <div class="user-info">
                <div class="avatar">S</div>
                <p>Sasha Blouse<br><small>Estudiante</small></p>
            </div>
        </div>

        <!-- CONTENIDO PRINCIPAL -->
        <div class="main">

            <!-- Barra superior blanca -->
            <div class="topbar">
                <div class="topbar-left">
                    <span class="back-arrow" onclick="window.history.back()">←</span>
                    <span>Sistema de Trámite Documentario</span>
                </div>
                <div class="topbar-right">
                    <a href="#">Cerrar Sesión</a>
                    <span>Sasha Blouse</span>
                </div>
            </div>

            <!-- Área de contenido dinámico -->
            <div class="content">
                @yield('content')
            </div>

        </div>

    </div>

</body>
</html>
