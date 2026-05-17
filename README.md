# Bartel - Plataforma Web E-commerce Minimalista

Este repositorio contiene el código fuente completo y la base de datos de **Bartel**, una plataforma web Full Stack (Frontend y Backend) desarrollada desde cero con un enfoque de diseño minimalista, estético y fluido. El proyecto está concebido tanto como una tienda online de prendas exclusivas como un espacio de difusión artística y multimedia.

---

## Características Principales

* **Diseño Exclusivo y Minimalista:** Maquetación e identidad visual propia, sin empleo de plantillas prefabricadas, optimizada para ofrecer una navegación limpia.
* **Catálogo Dinámico:** Carga en tiempo real de productos desde la base de datos MySQL en la sección de tienda (`shop.php`).
* **Galería de Variantes Interactiva:** Vista de producto detallada (`producto.php`) que incluye un deslizable horizontal de miniaturas. Permite alternar la imagen principal interactivamente y seleccionar opciones de talla y color mediante formularios dinámicos exclusivos por artículo.
* **Gestión de Carrito Avanzada:** Sistema de cesta de la compra (`carrito.php`) controlado por sesiones de PHP (`$_SESSION`). Implementa claves únicas combinadas para agrupar o separar productos en el carrito según la combinación exacta de su ID, talla y color.
* **Procesamiento de Pedidos Seguro:** Módulo de tramitación (`checkout.php`) que calcula importes directamente desde el servidor (evitando manipulaciones en el cliente) y efectúa registros atómicos mediante transacciones SQL (`beginTransaction` y `commit`).
* **Sección Multimedia Avanzada:** Página dedicada a música (`musica.php`) que incorpora animaciones fluidas controladas por eventos de scroll en JavaScript (como la rotación del elemento DVD).
* **Elementos Visuales Globales:** Animaciones integradas mediante CSS puro, incluyendo un banner deslizante continuo (*marquee* de texto infinito) en el pie de página (`footer.php`) y logotipos rotativos.

---

## Tecnologías Utilizadas

* **Frontend:** HTML5, CSS3 (Animaciones, Variables nativas, Flexbox), JavaScript nativo (Manipulación del DOM, Eventos de Scroll).
* **Backend:** PHP (Estructura modular, Control de sesiones, PDO).
* **Base de Datos:** MySQL (Relacional, Transaccional).
* **Herramientas de Desarrollo:** XAMPP (Servidor local Apache y MariaDB), Git (Control de versiones) y Adobe Suite (Creación de recursos visuales y tratamiento fotográfico).

---

## Requisitos Previos

Antes de proceder con la instalación, asegúrate de tener instalado en tu equipo:
1. Un entorno de servidor local como **XAMPP**, WampServer o MAMP.
2. Un navegador web moderno (Google Chrome, Mozilla Firefox, Microsoft Edge o Safari).
3. Un cliente Git (opcional, para clonar el repositorio).

---

## Guía de Instalación y Configuración

Sigue estos pasos detallados para descargar el repositorio y poner en marcha la aplicación en tu entorno local:

### 1. Ubicación del Proyecto
Descarga el código del repositorio en formato ZIP o clónalo directamente dentro del directorio de publicación de tu servidor local. 

Si utilizas XAMPP en Windows, la ruta por defecto será:
```text
C:\xampp\htdocs\tfc_vht_bartel\
```

Si utilizas XAMPP en macOS, la ruta por defecto será:
```text
/Applications/XAMPP/htdocs/tfc_vht_bartel/
```

### 2. Iniciar el Servidor Local
Abre el Panel de Control de XAMPP (XAMPP Control Panel) e inicia los siguientes módulos de servicio:
* **Apache** (Servidor Web)
* **MySQL** (Servidor de Base de Datos)

### 3. Importación de la Base de Datos
El proyecto cuenta con un script con la estructura y datos iniciales ubicado en la ruta interna del repositorio: `/database/tfc_bartel.sql`.

Para importarlo en tu gestor:
1. Abre tu navegador e introduce la dirección de administración: `http://localhost/phpmyadmin/`.
2. En el menú lateral izquierdo, haz clic en **Nueva** para crear una nueva base de datos.
3. Asigna el nombre exacto de la base de datos (por ejemplo, `tfc_bartel`) y selecciona el cotejamiento `utf8mb4_general_ci`. Haz clic en **Crear**.
4. Una vez creada, asegúrate de tener seleccionada esa base de datos haciendo clic sobre su nombre en el menú izquierdo.
5. En el menú de pestañas superior, haz clic sobre la opción **Importar**.
6. Haz clic en el botón **Seleccionar archivo** y busca en tu ordenador el fichero SQL localizado dentro de tu proyecto en: `tfc_vht_bartel/database/tfc_bartel.sql`.
7. Desplázate hacia la parte inferior de la página y pulsa el botón **Continuar** (o **Importar** / **Go**). 
8. phpMyAdmin procesará las sentencias y mostrará un mensaje confirmando que la importación se ha ejecutado con éxito, creando las tablas `productos`, `pedidos` y `pedido_productos`.

### 4. Configuración de la Conexión en PHP
Es necesario verificar que las credenciales de acceso a la base de datos de tu servidor local coincidan con el archivo de configuración del sistema. Abre el archivo localizado en la ruta:
```text
includes/db.php
```

Asegúrate de que contiene los parámetros de conexión correspondientes a tu instalación local. Por lo general, en una instalación limpia de XAMPP, el código de conexión PDO se estructurará de la siguiente manera:

```php
<?php
$host = 'localhost';
$db   = 'tfc_bartel';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
     $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
     throw new \PDOException($e->getMessage(), (int)$e->getCode());
}
?>
```

### 5. Acceso a la Aplicación
Una vez completados los pasos anteriores, abre tu navegador web y escribe la siguiente dirección URL para acceder y probar la plataforma:

```text
http://localhost/tfc_vht_bartel/shop.php
```

---

## Notas de Desarrollo y Mantenimiento

* **Estructura de Carpetas:** Las imágenes de los productos (`camisetaROJA.png`, `camisetaVERDE.png`, `camisetaMARILLA.png`, etc.) e identidades corporativas deben guardarse siempre dentro de la ruta `assets/images/`.
* **Actualización de Componentes:** Las cabeceras y los pies de página están modularizados en los archivos `includes/header.php` e `includes/footer.php` respectivamente. Cualquier inserción global de estilos o scripts transversales debe realizarse en estos ficheros para que se propague de forma automática por todo el sitio web.
* **Limpieza de Caché:** Durante los procesos de modificación estética o sustitución de imágenes físicas con el mismo nombre, se recomienda forzar la recarga del navegador (`Cmd + Shift + R` en Mac o `Ctrl + F5` en Windows) para invalidar la caché local y visualizar los cambios en tiempo real.