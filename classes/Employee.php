<?php
class Employee {
    private $conn;
    
    public function __construct($db) {
        $this->conn = $db;
    }
    
    // REPORTE 1: Listar todos los empleados con detalles
    public function getAllEmployees($departmentFilter = null) {
        $query = "SELECT DISTINCT
                    e.emp_no,
                    e.first_name,
                    e.last_name,
                    e.birth_date,
                    e.gender,
                    e.hire_date,
                    d.dept_name,
                    t.title,
                    s.salary
                FROM employees e
                LEFT JOIN dept_emp de ON e.emp_no = de.emp_no AND de.to_date = '9999-01-01'
                LEFT JOIN departments d ON de.dept_no = d.dept_no
                LEFT JOIN titles t ON e.emp_no = t.emp_no AND t.to_date = '9999-01-01'
                LEFT JOIN salaries s ON e.emp_no = s.emp_no AND s.to_date = '9999-01-01'";
        
        if ($departmentFilter && $departmentFilter != 'all') {
            $query .= " WHERE d.dept_name = :dept_name";
        }
        
        $query .= " ORDER BY e.emp_no LIMIT 1000";
        
        $stmt = $this->conn->prepare($query);
        
        if ($departmentFilter && $departmentFilter != 'all') {
            $stmt->bindParam(':dept_name', $departmentFilter);
        }
        
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    // REPORTE 2: Managers actuales de cada departamento
    public function getDepartmentManagers() {
        $query = "SELECT 
                    d.dept_name,
                    CONCAT(e.first_name, ' ', e.last_name) as manager_name,
                    dm.from_date
                FROM dept_manager dm
                JOIN departments d ON dm.dept_no = d.dept_no
                JOIN employees e ON dm.emp_no = e.emp_no
                WHERE dm.to_date = '9999-01-01'
                ORDER BY d.dept_name";
        
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    // REPORTE 3: Empleado mejor pagado por departamento
    public function getTopPaidByDepartment() {
        $query = "SELECT 
                    d.dept_name,
                    e.emp_no,
                    CONCAT(e.first_name, ' ', e.last_name) as employee_name,
                    s.salary
                FROM departments d
                JOIN dept_emp de ON d.dept_no = de.dept_no AND de.to_date = '9999-01-01'
                JOIN employees e ON de.emp_no = e.emp_no
                JOIN salaries s ON e.emp_no = s.emp_no AND s.to_date = '9999-01-01'
                WHERE (d.dept_no, s.salary) IN (
                    SELECT de2.dept_no, MAX(s2.salary)
                    FROM dept_emp de2
                    JOIN salaries s2 ON de2.emp_no = s2.emp_no AND s2.to_date = '9999-01-01'
                    WHERE de2.to_date = '9999-01-01'
                    GROUP BY de2.dept_no
                )
                ORDER BY d.dept_name";
        
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    // REPORTE 4: Total de empleados contratados por año
    public function getEmployeesByYear() {
        $query = "SELECT 
                    YEAR(hire_date) as year,
                    COUNT(*) as total_employees
                FROM employees
                GROUP BY YEAR(hire_date)
                ORDER BY year";
        
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    // REPORTE 5: Departamentos con total de empleados y salario promedio
    public function getDepartmentStats() {
        $query = "SELECT 
                    d.dept_name,
                    COUNT(DISTINCT de.emp_no) as total_employees,
                    ROUND(AVG(s.salary), 2) as avg_salary
                FROM departments d
                JOIN dept_emp de ON d.dept_no = de.dept_no AND de.to_date = '9999-01-01'
                JOIN salaries s ON de.emp_no = s.emp_no AND s.to_date = '9999-01-01'
                GROUP BY d.dept_name
                ORDER BY d.dept_name";
        
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    // GRÁFICO 1: Comparación empleados por género
    public function getGenderComparison() {
        $query = "SELECT 
                    gender,
                    COUNT(*) as total
                FROM employees
                GROUP BY gender";
        
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    // GRÁFICO 2: Top 10 empleados mejor pagados
    public function getTop10Paid() {
        $query = "SELECT 
                    CONCAT(e.first_name, ' ', e.last_name) as employee_name,
                    s.salary
                FROM employees e
                JOIN salaries s ON e.emp_no = s.emp_no AND s.to_date = '9999-01-01'
                ORDER BY s.salary DESC
                LIMIT 10";
        
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    // GRÁFICO 3: Promedio de salarios por departamento
    public function getAvgSalaryByDept() {
        $query = "SELECT 
                    d.dept_name,
                    ROUND(AVG(s.salary), 2) as avg_salary
                FROM departments d
                JOIN dept_emp de ON d.dept_no = de.dept_no AND de.to_date = '9999-01-01'
                JOIN salaries s ON de.emp_no = s.emp_no AND s.to_date = '9999-01-01'
                GROUP BY d.dept_name
                ORDER BY avg_salary DESC";
        
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    // GRÁFICO 4: Brecha salarial por departamento
    public function getSalaryGapByDept() {
        $query = "SELECT 
                    d.dept_name,
                    MAX(s.salary) as max_salary,
                    MIN(s.salary) as min_salary,
                    (MAX(s.salary) - MIN(s.salary)) as salary_gap
                FROM departments d
                JOIN dept_emp de ON d.dept_no = de.dept_no AND de.to_date = '9999-01-01'
                JOIN salaries s ON de.emp_no = s.emp_no AND s.to_date = '9999-01-01'
                GROUP BY d.dept_name
                ORDER BY salary_gap DESC";
        
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    // Obtener lista de departamentos para filtros
    public function getAllDepartments() {
        $query = "SELECT DISTINCT dept_name FROM departments ORDER BY dept_name";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
