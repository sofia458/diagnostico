-- =============================================
-- ESTRUCTURA DE BASE DE DATOS EMPLOYEES
-- =============================================
-- Este archivo es solo de referencia para entender la estructura
-- Se recomienda usar la base de datos oficial de MySQL:
-- https://github.com/datacharmer/test_db

-- =============================================
-- NOTAS IMPORTANTES:
-- =============================================
-- 1. La base de datos "employees" es una base de datos de ejemplo oficial de MySQL
-- 2. Contiene más de 300,000 registros de empleados
-- 3. Es perfecta para pruebas y aprendizaje
-- 4. Para descargarla e instalarla:
--    git clone https://github.com/datacharmer/test_db.git
--    cd test_db
--    mysql -u root -p < employees.sql

-- =============================================
-- ESTRUCTURA DE TABLAS
-- =============================================

-- Tabla: employees
-- Almacena información básica de empleados
CREATE TABLE IF NOT EXISTS employees (
    emp_no      INT             NOT NULL,
    birth_date  DATE            NOT NULL,
    first_name  VARCHAR(14)     NOT NULL,
    last_name   VARCHAR(16)     NOT NULL,
    gender      ENUM ('M','F')  NOT NULL,    
    hire_date   DATE            NOT NULL,
    PRIMARY KEY (emp_no)
);

-- Tabla: departments
-- Almacena información de departamentos
CREATE TABLE IF NOT EXISTS departments (
    dept_no     CHAR(4)         NOT NULL,
    dept_name   VARCHAR(40)     NOT NULL,
    PRIMARY KEY (dept_no),
    UNIQUE KEY (dept_name)
);

-- Tabla: dept_manager
-- Relaciona managers con departamentos
CREATE TABLE IF NOT EXISTS dept_manager (
   emp_no       INT             NOT NULL,
   dept_no      CHAR(4)         NOT NULL,
   from_date    DATE            NOT NULL,
   to_date      DATE            NOT NULL,
   FOREIGN KEY (emp_no)  REFERENCES employees (emp_no)    ON DELETE CASCADE,
   FOREIGN KEY (dept_no) REFERENCES departments (dept_no) ON DELETE CASCADE,
   PRIMARY KEY (emp_no, dept_no)
); 

-- Tabla: dept_emp
-- Relaciona empleados con departamentos
CREATE TABLE IF NOT EXISTS dept_emp (
    emp_no      INT             NOT NULL,
    dept_no     CHAR(4)         NOT NULL,
    from_date   DATE            NOT NULL,
    to_date     DATE            NOT NULL,
    FOREIGN KEY (emp_no)  REFERENCES employees   (emp_no)  ON DELETE CASCADE,
    FOREIGN KEY (dept_no) REFERENCES departments (dept_no) ON DELETE CASCADE,
    PRIMARY KEY (emp_no, dept_no)
);

-- Tabla: titles
-- Almacena títulos/puestos de empleados
CREATE TABLE IF NOT EXISTS titles (
    emp_no      INT             NOT NULL,
    title       VARCHAR(50)     NOT NULL,
    from_date   DATE            NOT NULL,
    to_date     DATE,
    FOREIGN KEY (emp_no) REFERENCES employees (emp_no) ON DELETE CASCADE,
    PRIMARY KEY (emp_no, title, from_date)
); 

-- Tabla: salaries
-- Almacena información de salarios
CREATE TABLE IF NOT EXISTS salaries (
    emp_no      INT             NOT NULL,
    salary      INT             NOT NULL,
    from_date   DATE            NOT NULL,
    to_date     DATE            NOT NULL,
    FOREIGN KEY (emp_no) REFERENCES employees (emp_no) ON DELETE CASCADE,
    PRIMARY KEY (emp_no, from_date)
);

-- =============================================
-- ÍNDICES PARA MEJORAR RENDIMIENTO
-- =============================================

