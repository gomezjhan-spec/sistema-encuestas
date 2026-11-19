<?php
declare(strict_types=1);

const APP_NAME = 'Sistema de Gestión de Encuestas';
const APP_TIMEZONE = 'America/Bogota';
date_default_timezone_set(APP_TIMEZONE);

// Configuración predeterminada para Laragon. Ajustar si las credenciales locales son distintas.
define('DB_HOST', getenv('DB_HOST') ?: '127.0.0.1');
define('DB_NAME', getenv('DB_NAME') ?: 'sistema_encuestas');
define('DB_USER', getenv('DB_USER') ?: 'root');
define('DB_PASS', getenv('DB_PASS') !== false ? getenv('DB_PASS') : '');

if (session_status() !== PHP_SESSION_ACTIVE) {
    $secure = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off');
    session_set_cookie_params([
        'httponly' => true,
        'secure' => $secure,
        'samesite' => 'Lax',
    ]);
    session_start();
}
