// Variables globales
let currentChart = null;
let currentReportData = null;
let currentPage = 1;
const rowsPerPage = 20;

// Navegación entre secciones
document.querySelectorAll('.nav-btn').forEach(btn => {
    btn.addEventListener('click', function() {
        // Actualizar botones activos
        document.querySelectorAll('.nav-btn').forEach(b => b.classList.remove('active'));
        this.classList.add('active');

        // Mostrar sección correspondiente
        const section = this.dataset.section;
        document.querySelectorAll('.content-section').forEach(s => s.classList.remove('active'));
        document.getElementById(section).classList.add('active');

        // Limpiar resultados previos
        document.getElementById('reportResult').innerHTML = '';
        currentReportData = null;
        currentPage = 1;

        if (currentChart) {
            currentChart.destroy();
            currentChart = null;
        }
    });
});

// Función para cargar reportes
function loadReport(reportNumber) {
    const resultDiv = document.getElementById('reportResult');
    resultDiv.innerHTML = '<div class="loading-container"><div class="loading"></div><p class="loading-text">Cargando datos...</p></div>';

    currentPage = 1;
    let action = 'report' + reportNumber;
    let url = 'api/employees.php?action=' + action;

    fetch(url)
        .then(response => response.json())
        .then(result => {
            if (result.success) {
                currentReportData = {
                    number: reportNumber,
                    data: result.data,
                    departments: result.departments
                };

                displayReport(reportNumber, result.data, result.departments);
            } else {
                resultDiv.innerHTML = '<p class="error-message">Error al cargar los datos: ' + result.error + '</p>';
            }
        })
        .catch(error => {
            resultDiv.innerHTML = '<p class="error-message">Error de conexión: ' + error + '</p>';
        });
}

// Función principal para mostrar reportes
function displayReport(reportNumber, data, departments) {
    switch(reportNumber) {
        case 1:
            displayReport1(data, departments);
            break;
        case 2:
            displayReport2(data);
            break;
        case 3:
            displayReport3(data);
            break;
        case 4:
            displayReport4(data);
            break;
        case 5:
            displayReport5(data);
            break;
    }
}

// Función para crear paginación
function createPagination(totalRows, currentPage, onPageChange) {
    const totalPages = Math.ceil(totalRows / rowsPerPage);

    if (totalPages <= 1) return '';

    let html = '<div class="pagination-container">';
    html += '<div class="pagination-info">';
    html += `Mostrando ${(currentPage - 1) * rowsPerPage + 1} - ${Math.min(currentPage * rowsPerPage, totalRows)} de ${totalRows} registros`;
    html += '</div>';

    html += '<div class="pagination-controls">';

    // Botón anterior
    html += `<button class="pagination-btn ${currentPage === 1 ? 'disabled' : ''}"
             onclick="${onPageChange}(${currentPage - 1})"
             ${currentPage === 1 ? 'disabled' : ''}>
             <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                 <polyline points="15 18 9 12 15 6"/>
             </svg>
             Anterior
         </button>`;

    // Números de página
    let startPage = Math.max(1, currentPage - 2);
    let endPage = Math.min(totalPages, currentPage + 2);

    if (startPage > 1) {
        html += `<button class="pagination-btn" onclick="${onPageChange}(1)">1</button>`;
        if (startPage > 2) {
            html += '<span class="pagination-ellipsis">...</span>';
        }
    }

    for (let i = startPage; i <= endPage; i++) {
        html += `<button class="pagination-btn ${i === currentPage ? 'active' : ''}"
                 onclick="${onPageChange}(${i})">${i}</button>`;
    }

    if (endPage < totalPages) {
        if (endPage < totalPages - 1) {
            html += '<span class="pagination-ellipsis">...</span>';
        }
        html += `<button class="pagination-btn" onclick="${onPageChange}(${totalPages})">${totalPages}</button>`;
    }

    // Botón siguiente
    html += `<button class="pagination-btn ${currentPage === totalPages ? 'disabled' : ''}"
             onclick="${onPageChange}(${currentPage + 1})"
             ${currentPage === totalPages ? 'disabled' : ''}>
             Siguiente
             <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                 <polyline points="9 18 15 12 9 6"/>
             </svg>
         </button>`;

    html += '</div></div>';

    return html;
}

