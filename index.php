<html>
<head>
    <title>Sistema UPSIN - Inicio</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        :root {
            --primary: #1e3c72;
            --secondary: #2a5298;
            --bg-grad: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: var(--bg-grad);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .navbar {
            background-color: rgba(255, 255, 255, 0.98);
            padding: 15px 0;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .navbar-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
        }

        .navbar-brand {
            font-size: 24px;
            font-weight: bold;
            color: var(--primary);
            text-decoration: none;
        }

        .navbar-menu {
            display: flex;
            gap: 20px;
            list-style: none;
        }

        .navbar-menu a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 600;
            padding: 8px 12px;
            border-radius: 6px;
            transition: background 0.3s;
        }

        .navbar-menu a:hover,
        .navbar-menu a.active {
            background-color: #f0f2f5;
            color: var(--secondary);
        }

        .main-content {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 30px 20px;
        }

        .container {
            max-width: 900px;
            width: 100%;
            background-color: white;
            padding: 50px 30px;
            border-radius: 16px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            text-align: center;
        }

        .logo {
            width: 100px;
            height: 100px;
            background: var(--bg-grad);
            border-radius: 50%;
            margin: 0 auto 25px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 40px;
            color: white;
            font-weight: bold;
        }

        h1 {
            color: var(--primary);
            font-size: 32px;
            margin-bottom: 10px;
        }

        .subtitle {
            color: #666;
            font-size: 18px;
            margin-bottom: 40px;
            display: block;
        }

        .cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 25px;
            margin-top: 30px;
        }

        .card {
            background: linear-gradient(135deg, #f5f7fa 0%, #e4ecf7 100%);
            padding: 30px;
            border-radius: 12px;
            transition: transform 0.3s, box-shadow 0.3s;
            cursor: pointer;
            border: 1px solid #dae1e7;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        }

        .card-icon {
            font-size: 42px;
            margin-bottom: 15px;
        }

        .card h2 {
            color: var(--primary);
            font-size: 20px;
            margin-bottom: 10px;
        }

        .card p {
            color: #555;
            font-size: 14px;
            margin-bottom: 20px;
            line-height: 1.5;
        }

        .btn {
            display: inline-block;
            padding: 12px 30px;
            background: var(--bg-grad);
            color: white;
            text-decoration: none;
            border-radius: 6px;
            font-weight: 600;
            width: 100%;
        }

        .footer {
            background-color: rgba(255, 255, 255, 0.95);
            padding: 20px;
            text-align: center;
            color: #666;
            font-size: 14px;
        }

        @media (max-width: 768px) {
            .navbar-content {
                flex-direction: column;
                gap: 15px;
            }

            .navbar-menu {
                width: 100%;
                justify-content: center;
                gap: 10px;
            }

            .container {
                padding: 30px 20px;
            }

            h1 {
                font-size: 24px;
            }

            .cards {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="navbar-content">
            <a href="index.php" class="navbar-brand">UPSIN</a>
            <ul class="navbar-menu">
                <li><a href="index.php" class="active">Inicio</a></li>
                <li><a href="captura.php">Registrar</a></li>
                <li><a href="visualizar.php">Listado</a></li>
            </ul>
        </div>
    </nav>

    <div class="main-content">
        <div class="container">
            <div class="logo">U</div>
            <h1>Sistema de Registro UPSIN</h1>
            <span class="subtitle">Gestión de Aspirantes - Universidad Politécnica de Sinaloa</span>

            <div class="cards">
                <div class="card" onclick="location.href='captura.php'">
                    <div class="card-icon">📝</div>
                    <h2>Registrar Aspirante</h2>
                    <p>Captura datos de nuevos aspirantes con fotografía y toda la información necesaria</p>
                    <a href="captura.php" class="btn">Ir a Registro</a>
                </div>

                <div class="card" onclick="location.href='visualizar.php'">
                    <div class="card-icon">👥</div>
                    <h2>Ver Registros</h2>
                    <p>Consulta, busca y administra todos los aspirantes registrados en el sistema</p>
                    <a href="visualizar.php" class="btn">Ver Registros</a>
                </div>
            </div>
        </div>
    </div>

    <footer class="footer">
        <p>UPSIN - Alvaro Calleros Sanchez © 2025</p>
    </footer>
</body>
</html>