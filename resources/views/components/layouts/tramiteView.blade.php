<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sistema de Trámites')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        :root {
            --verde-principal: #22572D;
            --amarillo: #E5C300;
            --gris-claro: #f0f0f0;
            --gris-intermedio: #e0e0e0;
            --negro: #1e1e1e;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            background-color: #f5f5f5;
        }

        .topbar {
            background-color: white;
            color: black;
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #ddd;
            position: fixed;
            top: 0;
            left: 250px;
            right: 0;
            z-index: 200;
        }

        .topbar-left {
            font-size: 14px;
            font-weight: bold;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .back-arrow {
            background: none;
            border: none;
            font-size: 18px;
            cursor: pointer;
            color: var(--verde-principal);
            padding: 5px;
            border-radius: 3px;
            transition: background-color 0.2s ease;
        }

        .back-arrow:hover {
            background-color: var(--gris-claro);
        }

        .topbar-right {
            font-size: 12px;
            color: #666;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .logout-btn {
            background: none;
            border: none;
            color: #666;
            cursor: pointer;
            font-size: 12px;
            padding: 5px 8px;
            border-radius: 3px;
            transition: background-color 0.2s ease;
        }

        .logout-btn:hover {
            background-color: var(--gris-claro);
            color: var(--negro);
        }

        .user-name {
            font-weight: 500;
        }

        .layout {
            display: flex;
            min-height: 100vh;
            position: relative;
        }

        .sidebar {
            width: 250px;
            background-color: var(--verde-principal);
            color: white;
            padding: 20px;
            flex-shrink: 0;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            position: fixed;
            height: 100vh;
            left: 0;
            top: 0;
            z-index: 100;
        }

        .sidebar h2 {
            font-size: 16px;
            margin-bottom: 30px;
            line-height: 1.4;
            font-weight: bold;
        }

        .sidebar a {
            display: block;
            color: white;
            text-decoration: none;
            padding: 12px 15px;
            margin-bottom: 5px;
            border-radius: 5px;
            transition: background 0.2s ease;
            font-size: 14px;
        }

        .sidebar a.active,
        .sidebar a:hover {
            background-color: var(--amarillo);
            color: black;
        }

        .user-info {
            display: flex;
            align-items: center;
            margin-top: 20px;
            padding: 15px;
            border-radius: 5px;
            background-color: rgba(0,0,0,0.1);
        }

        .user-circle {
            width: 35px;
            height: 35px;
            background-color: var(--amarillo);
            color: black;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            margin-right: 10px;
            font-weight: bold;
            font-size: 16px;
        }

        .user-details {
            font-size: 14px;
            line-height: 1.3;
        }

        .user-details small {
            font-size: 12px;
            opacity: 0.8;
        }

        .content {
            flex: 1;
            padding: 30px 40px;
            background-color: #e9e9e9;
            margin-left: 250px;
            margin-top: 60px;
        }

        .content h2 {
            margin-top: 0;
            margin-bottom: 30px;
            font-size: 24px;
            color: var(--negro);
        }

        .tramite {
            background-color: var(--gris-claro);
            padding: 15px 20px;
            margin-bottom: 8px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-radius: 5px;
            border: 1px solid #ddd;
        }

        .tramite:nth-child(even) {
            background-color: var(--gris-intermedio);
        }

        .tramite-text {
            font-size: 14px;
            color: var(--negro);
            flex: 1;
        }

        .tramite button {
            background-color: var(--amarillo);
            border: none;
            padding: 8px 16px;
            cursor: pointer;
            font-weight: bold;
            border-radius: 4px;
            transition: background 0.2s ease;
            font-size: 12px;
            color: black;
        }

        .tramite button:hover {
            background-color: #cfae00;
        }

        @media (max-width: 768px) {
            .layout {
                flex-direction: column;
            }

            .sidebar {
                width: 100%;
                flex-direction: row;
                flex-wrap: wrap;
                align-items: center;
                justify-content: space-around;
                height: auto;
                padding: 10px;
                position: relative;
            }

            .sidebar h2,
            .user-info {
                display: none;
            }

            .topbar {
                left: 0;
                top: auto;
                position: relative;
            }

            .content {
                padding: 15px;
                margin-left: 0;
                margin-top: 0;
            }

            .tramite {
                flex-direction: column;
                align-items: flex-start;
            }

            .tramite button {
                margin-top: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="topbar">
        <div class="topbar-left">
            <button class="back-arrow" onclick="goBack()" title="Regresar">←</button>
            Sistema de Trámites Documentarios
        </div>
        <div class="topbar-right">
            <button class="logout-btn" onclick="logout()" title="Cerrar Sesión">Cerrar Sesión</button>
            <span>|</span>
            <span class="user-name">Sasha Blasue</span>
        </div>
    </div>

    <div class="layout">
        <div class="sidebar">
            <div>
                <h2>Mesa de Partes Virtual<br>UNCP</h2>
                <a href="{{ route('tramites.index') }}"> Mi Panel</a>
                <a href="#" class="active">Nuevo Trámite</a>
                <a href="{{ route('historial.tramites') }}">Historial de Trámites</a>
            </div>
            <div class="user-info">
                <div class="user-circle">S</div>
                <div class="user-details">
                    <strong>Sasha Blasue</strong><br>
                    <small>Estudiante</small>
                </div>
            </div>
        </div>

        <div class="content">
            <h2>@yield('page-title')</h2>
            @yield('content')
        </div>
    </div>

    <script>
        function goBack() {
            window.history.back();
        }

        function logout() {
            if (confirm('¿Estás seguro que deseas cerrar sesión?')) {
                window.location.href = '/logout';
            }
        }
    </script>
</body>
</html>
