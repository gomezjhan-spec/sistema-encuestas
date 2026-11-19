<?php
declare(strict_types=1);
require_once __DIR__ . '/../config/database.php';

function e(?string $value): string { return htmlspecialchars((string)$value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); }
function redirect(string $url): never { header('Location: ' . $url); exit; }
function flash(string $type, string $message): void { $_SESSION['flash'] = ['type' => $type, 'message' => $message]; }
function get_flash(): ?array { $f = $_SESSION['flash'] ?? null; unset($_SESSION['flash']); return $f; }
function current_user(): ?array { return $_SESSION['user'] ?? null; }
function has_role(array|string $roles): bool {
    $user = current_user(); if (!$user) return false;
    return in_array($user['role'], (array)$roles, true);
}
function log_event(PDO $pdo, int $userId, string $action, string $description, ?int $requestId = null): void {
    $stmt = $pdo->prepare('INSERT INTO bitacora (id_usuario, id_solicitud, accion, descripcion, fecha_evento) VALUES (?, ?, ?, ?, NOW())');
    $stmt->execute([$userId, $requestId, $action, $description]);
}