// Función para paginar datos
function paginateData(data, page) {
    const start = (page - 1) * rowsPerPage;
    const end = start + rowsPerPage;
    return data.slice(start, end);
}

// Cambiar página
function changePage(page) {
    if (!currentReportData) return;

    currentPage = page;
    displayReport(currentReportData.number, currentReportData.data, currentReportData.departments);

    // Scroll suave hacia el reporte
    document.getElementById('reportResult').scrollIntoView({ behavior: 'smooth', block: 'start' });
}

// Reporte 1: Listado de empleados
function displayReport1(data, departments) {
    let html = '<div class="report-header">';
    html += '<h3>Listado Completo de Empleados</h3>';
    html += '</div>';

    // Filtro de departamento
    html += '<div class="filter-section">';
    html += '<label for="deptFilter">Filtrar por Departamento:</label>';
    html += '<select id="deptFilter" onchange="filterByDepartment(this.value)">';
    html += '<option value="all">Todos los Departamentos</option>';
    departments.forEach(dept => {
        html += `<option value="${dept.dept_name}">${dept.dept_name}</option>`;
    });
    html += '</select>';
    html += '</div>';

    // Tabla con paginación
    const paginatedData = paginateData(data, currentPage);

    html += '<div class="table-container">';
    html += '<table class="data-table">';
    html += '<thead><tr>';
    html += '<th>No. Empleado</th>';
    html += '<th>Nombre</th>';
    html += '<th>Apellido</th>';
    html += '<th>Fecha Nac.</th>';
    html += '<th>Género</th>';
    html += '<th>Fecha Contratación</th>';
    html += '<th>Departamento</th>';
    html += '<th>Título</th>';
    html += '<th>Salario</th>';
    html += '</tr></thead><tbody>';

    paginatedData.forEach(emp => {
        html += '<tr>';
        html += `<td>${emp.emp_no}</td>`;
        html += `<td>${emp.first_name}</td>`;
        html += `<td>${emp.last_name}</td>`;
        html += `<td>${emp.birth_date}</td>`;
        html += `<td>${emp.gender === 'M' ? 'Masculino' : 'Femenino'}</td>`;
        html += `<td>${emp.hire_date}</td>`;
        html += `<td>${emp.dept_name || 'N/A'}</td>`;
        html += `<td>${emp.title || 'N/A'}</td>`;
        html += `<td class="salary-cell">$${emp.salary ? parseInt(emp.salary).toLocaleString() : 'N/A'}</td>`;
        html += '</tr>';
    });

    html += '</tbody></table>';
    html += '</div>';

    // Paginación
    html += createPagination(data.length, currentPage, 'changePage');

    document.getElementById('reportResult').innerHTML = html;
}

// Función para filtrar por departamento
function filterByDepartment(department) {
    loadReportWithFilter(1, department);
}

function loadReportWithFilter(reportNumber, department) {
    const resultDiv = document.getElementById('reportResult');
    resultDiv.innerHTML = '<div class="loading-container"><div class="loading"></div><p class="loading-text">Filtrando datos...</p></div>';

    currentPage = 1;
    let url = `api/employees.php?action=report${reportNumber}&department=${department}`;

    fetch(url)
        .then(response => response.json())
        .then(result => {
            if (result.success) {
                currentReportData = {
                    number: reportNumber,
                    data: result.data,
                    departments: result.departments
                };
                displayReport1(result.data, result.departments);
                document.getElementById('deptFilter').value = department;
            }
        })
        .catch(error => {
            resultDiv.innerHTML = '<p class="error-message">Error: ' + error + '</p>';
        });
}

// Reporte 2: Managers por departamento
function displayReport2(data) {
    const paginatedData = paginateData(data, currentPage);

    let html = '<div class="report-header">';
    html += '<h3>Managers Actuales por Departamento</h3>';
    html += '</div>';

    html += '<div class="table-container">';
    html += '<table class="data-table">';
    html += '<thead><tr>';
    html += '<th>Departamento</th>';
    html += '<th>Manager</th>';
    html += '<th>Fecha de Inicio</th>';
    html += '</tr></thead><tbody>';

    paginatedData.forEach(manager => {
        html += '<tr>';
        html += `<td>${manager.dept_name}</td>`;
        html += `<td>${manager.manager_name}</td>`;
        html += `<td>${manager.from_date}</td>`;
        html += '</tr>';
    });

    html += '</tbody></table>';
    html += '</div>';

    html += createPagination(data.length, currentPage, 'changePage');

    document.getElementById('reportResult').innerHTML = html;
}

