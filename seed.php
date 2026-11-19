<?php
// Ejecutar una sola vez después de importar database/schema.sql. Luego eliminar este archivo.
require_once __DIR__.'/config/database.php';
$pdo=db();
$accounts=[
 ['Admin','Sistema','admin','admin@encuestas.local','administrador'],
 ['Usuario','Ventanilla','ventanilla','ventanilla@encuestas.local','ventanilla'],
 ['Usuario','Encuestador','encuestador','encuestador@encuestas.local','encuestador'],
 ['Usuario','Calidad','calidad','calidad@encuestas.local','calidad'],
 ['Usuario','Enrutador','enrutador','enrutador@encuestas.local','enrutador'],
];
foreach($accounts as [$n,$a,$u,$mail,$role]){
 $check=$pdo->prepare('SELECT id_usuario FROM usuarios WHERE usuario=?');$check->execute([$u]);
 if(!$check->fetch()){
  $r=$pdo->prepare('SELECT id_rol FROM roles WHERE nombre=?');$r->execute([$role]);$roleId=(int)$r->fetchColumn();
  $ins=$pdo->prepare('INSERT INTO usuarios(id_rol,nombres,apellidos,usuario,correo,password_hash,estado) VALUES(?,?,?,?,?,?,\'activo\')');
  $ins->execute([$roleId,$n,$a,$u,$mail,password_hash('Cambiar123!',PASSWORD_DEFAULT)]);
 }
}
echo 'Usuarios iniciales creados (si no existían). Contraseña temporal: Cambiar123! Cambiarla inmediatamente desde el entorno seguro. Elimina seed.php después de ejecutarlo.';
