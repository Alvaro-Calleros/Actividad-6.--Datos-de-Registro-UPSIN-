<?php
session_start();
$_SESSION['token'] = bin2hex(random_bytes(16));
?>
<html>
<head>
    <title>Registro UPSIN</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        :root {
            --primary: #1e3c72;
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
            background-color: rgba(255, 255, 255, 0.95);
            padding: 15px 0;
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
            padding: 5px 10px;
        }

        .navbar-menu a.active {
            border-bottom: 2px solid var(--primary);
        }

        .main-content {
            flex: 1;
            padding: 20px 15px;
        }

        .container {
            max-width: 700px;
            margin: 0 auto;
            background-color: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
        }

        h1 {
            color: var(--primary);
            text-align: center;
            margin-bottom: 5px;
            font-size: 26px;
        }

        .subtitle {
            text-align: center;
            color: #666;
            margin-bottom: 30px;
            display: block;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            color: var(--primary);
            font-weight: 600;
            margin-bottom: 8px;
            font-size: 15px;
        }

        input[type="text"],
        input[type="email"],
        input[type="number"],
        select,
        textarea {
            width: 100%;
            padding: 12px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 16px;
            transition: border 0.3s;
        }

        input:focus,
        select:focus,
        textarea:focus {
            outline: none;
            border-color: #2a5298;
        }

        .options-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
        }

        .option-item {
            display: flex;
            align-items: center;
            gap: 8px;
            background: #f8f9fa;
            padding: 10px;
            border-radius: 6px;
            border: 1px solid #eee;
            flex: 1 1 140px;
        }

        input[type="radio"],
        input[type="checkbox"] {
            transform: scale(1.2);
            margin-right: 5px;
        }

        .btn {
            width: 100%;
            background: var(--bg-grad);
            color: white;
            padding: 15px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: transform 0.2s;
        }

        .btn:hover {
            transform: translateY(-2px);
        }

        .required {
            color: #d32f2f;
        }

        .footer {
            background-color: white;
            padding: 20px;
            text-align: center;
            color: #666;
            font-size: 14px;
        }

        @media (max-width: 768px) {
            .navbar-content {
                flex-direction: column;
                gap: 10px;
            }

            .container {
                padding: 20px;
            }

            .options-grid {
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 10px;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="navbar-content">
            <a href="index.php" class="navbar-brand">UPSIN</a>
            <ul class="navbar-menu">
                <li><a href="index.php">Inicio</a></li>
                <li><a href="captura.php" class="active">Registrar</a></li>
                <li><a href="visualizar.php">Listado</a></li>
            </ul>
        </div>
    </nav>

    <div class="main-content">
        <div class="container">
            <h1>Registro de Aspirantes</h1>
            <span class="subtitle">Universidad Politécnica de Sinaloa</span>
            
            <form method="post" action="guardar.php" enctype="multipart/form-data">
                
                <div class="form-group">
                    <label>Identificador Único <span class="required">*</span></label>
                    <input type="text" name="identificador" required placeholder="Ej: ID12345">
                </div>

                <div class="form-group">
                    <label>Nombre Completo <span class="required">*</span></label>
                    <input type="text" name="nombre" required placeholder="Ingresa tu nombre completo">
                </div>

                <div class="form-group">
                    <label>Correo Electrónico <span class="required">*</span></label>
                    <input type="email" name="correo" required placeholder="correo@ejemplo.com">
                </div>

                <div class="form-group">
                    <label>Edad <span class="required">*</span></label>
                    <input type="number" name="edad" min="15" max="100" required>
                </div>

                <div class="form-group">
                    <label>Género</label>
                    <div class="options-grid">
                        <div class="option-item">
                            <input type="radio" name="genero" value="Masculino" id="m">
                            <label for="m">Masculino</label>
                        </div>
                        <div class="option-item">
                            <input type="radio" name="genero" value="Femenino" id="f">
                            <label for="f">Femenino</label>
                        </div>
                        <div class="option-item">
                            <input type="radio" name="genero" value="Otro" id="o">
                            <label for="o">Otro</label>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label>Hobbies e Intereses</label>
                    <div class="options-grid">
                        <div class="option-item">
                            <input type="checkbox" name="hobbies[]" value="Deportes" id="h1">
                            <label for="h1">Deportes</label>
                        </div>
                        <div class="option-item">
                            <input type="checkbox" name="hobbies[]" value="Música" id="h2">
                            <label for="h2">Música</label>
                        </div>
                        <div class="option-item">
                            <input type="checkbox" name="hobbies[]" value="Lectura" id="h3">
                            <label for="h3">Lectura</label>
                        </div>
                        <div class="option-item">
                            <input type="checkbox" name="hobbies[]" value="Videojuegos" id="h4">
                            <label for="h4">Gaming</label>
                        </div>
                        <div class="option-item">
                            <input type="checkbox" name="hobbies[]" value="Arte" id="h5">
                            <label for="h5">Arte</label>
                        </div>
                        <div class="option-item">
                            <input type="checkbox" name="hobbies[]" value="Programación" id="h6">
                            <label for="h6">Progra</label>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label>Carrera de Interés <span class="required">*</span></label>
                    <select name="carrera" required>
                        <option value="">Selecciona una carrera...</option>
                        <option value="Ingeniería en Tecnologias de la Informacion">Ing. Sistemas / IT</option>
                        <option value="Ingeniería Nanotecnología">Nanotecnología</option>
                        <option value="Ingeniería en Biotecnología">Biotecnología</option>
                        <option value="Ingeniería en Mecatrónica">Mecatrónica</option>
                        <option value="Ingeniería en Energía">Energía</option>
                        <option value="Licenciatura en Administración">Administración</option>
                        <option value="Licenciatura en Fisioterapia">Fisioterapia</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Comentarios</label>
                    <textarea name="bio" placeholder="Cuéntanos sobre ti..."></textarea>
                </div>

                <div class="form-group">
                    <label>Fotografía</label>
                    <input type="file" name="foto" accept="image/*">
                </div>

                <input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>">
                <button type="submit" class="btn">Registrar Aspirante</button>
            </form>
        </div>
    </div>

    <footer class="footer">
        <p>UPSIN - Alvaro Calleros Sanchez © 2025</p>
    </footer>
</body>
</html>