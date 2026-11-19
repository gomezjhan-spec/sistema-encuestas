# Entrega 1 - documentación técnica

La versión editable del informe se encuentra en el documento principal entregado al equipo. Este archivo complementa la aplicación con alcance, estructura técnica y trazabilidad.

## Requisitos cubiertos por la versión
1. Autenticación con roles administrador, ventanilla, encuestador, calidad y enrutador.
2. Registro de nombres, apellidos, barrio, comuna, celular y dirección, con punto de atención.
3. Captura de latitud y longitud mediante mapa interactivo o geolocalización.
4. Bitácora diaria de solicitudes con filtro de fecha y consolidación de todos los puntos.

## Modelo de datos
- `roles` 1:N `usuarios`.
- `usuarios` 1:N `solicitudes`.
- `puntos_atencion` 1:N `solicitudes`.
- `usuarios` 1:N `bitacora`.
- `solicitudes` 1:N `bitacora` (relación opcional para eventos generales).

## Herramientas y evidencias
Registrar en el informe las capturas reales de Git/GitHub y de GitHub Actions o de otra herramienta DevOps que el equipo haya usado en clase. La existencia de un archivo de workflow no demuestra por sí sola una ejecución exitosa.