// Reporte 3: Mejor pagado por departamento
function displayReport3(data) {
    const paginatedData = paginateData(data, currentPage);

    let html = '<div class="report-header">';
    html += '<h3>Empleado Mejor Pagado por Departamento</h3>';
    html += '</div>';

    html += '<div class="table-container">';
    html += '<table class="data-table">';
    html += '<thead><tr>';
    html += '<th>Departamento</th>';
    html += '<th>No. Empleado</th>';
    html += '<th>Nombre Completo</th>';
    html += '<th>Salario</th>';
    html += '</tr></thead><tbody>';

    paginatedData.forEach(emp => {
        html += '<tr>';
        html += `<td>${emp.dept_name}</td>`;
        html += `<td>${emp.emp_no}</td>`;
        html += `<td>${emp.employee_name}</td>`;
        html += `<td class="salary-highlight">$${parseInt(emp.salary).toLocaleString()}</td>`;
        html += '</tr>';
    });

    html += '</tbody></table>';
    html += '</div>';

    html += createPagination(data.length, currentPage, 'changePage');

    document.getElementById('reportResult').innerHTML = html;
}

// Reporte 4: Empleados por año
function displayReport4(data) {
    const paginatedData = paginateData(data, currentPage);

    let html = '<div class="report-header">';
    html += '<h3>Total de Empleados Contratados por Año</h3>';
    html += '</div>';

    html += '<div class="table-container">';
    html += '<table class="data-table">';
    html += '<thead><tr>';
    html += '<th>Año</th>';
    html += '<th>Total de Empleados</th>';
    html += '</tr></thead><tbody>';

    paginatedData.forEach(year => {
        html += '<tr>';
        html += `<td class="year-cell">${year.year}</td>`;
        html += `<td>${parseInt(year.total_employees).toLocaleString()}</td>`;
        html += '</tr>';
    });

    html += '</tbody></table>';
    html += '</div>';

    html += createPagination(data.length, currentPage, 'changePage');

    document.getElementById('reportResult').innerHTML = html;
}

// Reporte 5: Estadísticas por departamento
function displayReport5(data) {
    const paginatedData = paginateData(data, currentPage);

    let html = '<div class="report-header">';
    html += '<h3>Estadísticas por Departamento</h3>';
    html += '</div>';

    html += '<div class="table-container">';
    html += '<table class="data-table">';
    html += '<thead><tr>';
    html += '<th>Departamento</th>';
    html += '<th>Total de Empleados</th>';
    html += '<th>Salario Promedio</th>';
    html += '</tr></thead><tbody>';

    paginatedData.forEach(dept => {
        html += '<tr>';
        html += `<td>${dept.dept_name}</td>`;
        html += `<td>${parseInt(dept.total_employees).toLocaleString()}</td>`;
        html += `<td class="salary-highlight">$${parseFloat(dept.avg_salary).toLocaleString()}</td>`;
        html += '</tr>';
    });

    html += '</tbody></table>';
    html += '</div>';

    html += createPagination(data.length, currentPage, 'changePage');

    document.getElementById('reportResult').innerHTML = html;
}

// Función para cargar gráficos
function loadChart(chartNumber) {
    const container = document.getElementById('chartContainer');
    container.innerHTML = '<div class="loading-container"><div class="loading"></div><p class="loading-text">Generando gráfico...</p></div>';

    // Destruir gráfico anterior si existe
    if (currentChart) {
        currentChart.destroy();
    }

    let action = 'chart' + chartNumber;
    let url = 'api/employees.php?action=' + action;

    fetch(url)
        .then(response => response.json())
        .then(result => {
            if (result.success) {
                container.innerHTML = '<canvas id="myChart"></canvas>';

                switch(chartNumber) {
                    case 1:
                        createPieChart(result.data);
                        break;
                    case 2:
                        createHorizontalBarChart(result.data);
                        break;
                    case 3:
                        createVerticalBarChart(result.data);
                        break;
                    case 4:
                        createSalaryGapChart(result.data);
                        break;
                }
            } else {
                container.innerHTML = '<p class="error-message">Error: ' + result.error + '</p>';
            }
        })
        .catch(error => {
            container.innerHTML = '<p class="error-message">Error: ' + error + '</p>';
        });
}

