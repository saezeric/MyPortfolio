<?php
session_start();
require_once('./config.php');

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    // 1. Recoger y sanitizar datos del formulario
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // 2. Preparar la consulta en la tabla USERS usando un prepared statement
    $stmt = $mysqli->prepare("SELECT * FROM USERS WHERE email = ? LIMIT 1");
    if (!$stmt) {
        die("Error en prepare: " . $mysqli->error);
    }
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    // 3. Comprobar si se encontró el usuario
    if ($result && $result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // 4. Verificar la contraseña
        if (password_verify($password, $user['password'])) {
            // 5. Iniciar sesión y guardar variables en $_SESSION
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_email'] = $user['email'];
            $_SESSION['user_name'] = $user['first_name'];   // Se usa first_name según la BD
            $_SESSION['user_surname'] = $user['last_name'];   // Se usa last_name según la BD
            $_SESSION['user_avatar'] = $user['avatar'];
            $_SESSION['user_rol'] = $user['role'];
            header('Location: index.php');
            exit;
        } else {
            $error = "Contraseña incorrecta";
        }
    } else {
        $error = "Usuario no encontrado";
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
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

        .login-container {
            background: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
        }

        .login-container h1 {
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
    </style>
</head>

<body>
    <div class="login-container">
        <h1>Iniciar Sesión</h1>

        <!-- Mostrar mensajes de error -->
        <?php if (isset($error)): ?>
            <div class="error-message"><?= $error; ?></div>
        <?php endif; ?>

        <form method="POST">
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
        </form>

        <!-- Enlaces para registrarse y volver al inicio -->
        <div class="text-center mt-3">
            <p>¿No tienes una cuenta? <a href="register.php">Regístrate aquí</a></p>
            <a href="index.php" class="btn btn-outline-secondary">Volver al Inicio</a>
        </div>
    </div>

    <!-- Bootstrap JS (opcional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>