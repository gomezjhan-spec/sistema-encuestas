<?php
require_once __DIR__ . '/includes/functions.php';
require_once __DIR__ . '/includes/csrf.php';
if (current_user()) redirect('dashboard.php');
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verify_csrf();
    $login = trim($_POST['login'] ?? ''); $password = $_POST['password'] ?? '';
    $stmt = db()->prepare('SELECT u.id_usuario, u.nombres, u.apellidos, u.usuario, u.correo, u.password_hash, u.estado, r.nombre AS role FROM usuarios u JOIN roles r ON r.id_rol=u.id_rol WHERE (u.usuario=? OR u.correo=?) LIMIT 1');
    $stmt->execute([$login, $login]); $row = $stmt->fetch();
    if ($row && $row['estado'] === 'activo' && password_verify($password, $row['password_hash'])) {
        session_regenerate_id(true);
        $_SESSION['user'] = ['id'=>$row['id_usuario'], 'name'=>$row['nombres'].' '.$row['apellidos'], 'role'=>$row['role'], 'username'=>$row['usuario']];
        log_event(db(), (int)$row['id_usuario'], 'INICIO_SESION', 'El usuario inició sesión.');
        redirect('dashboard.php');
    }
    $error = 'Credenciales incorrectas o usuario inactivo.';
}
$pageTitle = 'Iniciar sesión'; require __DIR__ . '/includes/header.php';
?>
<div class="login-wrap"><div class="login-panel"><div class="text-center mb-4"><div class="login-icon">E</div><h1 class="h3 fw-bold mt-3">Bienvenido</h1><p class="text-secondary">Ingresa al sistema de gestión de encuestas</p></div>
<?php if ($error): ?><div class="alert alert-danger"><?= e($error) ?></div><?php endif; ?>
<form method="post" novalidate><input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>"><div class="mb-3"><label class="form-label">Usuario o correo</label><input class="form-control form-control-lg" name="login" autocomplete="username" required autofocus></div><div class="mb-4"><label class="form-label">Contraseña</label><input class="form-control form-control-lg" type="password" name="password" autocomplete="current-password" required></div><button class="btn btn-primary btn-lg w-100">Iniciar sesión</button></form>
<p class="small text-secondary text-center mt-4 mb-0">Acceso exclusivo para usuarios autorizados.</p></div></div>
<?php require __DIR__ . '/includes/footer.php'; ?>