// Gráfico 1: Pastel - Género
function createPieChart(data) {
    const ctx = document.getElementById('myChart').getContext('2d');

    const labels = data.map(item => item.gender === 'M' ? 'Masculino' : 'Femenino');
    const values = data.map(item => item.total);

    currentChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: labels,
            datasets: [{
                data: values,
                backgroundColor: [
                    'rgba(30, 58, 95, 0.8)',
                    'rgba(212, 175, 55, 0.8)'
                ],
                borderColor: [
                    'rgba(30, 58, 95, 1)',
                    'rgba(212, 175, 55, 1)'
                ],
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        font: {
                            size: 14,
                            family: 'Work Sans'
                        },
                        padding: 20
                    }
                },
                title: {
                    display: true,
                    text: 'Distribución de Empleados por Género',
                    font: {
                        size: 20,
                        family: 'Playfair Display',
                        weight: '700'
                    },
                    padding: 20
                }
            }
        }
    });
}

// Gráfico 2: Barras horizontales - Top 10
function createHorizontalBarChart(data) {
    const ctx = document.getElementById('myChart').getContext('2d');

    const labels = data.map(item => item.employee_name);
    const values = data.map(item => item.salary);

    currentChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Salario',
                data: values,
                backgroundColor: 'rgba(212, 175, 55, 0.7)',
                borderColor: 'rgba(212, 175, 55, 1)',
                borderWidth: 2
            }]
        },
        options: {
            indexAxis: 'y',
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: {
                    display: false
                },
                title: {
                    display: true,
                    text: 'Top 10 Empleados Mejor Pagados',
                    font: {
                        size: 20,
                        family: 'Playfair Display',
                        weight: '700'
                    },
                    padding: 20
                }
            },
            scales: {
                x: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return '$' + value.toLocaleString();
                        }
                    }
                }
            }
        }
    });
}

// Gráfico 3: Barras verticales - Promedio por departamento
function createVerticalBarChart(data) {
    const ctx = document.getElementById('myChart').getContext('2d');

    const labels = data.map(item => item.dept_name);
    const values = data.map(item => parseFloat(item.avg_salary));

    currentChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Salario Promedio',
                data: values,
                backgroundColor: 'rgba(30, 58, 95, 0.7)',
                borderColor: 'rgba(30, 58, 95, 1)',
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: {
                    display: false
                },
                title: {
                    display: true,
                    text: 'Promedio de Salarios por Departamento',
                    font: {
                        size: 20,
                        family: 'Playfair Display',
                        weight: '700'
                    },
                    padding: 20
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return '$' + value.toLocaleString();
                        }
                    }
                }
            }
        }
    });
}

// Gráfico 4: Brecha salarial
function createSalaryGapChart(data) {
    const ctx = document.getElementById('myChart').getContext('2d');

    const labels = data.map(item => item.dept_name);
    const maxSalaries = data.map(item => item.max_salary);
    const minSalaries = data.map(item => item.min_salary);
    const gaps = data.map(item => item.salary_gap);

    currentChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [
                {
                    label: 'Salario Máximo',
                    data: maxSalaries,
                    backgroundColor: 'rgba(16, 185, 129, 0.7)',
                    borderColor: 'rgba(16, 185, 129, 1)',
                    borderWidth: 2
                },
                {
                    label: 'Salario Mínimo',
                    data: minSalaries,
                    backgroundColor: 'rgba(239, 68, 68, 0.7)',
                    borderColor: 'rgba(239, 68, 68, 1)',
                    borderWidth: 2
                },
                {
                    label: 'Brecha Salarial',
                    data: gaps,
                    backgroundColor: 'rgba(184, 115, 51, 0.7)',
                    borderColor: 'rgba(184, 115, 51, 1)',
                    borderWidth: 2
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        font: {
                            size: 12,
                            family: 'Work Sans'
                        },
                        padding: 15
                    }
                },
                title: {
                    display: true,
                    text: 'Análisis de Brecha Salarial por Departamento',
                    font: {
                        size: 20,
                        family: 'Playfair Display',
                        weight: '700'
                    },
                    padding: 20
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return '$' + value.toLocaleString();
                        }
                    }
                }
            }
        }
    });
}