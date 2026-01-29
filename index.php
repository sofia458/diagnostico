<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Gestión de Empleados</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=Work+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <header class="hero">
            <div class="hero-content">
                <h1 class="hero-title">Sistema de Gestión</h1>
                <p class="hero-subtitle">Base de Datos de Empleados</p>
            </div>
            <div class="hero-decoration"></div>
        </header>

        <nav class="main-nav">
            <button class="nav-btn active" data-section="reportes">
                <span class="nav-icon">📊</span>
                <span>Reportes</span>
            </button>
            <button class="nav-btn" data-section="graficos">
                <span class="nav-icon">📈</span>
                <span>Gráficos</span>
            </button>
        </nav>

        <!-- SECCIÓN DE REPORTES -->
        <section id="reportes" class="content-section active">
            <div class="section-header">
                <h2>Reportes Ejecutivos</h2>
                <p>Análisis detallado de información de empleados</p>
            </div>

            <div class="reports-grid">
                <div class="report-card" data-report="1">
                    <div class="card-icon">👥</div>
                    <h3>Listado de Empleados</h3>
                    <p>Información completa de todos los empleados con opción de filtrado</p>
                    <button class="btn-primary" onclick="loadReport(1)">Ver Reporte</button>
                </div>

                <div class="report-card" data-report="2">
                    <div class="card-icon">👔</div>
                    <h3>Managers por Departamento</h3>
                    <p>Identificación de managers actuales y fechas de inicio</p>
                    <button class="btn-primary" onclick="loadReport(2)">Ver Reporte</button>
                </div>

                <div class="report-card" data-report="3">
                    <div class="card-icon">💰</div>
                    <h3>Mejores Salarios</h3>
                    <p>Empleado mejor pagado en cada departamento</p>
                    <button class="btn-primary" onclick="loadReport(3)">Ver Reporte</button>
                </div>

                <div class="report-card" data-report="4">
                    <div class="card-icon">📅</div>
                    <h3>Contrataciones por Año</h3>
                    <p>Total de empleados contratados anualmente</p>
                    <button class="btn-primary" onclick="loadReport(4)">Ver Reporte</button>
                </div>

                <div class="report-card" data-report="5">
                    <div class="card-icon">🏢</div>
                    <h3>Estadísticas por Departamento</h3>
                    <p>Total de empleados y salario promedio por departamento</p>
                    <button class="btn-primary" onclick="loadReport(5)">Ver Reporte</button>
                </div>
            </div>

            <div id="reportResult" class="report-result"></div>
        </section>

        <!-- SECCIÓN DE GRÁFICOS -->
        <section id="graficos" class="content-section">
            <div class="section-header">
                <h2>Análisis Gráfico</h2>
                <p>Visualización interactiva de datos</p>
            </div>

            <div class="charts-grid">
                <div class="chart-card" data-chart="1">
                    <div class="card-icon">🥧</div>
                    <h3>Distribución por Género</h3>
                    <p>Comparación de empleados masculinos vs femeninos</p>
                    <button class="btn-secondary" onclick="loadChart(1)">Generar Gráfico</button>
                </div>

                <div class="chart-card" data-chart="2">
                    <div class="card-icon">📊</div>
                    <h3>Top 10 Mejor Pagados</h3>
                    <p>Empleados con los salarios más altos</p>
                    <button class="btn-secondary" onclick="loadChart(2)">Generar Gráfico</button>
                </div>

                <div class="chart-card" data-chart="3">
                    <div class="card-icon">📈</div>
                    <h3>Salarios Promedio</h3>
                    <p>Comparación de salarios promedio por departamento</p>
                    <button class="btn-secondary" onclick="loadChart(3)">Generar Gráfico</button>
                </div>

                <div class="chart-card" data-chart="4">
                    <div class="card-icon">💹</div>
                    <h3>Brecha Salarial</h3>
                    <p>Diferencia entre salarios máximos y mínimos</p>
                    <button class="btn-secondary" onclick="loadChart(4)">Generar Gráfico</button>
                </div>
            </div>

            <div id="chartContainer" class="chart-container">
                <canvas id="myChart"></canvas>
            </div>
        </section>
    </div>

    <footer class="footer">
        <p>&copy; 2026 Sistema de Gestión de Empleados | Proyecto Académico</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="assets/js/main.js"></script>
</body>
</html>
