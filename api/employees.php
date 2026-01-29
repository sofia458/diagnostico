<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

require_once '../config/database.php';
require_once '../classes/Employee.php';

$database = new Database();
$db = $database->getConnection();

if (!$db) {
    echo json_encode(['error' => 'No se pudo conectar a la base de datos']);
    exit;
}

$employee = new Employee($db);

$action = isset($_GET['action']) ? $_GET['action'] : '';

try {
    switch($action) {
        case 'report1':
            $department = isset($_GET['department']) ? $_GET['department'] : null;
            $data = $employee->getAllEmployees($department);
            $departments = $employee->getAllDepartments();
            echo json_encode([
                'success' => true,
                'data' => $data,
                'departments' => $departments
            ]);
            break;
            
        case 'report2':
            $data = $employee->getDepartmentManagers();
            echo json_encode([
                'success' => true,
                'data' => $data
            ]);
            break;
            
        case 'report3':
            $data = $employee->getTopPaidByDepartment();
            echo json_encode([
                'success' => true,
                'data' => $data
            ]);
            break;
            
        case 'report4':
            $data = $employee->getEmployeesByYear();
            echo json_encode([
                'success' => true,
                'data' => $data
            ]);
            break;
            
        case 'report5':
            $data = $employee->getDepartmentStats();
            echo json_encode([
                'success' => true,
                'data' => $data
            ]);
            break;
            
        case 'chart1':
            $data = $employee->getGenderComparison();
            echo json_encode([
                'success' => true,
                'data' => $data
            ]);
            break;
            
        case 'chart2':
            $data = $employee->getTop10Paid();
            echo json_encode([
                'success' => true,
                'data' => $data
            ]);
            break;
            
        case 'chart3':
            $data = $employee->getAvgSalaryByDept();
            echo json_encode([
                'success' => true,
                'data' => $data
            ]);
            break;
            
        case 'chart4':
            $data = $employee->getSalaryGapByDept();
            echo json_encode([
                'success' => true,
                'data' => $data
            ]);
            break;
            
        default:
            echo json_encode([
                'success' => false,
                'error' => 'Acción no válida'
            ]);
            break;
    }
} catch(Exception $e) {
    echo json_encode([
        'success' => false,
        'error' => $e->getMessage()
    ]);
}
?>