-- Índices para búsquedas frecuentes
CREATE INDEX idx_dept_emp_to_date ON dept_emp(to_date);
CREATE INDEX idx_dept_manager_to_date ON dept_manager(to_date);
CREATE INDEX idx_salaries_to_date ON salaries(to_date);
CREATE INDEX idx_titles_to_date ON titles(to_date);

-- =============================================
-- DATOS DE EJEMPLO (OPCIONAL)
-- =============================================
-- Si no quieres usar la base de datos completa,
-- puedes insertar algunos datos de prueba:

/*
-- Insertar departamentos de ejemplo
INSERT INTO departments VALUES 
('d001','Marketing'),
('d002','Finance'),
('d003','Human Resources'),
('d004','Production'),
('d005','Development'),
('d006','Quality Management'),
('d007','Sales'),
('d008','Research'),
('d009','Customer Service');

-- Insertar empleados de ejemplo
INSERT INTO employees VALUES 
(10001,'1953-09-02','Georgi','Facello','M','1986-06-26'),
(10002,'1964-06-02','Bezalel','Simmel','F','1985-11-21'),
(10003,'1959-12-03','Parto','Bamford','M','1986-08-28'),
(10004,'1954-05-01','Chirstian','Koblick','M','1986-12-01'),
(10005,'1955-01-21','Kyoichi','Maliniak','M','1989-09-12');

-- Insertar relaciones departamento-empleado
INSERT INTO dept_emp VALUES 
(10001,'d005','1986-06-26','9999-01-01'),
(10002,'d007','1996-08-03','9999-01-01'),
(10003,'d004','1995-12-03','9999-01-01'),
(10004,'d004','1986-12-01','9999-01-01'),
(10005,'d003','1989-09-12','9999-01-01');

-- Insertar títulos
INSERT INTO titles VALUES 
(10001,'Senior Engineer','1986-06-26','9999-01-01'),
(10002,'Staff','1996-08-03','9999-01-01'),
(10003,'Senior Engineer','1995-12-03','9999-01-01'),
(10004,'Engineer','1986-12-01','1995-12-01'),
(10005,'Senior Staff','1996-09-12','9999-01-01');

-- Insertar salarios
INSERT INTO salaries VALUES 
(10001,60117,'1986-06-26','1987-06-26'),
(10001,62102,'1987-06-26','1988-06-25'),
(10001,66074,'1988-06-25','1989-06-25'),
(10002,65828,'1996-08-03','1997-08-03'),
(10003,40006,'1995-12-03','1996-12-02'),
(10004,40054,'1986-12-01','1987-12-01'),
(10005,78228,'1996-09-12','1997-09-12');

-- Insertar managers
INSERT INTO dept_manager VALUES 
(10001,'d005','1996-08-03','9999-01-01'),
(10002,'d007','1996-08-03','9999-01-01');
*/

-- =============================================
-- CONSULTAS DE VERIFICACIÓN
-- =============================================
-- Ejecuta estas consultas para verificar la instalación:

-- Ver total de empleados
-- SELECT COUNT(*) as total_empleados FROM employees;

-- Ver departamentos
-- SELECT * FROM departments;

-- Ver managers actuales
-- SELECT d.dept_name, CONCAT(e.first_name, ' ', e.last_name) as manager
-- FROM dept_manager dm
-- JOIN departments d ON dm.dept_no = d.dept_no
-- JOIN employees e ON dm.emp_no = e.emp_no
-- WHERE dm.to_date = '9999-01-01';

-- Ver empleados con salario actual
-- SELECT e.emp_no, e.first_name, e.last_name, s.salary
-- FROM employees e
-- JOIN salaries s ON e.emp_no = s.emp_no
-- WHERE s.to_date = '9999-01-01'
-- ORDER BY s.salary DESC
-- LIMIT 10;

-- =============================================
-- NOTA FINAL
-- =============================================
-- Para el proyecto completo, se recomienda usar
-- la base de datos oficial "employees" de MySQL
-- que contiene datos reales y completos.
-- 
-- Descarga: https://github.com/datacharmer/test_db
-- Documentación: https://dev.mysql.com/doc/employee/en/
