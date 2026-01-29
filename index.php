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
        <!-- Header Section -->
        <header class="hero">
            <div class="hero-content">
                <h1 class="hero-title">Sistema de Gestión</h1>
                <p class="hero-subtitle">Base de Datos de Empleados</p>
            </div>
            <div class="hero-decoration"></div>
        </header>

        <!-- Navigation -->
        <nav class="main-nav">
            <button class="nav-btn active" data-section="reportes">
                <span class="nav-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M3 3v18h18"/>
                        <path d="M18 17V9"/>
                        <path d="M13 17V5"/>
                        <path d="M8 17v-3"/>
                    </svg>
                </span>
                <span>Reportes</span>
            </button>
            <button class="nav-btn" data-section="graficos">
                <span class="nav-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M3 3v18h18"/>
                        <path d="M7 16l4-4 4 4 6-6"/>
                    </svg>
                </span>
                <span>Gráficos</span>
            </button>
        </nav>

        <!-- Reports Section -->
        <section id="reportes" class="content-section active">
            <div class="section-header">
                <h2>Reportes Ejecutivos</h2>
                <p>Análisis detallado de información de empleados</p>
            </div>

            <div class="reports-grid">
                <!-- Report Card 1 -->
                <article class="report-card" data-report="1">
                    <div class="card-icon">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                            <circle cx="9" cy="7" r="4"/>
                            <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                        </svg>
                    </div>
                    <h3>Listado de Empleados</h3>
                    <p>Información completa de todos los empleados con opción de filtrado</p>
                    <button class="btn-primary" onclick="loadReport(1)">Ver Reporte</button>
                </article>

                <!-- Report Card 2 -->
                <article class="report-card" data-report="2">
                    <div class="card-icon">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                            <circle cx="12" cy="7" r="4"/>
                        </svg>
                    </div>
                    <h3>Managers por Departamento</h3>
                    <p>Identificación de managers actuales y fechas de inicio</p>
                    <button class="btn-primary" onclick="loadReport(2)">Ver Reporte</button>
                </article>

                <!-- Report Card 3 -->
                <article class="report-card" data-report="3">
                    <div class="card-icon">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <line x1="12" y1="1" x2="12" y2="23"/>
                            <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/>
                        </svg>
                    </div>
                    <h3>Mejores Salarios</h3>
                    <p>Empleado mejor pagado en cada departamento</p>
                    <button class="btn-primary" onclick="loadReport(3)">Ver Reporte</button>
                </article>

                <!-- Report Card 4 -->
                <article class="report-card" data-report="4">
                    <div class="card-icon">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                            <line x1="16" y1="2" x2="16" y2="6"/>
                            <line x1="8" y1="2" x2="8" y2="6"/>
                            <line x1="3" y1="10" x2="21" y2="10"/>
                        </svg>
                    </div>
                    <h3>Contrataciones por Año</h3>
                    <p>Total de empleados contratados anualmente</p>
                    <button class="btn-primary" onclick="loadReport(4)">Ver Reporte</button>
                </article>

                <!-- Report Card 5 -->
                <article class="report-card" data-report="5">
                    <div class="card-icon">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
                            <polyline points="9 22 9 12 15 12 15 22"/>
                        </svg>
                    </div>
                    <h3>Estadísticas por Departamento</h3>
                    <p>Total de empleados y salario promedio por departamento</p>
                    <button class="btn-primary" onclick="loadReport(5)">Ver Reporte</button>
                </article>
            </div>

            <!-- Report Results Container -->
            <div id="reportResult" class="report-result"></div>
        </section>

        <!-- Charts Section -->
        <section id="graficos" class="content-section">
            <div class="section-header">
                <h2>Análisis Gráfico</h2>
                <p>Visualización interactiva de datos</p>
            </div>

            <div class="charts-grid">
                <!-- Chart Card 1 -->
                <article class="chart-card" data-chart="1">
                    <div class="card-icon">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M21.21 15.89A10 10 0 1 1 8 2.83"/>
                            <path d="M22 12A10 10 0 0 0 12 2v10z"/>
                        </svg>
                    </div>
                    <h3>Distribución por Género</h3>
                    <p>Comparación de empleados masculinos vs femeninos</p>
                    <button class="btn-secondary" onclick="loadChart(1)">Generar Gráfico</button>
                </article>

                <!-- Chart Card 2 -->
                <article class="chart-card" data-chart="2">
                    <div class="card-icon">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M3 3v18h18"/>
                            <path d="M18 17V9"/>
                            <path d="M13 17V5"/>
                            <path d="M8 17v-3"/>
                        </svg>
                    </div>
                    <h3>Top 10 Mejor Pagados</h3>
                    <p>Empleados con los salarios más altos</p>
                    <button class="btn-secondary" onclick="loadChart(2)">Generar Gráfico</button>
                </article>

                <!-- Chart Card 3 -->
                <article class="chart-card" data-chart="3">
                    <div class="card-icon">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M3 3v18h18"/>
                            <path d="M7 16l4-4 4 4 6-6"/>
                        </svg>
                    </div>
                    <h3>Salarios Promedio</h3>
                    <p>Comparación de salarios promedio por departamento</p>
                    <button class="btn-secondary" onclick="loadChart(3)">Generar Gráfico</button>
                </article>

                <!-- Chart Card 4 -->
                <article class="chart-card" data-chart="4">
                    <div class="card-icon">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M3 3v18h18"/>
                            <path d="M18 17V9"/>
                            <path d="M13 17V5"/>
                            <path d="M8 17v-3"/>
                            <circle cx="18" cy="9" r="2"/>
                            <circle cx="13" cy="5" r="2"/>
                            <circle cx="8" cy="14" r="2"/>
                        </svg>
                    </div>
                    <h3>Brecha Salarial</h3>
                    <p>Diferencia entre salarios máximos y mínimos</p>
                    <button class="btn-secondary" onclick="loadChart(4)">Generar Gráfico</button>
                </article>
            </div>

            <!-- Chart Container -->
            <div id="chartContainer" class="chart-container">
                <canvas id="myChart"></canvas>
            </div>
        </section>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <p>&copy; 2026 Sistema de Gestión de Empleados | Proyecto Académico</p>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="assets/js/main.js"></script>
</body>
</html>