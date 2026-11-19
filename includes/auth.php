<?php
declare(strict_types=1);
require_once __DIR__ . '/functions.php';
function require_login(): void { if (!current_user()) { flash('warning', 'Inicia sesión para continuar.'); redirect('login.php'); } }
function require_role(array|string $roles): void {
    require_login();
    if (!has_role($roles)) { http_response_code(403); require __DIR__ . '/header.php'; echo '<div class="alert alert-danger">No tienes permisos para acceder a esta sección.</div>'; require __DIR__ . '/footer.php'; exit; }
}
