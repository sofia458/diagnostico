# 📊 Sistema de Gestión de Empleados

Sistema completo de gestión y análisis de base de datos de empleados desarrollado con PHP, MySQL y JavaScript.

## 🎯 Características

### Reportes Ejecutivos
1. **Listado de Empleados** - Visualización completa con filtros por departamento
2. **Managers por Departamento** - Identificación de managers actuales
3. **Mejores Salarios** - Empleado mejor pagado por departamento
4. **Contrataciones por Año** - Análisis temporal de contrataciones
5. **Estadísticas por Departamento** - Total de empleados y salario promedio

### Gráficos Interactivos
1. **Distribución por Género** - Gráfico de pastel
2. **Top 10 Mejor Pagados** - Gráfico de barras horizontal
3. **Salarios Promedio** - Gráfico de barras vertical
4. **Brecha Salarial** - Análisis comparativo por departamento

## 🚀 Instalación

### Requisitos Previos
- XAMPP (Apache + MySQL + PHP 7.4 o superior)
- Navegador web moderno
- Base de datos "employees" de MySQL

### Paso 1: Instalar XAMPP
1. Descarga XAMPP desde: https://www.apachefriends.org/
2. Instala XAMPP en tu computadora
3. Inicia Apache y MySQL desde el panel de control de XAMPP

### Paso 2: Configurar la Base de Datos

#### Opción A: Usar la base de datos employees oficial
1. Descarga la base de datos employees desde: https://github.com/datacharmer/test_db
2. Descomprime el archivo
3. Abre una terminal/cmd y navega a la carpeta descomprimida
4. Ejecuta:
```bash
cd test_db
mysql -u root -p < employees.sql
```

#### Opción B: Crear la base de datos manualmente
1. Abre phpMyAdmin: http://localhost/phpmyadmin
2. Crea una nueva base de datos llamada "employees"
3. Importa el archivo SQL proporcionado o crea las tablas necesarias

### Estructura de Tablas Requerida

La base de datos debe contener las siguientes tablas:

- **employees** (emp_no, birth_date, first_name, last_name, gender, hire_date)
- **departments** (dept_no, dept_name)
- **dept_emp** (emp_no, dept_no, from_date, to_date)
- **dept_manager** (emp_no, dept_no, from_date, to_date)
- **titles** (emp_no, title, from_date, to_date)
- **salaries** (emp_no, salary, from_date, to_date)

### Paso 3: Instalar el Proyecto

1. **Copia los archivos del proyecto** a la carpeta `htdocs` de XAMPP:
   - Windows: `C:\xampp\htdocs\gestion-empleados\`
   - Mac/Linux: `/Applications/XAMPP/htdocs/gestion-empleados/`

2. **Estructura de carpetas del proyecto:**
```
gestion-empleados/
│
├── index.php                 # Página principal
├── config/
│   └── database.php         # Configuración de BD
├── classes/
│   └── Employee.php         # Clase de empleados
├── api/
│   └── employees.php        # API REST
└── assets/
    ├── css/
    │   └── style.css        # Estilos
    └── js/
        └── main.js          # JavaScript
```

### Paso 4: Configurar la Conexión a la Base de Datos

Edita el archivo `config/database.php` y ajusta las credenciales si es necesario:

```php
private $host = "localhost";
private $db_name = "employees";
private $username = "root";
private $password = "";  // Deja vacío si no tienes contraseña
```

### Paso 5: Ejecutar el Proyecto

1. Asegúrate de que Apache y MySQL estén corriendo en XAMPP
2. Abre tu navegador web
3. Navega a: `http://localhost/gestion-empleados/`
4. ¡El sistema debería estar funcionando!

## 🔧 Solución de Problemas

### Error: "No se pudo conectar a la base de datos"
- Verifica que MySQL esté corriendo en XAMPP
- Confirma que la base de datos "employees" existe
- Revisa las credenciales en `config/database.php`

### Error: "Call to undefined function..."
- Asegúrate de tener PHP 7.4 o superior
- Verifica que las extensiones PDO estén habilitadas en php.ini

### Las gráficas no se muestran
- Verifica tu conexión a internet (Chart.js se carga desde CDN)
- Revisa la consola del navegador (F12) para ver errores

### Los reportes no cargan datos
- Abre `http://localhost/gestion-empleados/api/employees.php?action=report1` directamente
- Si ves JSON, el API funciona
- Si ves errores, revisa la configuración de la base de datos

## 📱 Uso del Sistema

### Navegación
- Usa los botones superiores para cambiar entre **Reportes** y **Gráficos**
- Cada sección muestra tarjetas con las diferentes opciones disponibles

### Reportes
1. Click en "Ver Reporte" en la tarjeta deseada
2. Los datos se cargarán en una tabla debajo
3. Para el reporte de empleados, puedes filtrar por departamento

### Gráficos
1. Click en "Generar Gráfico" en la tarjeta deseada
2. El gráfico interactivo se mostrará debajo
3. Puedes pasar el mouse sobre los elementos para ver detalles

## 🎨 Características de Diseño

- **Diseño Responsivo**: Funciona en desktop, tablet y móvil
- **Animaciones Suaves**: Transiciones elegantes entre secciones
- **Paleta de Colores Profesional**: Azul marino, dorado y cobre
- **Tipografía Premium**: Playfair Display + Work Sans
- **Gráficos Interactivos**: Powered by Chart.js

## 📊 Tecnologías Utilizadas

- **Frontend**: HTML5, CSS3, JavaScript (ES6+)
- **Backend**: PHP 7.4+
- **Base de Datos**: MySQL 5.7+
- **Librerías**: Chart.js 3.x
- **Servidor**: Apache (XAMPP)

## 👥 Equipo de Desarrollo

Este proyecto fue desarrollado como parte de un trabajo académico para evaluar conocimientos en:
- Programación (PHP, JavaScript)
- Base de Datos (MySQL)
- Sistemas Operativos (XAMPP)
- Estadística (Análisis de datos)
- Inteligencia Artificial (Visualización de datos)

## 📄 Licencia

Este proyecto es de uso académico.

## 🆘 Soporte

Si encuentras algún problema:
1. Revisa la sección de "Solución de Problemas"
2. Verifica que todos los archivos estén en su lugar
3. Confirma que XAMPP esté corriendo correctamente
4. Revisa la consola del navegador para errores JavaScript

---

**Desarrollado con ❤️ para propósitos educativos**
