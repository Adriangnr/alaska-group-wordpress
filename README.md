# Alaska Group — migración a WordPress

Este directorio contiene la migración del sitio original (Angular, carpeta
`../alaska-refrigeracion`) a un **tema de WordPress clásico**, hecho a medida.
El proyecto Angular original **no fue modificado** y sigue funcionando de
forma independiente.

## Qué se migró

| Angular (original)                          | WordPress (este tema)                                    |
|----------------------------------------------|-----------------------------------------------------------|
| `pages/home`                                  | `front-page.php` (página de inicio)                        |
| `pages/services`                              | `page-servicios.php`                                       |
| `pages/about`                                 | `page-nosotros.php`                                         |
| `pages/contact` (formulario simulado)         | `page-contacto.php` + envío real por email (AJAX + `wp_mail`) |
| `pages/work-detail` + `data/works.ts`         | Custom Post Type **"Trabajo"** (`single-trabajo.php`) con campos editables |
| `shared/work-card`, `shared/works-carousel`   | `template-parts/content-work-card.php` + JS en `assets/js/main.js` |
| `layout/header`, `layout/footer`              | `header.php`, `footer.php`                                  |
| `styles.scss` + estilos de cada componente    | `assets/css/main.css` (una sola hoja de estilos)            |

Los 3 trabajos de ejemplo (cámara frigorífica, climatización de oficinas,
mantenimiento de compresores) se crean automáticamente como posts editables
del tipo "Trabajo" la primera vez que se activa el tema, junto con sus fotos.

## Instalación

1. Comprimí la carpeta `alaska-group` (la del tema, dentro de este directorio)
   en un archivo `alaska-group.zip`. Importante: el `.zip` debe contener la
   carpeta `alaska-group` en su raíz, no los archivos sueltos.
2. En WordPress: **Apariencia → Temas → Añadir nuevo → Subir tema**, seleccioná
   el `.zip` y activá el tema.
3. Al activarse, el tema automáticamente:
   - crea las páginas **Servicios**, **Nosotros** y **Contacto** (con las
     URLs `/servicios`, `/nosotros`, `/contacto`);
   - crea los 3 trabajos de ejemplo con sus imágenes;
   - registra el tipo de contenido "Trabajo" con la URL `/trabajos/{slug}`.
4. Andá a **Ajustes → Enlaces permanentes**. En una instalación nueva de
   WordPress, esta pantalla viene por defecto en **"Plano"** (`?p=123`), y con
   esa opción **ninguna URL bonita funciona** (`/servicios/`, `/trabajos/slug`,
   etc. dan 404), sin importar cuántas veces guardes la pantalla sin cambiar
   nada. Elegí explícitamente la opción **"Nombre de la entrada"** (o
   cualquier estructura que no sea "Plano") y recién ahí guardá los cambios.
5. Listo — no hace falta crear ni asignar ninguna página adicional. La home
   la sirve automáticamente `front-page.php`.

### Si después de instalar seguís viendo 404 en /servicios, /nosotros, /trabajos/...

Casi siempre es el paso 4: revisá **Ajustes → Enlaces permanentes** y
confirmá que NO esté en "Plano". Si ya está en "Nombre de la entrada" y
seguís viendo 404, es un problema de Apache y no de WordPress: el archivo
`.htaccess` en la raíz del sitio (mismo nivel que `wp-config.php`) necesita
el bloque estándar

```apache
# BEGIN WordPress
<IfModule mod_rewrite.c>
RewriteEngine On
RewriteRule .* - [E=HTTP_AUTHORIZATION:%{HTTP:Authorization}]
RewriteBase /
RewriteRule ^index\.php$ - [L]
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule . /index.php [L]
</IfModule>
# END WordPress
```

WordPress genera este bloque solo automáticamente al guardar los enlaces
permanentes, pero eso requiere que `mod_rewrite` esté habilitado en Apache y
que el archivo `.htaccess` sea escribible por el servidor. Si usás la imagen
Docker oficial de WordPress (ver más abajo), el módulo `mod_rewrite` está
disponible pero el `.htaccess` puede quedar vacío tras la instalación; en ese
caso pegá el bloque de arriba a mano en `.htaccess`.

## Desarrollo local con Docker

Este directorio incluye un `docker-compose.yml` con WordPress + MySQL,
montando la carpeta `alaska-group` directo como tema (los cambios en PHP/CSS/JS
se ven al instante, sin rebuild).

```
docker compose up -d
```

Después entrá a `http://localhost:8080`, completá el instalador de
WordPress, activá el tema "Alaska Group" y seguí los pasos 4 y 5 de más
arriba (enlaces permanentes). Para parar: `docker compose down` (los datos
quedan en volúmenes). Para arrancar de cero: `docker compose down -v`.

## Cómo editar contenido

- **Trabajos realizados**: **Escritorio → Trabajos**. Cada trabajo tiene un
  título, una imagen destacada (la foto principal de la galería) y un cuadro
  "Detalles del trabajo" con categoría, descripción corta, resumen, sector,
  alcance del trabajo (un ítem por línea) y las 3 etiquetas de "pasos" que se
  muestran rotando en la tarjeta (íconos de lupa, llave y check, en ese orden).
- **Textos de Servicios / Nosotros / Home**: son bloques de contenido fijo
  pensados para esta marca, igual que en la versión Angular. Están en los
  archivos `front-page.php`, `page-servicios.php` y `page-nosotros.php` como
  arrays de PHP al principio de cada archivo — se editan ahí directamente.
- **Teléfono, WhatsApp y email**: se definen en un solo lugar, al principio de
  `functions.php` (constantes `ALASKA_PHONE_DISPLAY`, `ALASKA_PHONE_LINK`,
  `ALASKA_WHATSAPP_NUMBER`, `ALASKA_EMAIL`).

## Formulario de contacto

A diferencia de la versión Angular (que sólo simulaba el envío con un
`setTimeout`), el formulario de WordPress **envía un email real** al
administrador del sitio (`wp_mail`, vía `admin-ajax.php` con nonce y
validación tanto en el navegador como en el servidor). No requiere ningún
plugin adicional, pero para que la entrega de emails sea confiable en
hosting real se recomienda instalar un plugin SMTP (por ejemplo WP Mail SMTP).

## Requisitos

- WordPress 6.x, PHP 7.4 o superior.
- No depende de ningún plugin de terceros.
