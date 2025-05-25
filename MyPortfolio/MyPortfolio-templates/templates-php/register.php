<?php
session_start();
require_once('config.php');

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    // Recoger y sanitizar datos del formulario
    $first_name = trim($_POST['nombre']);  // Campo "nombre" del formulario → first_name
    $last_name = trim($_POST['apellido']);   // Campo "apellido" del formulario → last_name
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Validación básica
    if (empty($first_name) || empty($last_name) || empty($email) || empty($password) || empty($confirm_password)) {
        $error = "Todos los campos son obligatorios.";
    } elseif ($password !== $confirm_password) {
        $error = "Las contraseñas no coinciden.";
    } else {
        // Procesar la subida del avatar
        $avatar = ""; // Valor por defecto
        if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === UPLOAD_ERR_OK) {
            $fileTmpPath = $_FILES['avatar']['tmp_name'];
            $fileName = $_FILES['avatar']['name'];
            $fileNameCmps = explode(".", $fileName);
            $fileExtension = strtolower(end($fileNameCmps));

            // Extensiones permitidas
            $allowedfileExtensions = array('jpg', 'jpeg', 'png', 'avif', 'webp', 'jfif');
            if (in_array($fileExtension, $allowedfileExtensions)) {
                $uploadFileDir = './uploads/avatars/';
                // Crear la carpeta si no existe
                if (!is_dir($uploadFileDir)) {
                    mkdir($uploadFileDir, 0777, true);
                }
                // Renombrar el archivo para evitar conflictos
                $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
                $dest_path = $uploadFileDir . $newFileName;
                if (move_uploaded_file($fileTmpPath, $dest_path)) {
                    $avatar = $dest_path; // Guardamos la ruta para insertar en la BD
                } else {
                    $error = "Error al mover el archivo subido.";
                }
            } else {
                $error = "La extensión del archivo no es permitida. Solo se permiten: " . implode(',', $allowedfileExtensions);
            }
        } else {
            $avatar = "";
        }
    }

    // Proceder a insertar el usuario solo si no hay error
    if (!isset($error)) {
        // Verificar si el email ya existe
        $stmt = $mysqli->prepare("SELECT id FROM USERS WHERE email = ?");
        if (!$stmt) {
            die("Error en prepare (SELECT): " . $mysqli->error);
        }
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            $error = "El email ya está registrado.";
        } else {
            $stmt->close();
            // Cifrar la contraseña
            $hash_password = password_hash($password, PASSWORD_DEFAULT);
            $role = "user"; // Valor por defecto
            // Insertar nuevo usuario en la tabla USERS
            $stmt = $mysqli->prepare("INSERT INTO USERS (first_name, last_name, email, avatar, password, role, registration_date) VALUES (?, ?, ?, ?, ?, ?, NOW())");
            if (!$stmt) {
                die("Error en prepare (INSERT): " . $mysqli->error);
            }
            $stmt->bind_param("ssssss", $first_name, $last_name, $email, $avatar, $hash_password, $role);
            if ($stmt->execute()) {
                $success = "Usuario registrado correctamente. Puedes iniciar sesión.";
            } else {
                $error = "Error al registrar el usuario.";
            }
            $stmt->close();
            $mysqli->close();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - Portfolio Eric Sáez</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Estilos personalizados -->
    <style>
        body {
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .register-container {
            background: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            width: 100%;
        }

        .register-container h1 {
            font-size: 2rem;
            margin-bottom: 1.5rem;
            text-align: center;
            color: #333;
        }

        .form-label {
            font-weight: 500;
        }

        .form-control {
            margin-bottom: 1rem;
        }

        .btn-primary {
            width: 100%;
            padding: 0.75rem;
            font-size: 1rem;
        }

        .error-message {
            color: red;
            text-align: center;
            margin-bottom: 1rem;
        }

        .success-message {
            color: green;
            text-align: center;
            margin-bottom: 1rem;
        }
    </style>
</head>

<body>
    <div class="register-container">
        <h1>Registrarse</h1>
        <!-- Mostrar mensajes de éxito o error -->
        <?php if (isset($success)): ?>
            <div class="success-message"><?= $success; ?></div>
        <?php endif; ?>
        <?php if (isset($error)): ?>
            <div class="error-message"><?= $error; ?></div>
        <?php endif; ?>

        <!-- Formulario para registrar usuario con subida de avatar -->
        <form method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required>
            </div>
            <div class="mb-3">
                <label for="apellido" class="form-label">Apellido</label>
                <input type="text" class="form-control" id="apellido" name="apellido" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Correo Electrónico</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="mb-3">
                <label for="confirm_password" class="form-label">Confirmar Contraseña</label>
                <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
            </div>
            <div class="mb-3">
                <label for="avatar" class="form-label">Avatar (subir imagen)</label>
                <input type="file" class="form-control" id="avatar" name="avatar">
            </div>
            <button type="submit" class="btn btn-primary">Registrarse</button>
        </form>
        <div class="text-center mt-3">
            <p>¿Ya tienes una cuenta? <a href="login.php">Inicia sesión aquí</a></p>
            <a href="index.php" class="btn btn-outline-secondary">Volver al Inicio</a>
        </div>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>