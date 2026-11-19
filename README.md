# Sistema de Gestión de Encuestas

Aplicación académica en PHP y MySQL para la primera entrega de Desarrollo de Software II.

## Requisitos
- PHP 8.1 o superior con extensiones PDO y PDO MySQL.
- MySQL 5.7+ o MariaDB compatible.
- Laragon, Visual Studio Code y HeidiSQL.
- Conexión a Internet para cargar Bootstrap, Leaflet y los mosaicos de OpenStreetMap.

## Instalación en Laragon
1. Copiar la carpeta `SistemaEncuestas` a `C:\laragon\www\`.
2. Iniciar Apache y MySQL desde Laragon.
3. Abrir HeidiSQL y ejecutar el contenido de `database/schema.sql`.
4. Revisar `config/config.php`. Por defecto usa host `127.0.0.1`, base `sistema_encuestas`, usuario `root` y contraseña vacía, configuración habitual de Laragon.
5. Abrir `http://localhost/SistemaEncuestas/seed.php` una sola vez para crear usuarios de demostración.
6. **Eliminar `seed.php` inmediatamente después de ejecutarlo.**
7. Entrar a `http://localhost/SistemaEncuestas/`.

## Usuarios de demostración
Todos tienen contraseña temporal `Cambiar123!`:

| Perfil | Usuario | Correo |
|---|---|---|
| Administrador | admin | admin@encuestas.local |
| Ventanilla | ventanilla | ventanilla@encuestas.local |
| Encuestador | encuestador | encuestador@encuestas.local |
| Calidad | calidad | calidad@encuestas.local |
| Enrutador | enrutador | enrutador@encuestas.local |

Son cuentas locales de demostración. No publicarlas en un servidor real. Cambiar las contraseñas antes de cualquier despliegue.

## Funcionalidades implementadas
- Inicio y cierre de sesión con cinco perfiles.
- Control de acceso por perfil.
- Creación de usuarios por el administrador.
- Registro de solicitudes con información personal y territorial.
- Selección de coordenadas en mapa Leaflet/OpenStreetMap o geolocalización del navegador.
- Consulta de solicitudes.
- Bitácora diaria consolidada para administrador y enrutador.
- Registro de eventos de acceso y creación.

## Notas de alcance
- La lista de puntos se carga con las ocho comunas enumeradas explícitamente en el enunciado. El mismo documento también menciona cinco puntos más oficina principal; confirmar esta diferencia con el docente antes de cerrar el catálogo.
- Los barrios y corregimientos se capturan como texto en esta primera versión. No se afirma que exista un catálogo oficial completo cargado.
- El mapa necesita Internet para cargar los mosaicos de OpenStreetMap. Las coordenadas se guardan en MySQL.
- El módulo de rutas, asignación de encuestadores, PDF y dashboard analítico corresponde a la siguiente entrega.
- GitHub Actions contiene una verificación de sintaxis PHP. La ejecución real debe evidenciarse en la pestaña Actions del repositorio.

## Estructura
- `config/`: configuración y conexión PDO.
- `database/schema.sql`: estructura y datos base.
- `includes/`: autenticación, seguridad y componentes comunes.
- `assets/`: estilos y JavaScript del mapa.
- `docs/`: documentación de entrega y plan de pruebas.
- `.github/workflows/`: integración continua.

## Git inicial
```bash
git init
git add .
git commit -m "Entrega 1: estructura inicial del sistema de encuestas"
git branch -M main
git remote add origin https://github.com/USUARIO/REPOSITORIO.git
git push -u origin main
```

## Seguridad y uso responsable
La aplicación incluye consultas preparadas PDO, hash de contraseñas, regeneración de sesión, protección CSRF en formularios y escape HTML de valores. Antes de producción se requiere HTTPS, política de copias de seguridad, gestión de secretos fuera del repositorio, revisión de privacidad y pruebas adicionales.
