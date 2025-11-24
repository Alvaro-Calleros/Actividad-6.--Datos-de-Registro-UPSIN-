<?php
$conn = new mysqli('localhost', 'root', '', 'upsin_registro');

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

$conn->set_charset('utf8');

if (isset($_GET['eliminar'])) {
    $id = intval($_GET['eliminar']);
    $conn->query("DELETE FROM personas WHERE id = $id");
    header("Location: visualizar.php");
    exit;
}

$busqueda = $_GET['buscar'] ?? '';
$sql = "SELECT * FROM personas";
if (!empty($busqueda)) {
    $busqueda_safe = $conn->real_escape_string($busqueda);
    $sql .= " WHERE id = '$busqueda_safe' OR nombre LIKE '%$busqueda_safe%' OR identificador LIKE '%$busqueda_safe%'";
}
$sql .= " ORDER BY id DESC";

$resultado = $conn->query($sql);
?>
<html>
<head>
    <title>Registros UPSIN</title>
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
            background-color: white;
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
        }

        .navbar-menu a.active {
            color: var(--secondary);
            font-weight: bold;
        }

        .main-content {
            flex: 1;
            padding: 20px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            background-color: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
        }

        h1 {
            color: var(--primary);
            text-align: center;
            margin-bottom: 25px;
            font-size: 28px;
        }

        .actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            flex-wrap: wrap;
            gap: 15px;
        }

        .search-form {
            display: flex;
            gap: 10px;
            flex: 1;
            min-width: 280px;
        }

        .search-form input {
            flex: 1;
            padding: 10px;
            border: 2px solid #e0e0e0;
            border-radius: 6px;
            font-size: 16px;
        }

        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 600;
            text-decoration: none;
            display: inline-block;
            text-align: center;
        }

        .btn-primary {
            background: var(--primary);
            color: white;
        }

        .btn-new {
            background-color: #28a745;
            color: white;
            white-space: nowrap;
        }

        .btn-danger {
            background-color: #d32f2f;
            color: white;
            font-size: 13px;
            padding: 8px 12px;
        }

        .table-container {
            width: 100%;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th {
            background: var(--primary);
            color: white;
            padding: 15px;
            text-align: left;
        }

        td {
            padding: 12px;
            border-bottom: 1px solid #e0e0e0;
            vertical-align: middle;
        }

        tr:hover {
            background-color: #f8f9fa;
        }

        .foto-mini {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 50%;
            border: 1px solid #ddd;
        }

        .footer {
            background-color: white;
            padding: 20px;
            text-align: center;
            color: #666;
        }

        @media (max-width: 768px) {
            .navbar-content {
                flex-direction: column;
                gap: 10px;
                align-items: center;
            }

            .container {
                padding: 15px;
            }

            h1 {
                font-size: 22px;
            }

            .actions {
                flex-direction: column;
            }

            .btn-new {
                width: 100%;
            }

            thead {
                display: none;
            }

            tr {
                display: block;
                margin-bottom: 20px;
                border: 1px solid #ddd;
                border-radius: 8px;
                background: #fdfdfd;
                padding: 15px;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            }

            td {
                display: flex;
                justify-content: space-between;
                align-items: center;
                border-bottom: 1px solid #f0f0f0;
                padding: 10px 5px;
                font-size: 15px;
                text-align: right;
            }

            td:last-child {
                border-bottom: none;
                justify-content: center;
                margin-top: 10px;
            }

            td::before {
                content: attr(data-label);
                font-weight: bold;
                color: var(--primary);
                text-align: left;
                margin-right: 15px;
            }

            .foto-mini {
                width: 60px;
                height: 60px;
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
                <li><a href="captura.php">Registrar</a></li>
                <li><a href="visualizar.php" class="active">Listado</a></li>
            </ul>
        </div>
    </nav>

    <div class="main-content">
        <div class="container">
            <h1>Aspirantes Registrados</h1>
            
            <div class="actions">
                <form class="search-form" method="get">
                    <input type="text" name="buscar" placeholder="Buscar..." value="<?php echo htmlspecialchars($busqueda); ?>">
                    <button type="submit" class="btn btn-primary">Buscar</button>
                </form>
                <a href="captura.php" class="btn btn-new">+ Nuevo Registro</a>
            </div>

            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Identificador</th>
                            <th>Nombre</th>
                            <th>Correo</th>
                            <th>Carrera</th>
                            <th>Foto</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($resultado->num_rows > 0): ?>
                            <?php while($row = $resultado->fetch_assoc()): ?>
                                <tr>
                                    <td data-label="ID"><?php echo $row['id']; ?></td>
                                    <td data-label="Identificador"><strong><?php echo htmlspecialchars($row['identificador']); ?></strong></td>
                                    <td data-label="Nombre"><?php echo htmlspecialchars($row['nombre']); ?></td>
                                    <td data-label="Correo"><?php echo htmlspecialchars($row['correo']); ?></td>
                                    <td data-label="Carrera"><?php echo htmlspecialchars($row['carrera']); ?></td>
                                    <td data-label="Foto">
                                        <?php if ($row['foto_path']): ?>
                                            <img src="<?php echo htmlspecialchars($row['foto_path']); ?>" class="foto-mini" alt="Foto">
                                        <?php else: ?>
                                            <span>Sin foto</span>
                                        <?php endif; ?>
                                    </td>
                                    <td data-label="Acciones">
                                        <a href="?eliminar=<?php echo $row['id']; ?>" class="btn btn-danger" onclick="return confirm('¿Eliminar este registro?')">Eliminar</a>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7" style="text-align:center; padding:30px; color:#999;">No hay registros</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <footer class="footer">
        <p>UPSIN - Alvaro Calleros Sanchez © 2025</p>
    </footer>
</body>
</html>
<?php
$conn->close();
?>