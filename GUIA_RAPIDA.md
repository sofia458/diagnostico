# 🚀 Guía Rápida de Inicio

## ⚡ Instalación Rápida (5 minutos)

### 1. Preparar XAMPP
```bash
1. Abre XAMPP Control Panel
2. Inicia "Apache" ✅
3. Inicia "MySQL" ✅
```

### 2. Descargar Base de Datos
```bash
# Opción A: Usando Git
git clone https://github.com/datacharmer/test_db.git
cd test_db
mysql -u root -p < employees.sql

# Opción B: Descarga manual
# Ir a: https://github.com/datacharmer/test_db
# Descargar ZIP y extraer
# Importar employees.sql usando phpMyAdmin
```

### 3. Copiar Archivos del Proyecto
```bash
Copiar carpeta "gestion-empleados" a:
Windows: C:\xampp\htdocs\
Mac/Linux: /Applications/XAMPP/htdocs/
```

### 4. Verificar Instalación
```
Abrir navegador:
http://localhost/gestion-empleados/test_connection.php
```

### 5. ¡Listo!
```
Si todos los tests pasan ✅, accede al sistema:
http://localhost/gestion-empleados/
```

---

## 📊 Características Principales

### Reportes Disponibles
1. **Listado de Empleados** - Con filtro por departamento
2. **Managers Actuales** - Por cada departamento
3. **Top Salarios** - Mejor pagado por departamento
4. **Contrataciones Anuales** - Tendencia temporal
5. **Stats Departamentales** - Empleados y salarios promedio

### Gráficos Interactivos
1. **Género** - Distribución M/F (Pie Chart)
2. **Top 10 Pagados** - Barras horizontales
3. **Salarios Promedio** - Barras verticales
4. **Brecha Salarial** - Comparativo por depto.

---

## 🔧 Configuración

### Credenciales por Defecto
```php
Host: localhost
Base de Datos: employees
Usuario: root
Password: (vacío)
```

### Cambiar Configuración
Editar: `config/database.php`
```php
private $host = "localhost";
private $db_name = "employees";
private $username = "root";
private $password = "tu_password";
```

---

## ❗ Solución Rápida de Problemas

### ❌ Error: "No se puede conectar"
```
✅ Verificar que MySQL esté corriendo en XAMPP
✅ Confirmar que existe la BD "employees"
✅ Revisar credenciales en config/database.php
```

### ❌ Página en blanco
```
✅ Verificar que Apache esté corriendo
✅ Revisar la URL: http://localhost/gestion-empleados/
✅ Abrir consola del navegador (F12) para ver errores
```

### ❌ "Call to undefined function..."
```
✅ Verificar versión de PHP (mínimo 7.4)
✅ Habilitar extensión PDO en php.ini
✅ Reiniciar Apache en XAMPP
```

### ❌ Gráficos no se muestran
```
✅ Verificar conexión a internet (Chart.js CDN)
✅ Revisar consola del navegador (F12)
✅ Probar con otro navegador
```

---

## 📁 Estructura del Proyecto

```
gestion-empleados/
├── 📄 index.php              ← Página principal
├── 📄 test_connection.php    ← Test de conexión
├── 📄 README.md              ← Documentación completa
├── 📄 GUIA_RAPIDA.md         ← Esta guía
├── 📄 .htaccess              ← Configuración Apache
├── 📁 config/
│   └── 📄 database.php       ← Configuración BD
├── 📁 classes/
│   └── 📄 Employee.php       ← Lógica de negocio
├── 📁 api/
│   └── 📄 employees.php      ← API REST
└── 📁 assets/
    ├── 📁 css/
    │   └── 📄 style.css      ← Estilos
    └── 📁 js/
        └── 📄 main.js        ← JavaScript
```

---

## 🎯 Flujo de Uso

### Para Reportes
```
1. Click en botón "Reportes" (nav superior)
2. Seleccionar tipo de reporte (tarjeta)
3. Click "Ver Reporte"
4. Los datos aparecen en tabla debajo
5. (Opcional) Usar filtros disponibles
```

### Para Gráficos
```
1. Click en botón "Gráficos" (nav superior)
2. Seleccionar tipo de gráfico (tarjeta)
3. Click "Generar Gráfico"
4. Gráfico interactivo aparece debajo
5. Hover sobre elementos para detalles
```

---

## 💡 Tips y Trucos

### Rendimiento
- Primera carga puede tardar (300k+ registros)
- Los gráficos usan caché del navegador
- Limite de 1000 empleados en listado completo

### Navegadores Recomendados
- ✅ Chrome/Edge (Mejor rendimiento)
- ✅ Firefox
- ✅ Safari
- ⚠️ IE11 no soportado

### Base de Datos
- La BD "employees" es oficial de MySQL
- Contiene datos históricos 1985-2002
- Perfecta para aprendizaje y testing
- ~160MB de espacio requerido

---

## 📞 Soporte

### Recursos Útiles
- **XAMPP**: https://www.apachefriends.org/
- **BD Employees**: https://github.com/datacharmer/test_db
- **PHP Manual**: https://www.php.net/manual/es/
- **Chart.js**: https://www.chartjs.org/

### Checklist Pre-Soporte
- [ ] XAMPP Apache corriendo
- [ ] XAMPP MySQL corriendo
- [ ] Base de datos "employees" existe
- [ ] Archivos en htdocs/gestion-empleados/
- [ ] test_connection.php pasa todos los tests
- [ ] Revisé consola del navegador (F12)

---

## 🎓 Aprendizaje

### Conceptos Cubiertos
- ✅ Conexión PHP-MySQL con PDO
- ✅ Consultas SQL complejas (JOIN, GROUP BY)
- ✅ API REST con PHP
- ✅ AJAX con Fetch API
- ✅ Visualización de datos (Chart.js)
- ✅ Diseño responsivo (CSS Grid/Flexbox)
- ✅ Seguridad básica web

### Posibles Extensiones
- 🔄 Añadir paginación
- 🔍 Búsqueda avanzada
- 📤 Exportar a Excel/PDF
- 🔐 Sistema de login
- 📊 Más tipos de gráficos
- 🌐 Multiidioma

---

**¡Proyecto Listo para Usarse! 🎉**

Si tienes problemas, consulta el README.md completo o ejecuta test_connection.php
