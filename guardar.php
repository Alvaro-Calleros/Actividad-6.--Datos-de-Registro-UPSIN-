<?php
session_start();

if (!isset($_POST['token']) || $_POST['token'] !== $_SESSION['token']) {
	die("Error: Token inválido");
}

$identificador = trim($_POST['identificador'] ?? '');
$nombre = trim($_POST['nombre'] ?? '');
$correo = trim($_POST['correo'] ?? '');
$edad = intval($_POST['edad'] ?? 0);
$genero = $_POST['genero'] ?? '';
$hobbies = isset($_POST['hobbies']) ? implode(', ', $_POST['hobbies']) : '';
$carrera = $_POST['carrera'] ?? '';
$bio = trim($_POST['bio'] ?? '');

if (empty($nombre) || empty($correo) || empty($carrera)) {
	die("Error: Nombre, correo y carrera son obligatorios");
}

if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
	die("Error: Formato de correo inválido");
}

if ($edad < 18 || $edad > 100) {
	die("Error: Edad fuera de rango permitido (15-100)");
}

$foto_path = null;
if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
	$permitidos = ['jpg', 'jpeg', 'png', 'gif'];
	$extension = strtolower(pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION));
	$tamano = $_FILES['foto']['size'];
	
	if (!in_array($extension, $permitidos)) {
		die("Error: Solo se permiten imágenes JPG, PNG o GIF");
	}
	
	if ($tamano > 2 * 1024 * 1024) {
		die("Error: La imagen no puede superar 2MB");
	}
	
	if (!is_dir('uploads')) {
		mkdir('uploads', 0777, true);
	}
	
	$nombre_unico = 'foto_' . uniqid() . '.' . $extension;
	$ruta_destino = 'uploads/' . $nombre_unico;
	
	if (move_uploaded_file($_FILES['foto']['tmp_name'], $ruta_destino)) {
		$foto_path = $ruta_destino;
	}
}

$conn = new mysqli('localhost', 'root', '', 'upsin_registro');

if ($conn->connect_error) {
	die("Error de conexión: " . $conn->connect_error);
}

$conn->set_charset('utf8');

$stmt = $conn->prepare("INSERT INTO personas (identificador, nombre, correo, edad, genero, hobbies, carrera, bio, foto_path) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssisssss", $identificador, $nombre, $correo, $edad, $genero, $hobbies, $carrera, $bio, $foto_path);

if ($stmt->execute()) {
	header("Location: visualizar.php?success=1");
} else {
	echo "Error al guardar: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>