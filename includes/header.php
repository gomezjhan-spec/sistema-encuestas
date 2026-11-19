<?php
require_once __DIR__ . '/functions.php';
$pageTitle = $pageTitle ?? APP_NAME;
$user = current_user();
$notice = get_flash();
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= e($pageTitle) ?> | <?= e(APP_NAME) ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/app.css">
  <?php if (!empty($includeMap)): ?>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="">
  <?php endif; ?>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark app-nav"><div class="container-fluid px-lg-4">
  <a class="navbar-brand fw-bold" href="<?= $user ? 'dashboard.php' : 'login.php' ?>"> <span class="brand-mark">E</span> Encuestas</a>
  <?php if ($user): ?>
  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav"><span class="navbar-toggler-icon"></span></button>
  <div class="collapse navbar-collapse" id="mainNav"><ul class="navbar-nav me-auto mb-2 mb-lg-0">
    <li class="nav-item"><a class="nav-link" href="dashboard.php">Inicio</a></li>
    <?php if (has_role(['administrador','ventanilla'])): ?><li class="nav-item"><a class="nav-link" href="nueva_solicitud.php">Registrar solicitud</a></li><?php endif; ?>
    <?php if (has_role(['administrador','ventanilla','enrutador','calidad'])): ?><li class="nav-item"><a class="nav-link" href="solicitudes.php">Solicitudes</a></li><?php endif; ?>
    <?php if (has_role(['administrador','enrutador'])): ?><li class="nav-item"><a class="nav-link" href="bitacora.php">Bitácora diaria</a></li><?php endif; ?>
    <?php if (has_role('administrador')): ?><li class="nav-item"><a class="nav-link" href="usuarios.php">Usuarios</a></li><?php endif; ?>
  </ul><div class="d-flex align-items-center gap-3 text-white"><span class="small d-none d-md-inline"><?= e($user['name']) ?> · <?= e(ucfirst($user['role'])) ?></span><a class="btn btn-sm btn-outline-light" href="logout.php">Cerrar sesión</a></div></div>
  <?php endif; ?>
</div></nav>
<main class="container-fluid px-lg-4 py-4">
<?php if ($notice): ?><div class="alert alert-<?= e($notice['type']) ?> alert-dismissible fade show" role="alert"><?= e($notice['message']) ?><button type="button" class="btn-close" data-bs-dismiss="alert"></button></div><?php endif; ?>
