<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test de Conexión - Base de Datos</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            padding: 20px;
        }
        .test-container {
            background: white;
            border-radius: 16px;
            padding: 40px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            max-width: 600px;
            width: 100%;
        }
        h1 {
            color: #333;
            margin-bottom: 30px;
            text-align: center;
        }
        .status {
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-weight: 600;
        }
        .success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        .info {
            background: #d1ecf1;
            color: #0c5460;
            border: 1px solid #bee5eb;
        }
        .test-item {
            padding: 15px;
            margin: 10px 0;
            border-left: 4px solid #667eea;
            background: #f8f9fa;
        }
        .test-item h3 {
            margin: 0 0 10px 0;
            color: #667eea;
        }
        .btn {
            background: #667eea;
            color: white;
            padding: 12px 24px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
            margin-top: 20px;
        }
        .btn:hover {
            background: #5568d3;
        }
        pre {
            background: #f4f4f4;
            padding: 10px;
            border-radius: 4px;
            overflow-x: auto;
        }
    </style>
</head>
<body>
    <div class="test-container">
        <h1>🔍 Test de Conexión a Base de Datos</h1>
        
        <?php
        require_once 'config/database.php';
        require_once 'classes/Employee.php';
        
        echo '<div class="info">Iniciando pruebas de conexión...</div>';
        
        // Test 1: Conexión a la base de datos
        echo '<div class="test-item">';
        echo '<h3>Test 1: Conexión a MySQL</h3>';
        
        try {
            $database = new Database();
            $db = $database->getConnection();
            
            if ($db) {
                echo '<div class="status success">✅ Conexión exitosa a la base de datos</div>';
                
                // Test 2: Verificar tablas
                echo '</div><div class="test-item">';
                echo '<h3>Test 2: Verificación de Tablas</h3>';
                
                $tables = ['employees', 'departments', 'dept_emp', 'dept_manager', 'titles', 'salaries'];
                $allTablesExist = true;
                
                foreach ($tables as $table) {
                    $query = "SHOW TABLES LIKE '$table'";
                    $stmt = $db->prepare($query);
                    $stmt->execute();
                    $result = $stmt->fetch();
                    
                    if ($result) {
                        echo "✅ Tabla <strong>$table</strong> encontrada<br>";
                    } else {
                        echo "❌ Tabla <strong>$table</strong> NO encontrada<br>";
                        $allTablesExist = false;
                    }
                }
                
                if ($allTablesExist) {
                    echo '<div class="status success" style="margin-top: 15px;">Todas las tablas requeridas existen</div>';
                } else {
                    echo '<div class="status error" style="margin-top: 15px;">Faltan algunas tablas. Por favor importa la base de datos.</div>';
                }
                
                // Test 3: Contar registros
                echo '</div><div class="test-item">';
                echo '<h3>Test 3: Conteo de Registros</h3>';
                
                $query = "SELECT COUNT(*) as total FROM employees";
                $stmt = $db->prepare($query);
                $stmt->execute();
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                
                echo "Total de empleados: <strong>" . number_format($result['total']) . "</strong><br>";
                
                if ($result['total'] > 0) {
                    echo '<div class="status success" style="margin-top: 15px;">✅ La base de datos contiene datos</div>';
                    
                    // Test 4: Probar consulta compleja
                    echo '</div><div class="test-item">';
                    echo '<h3>Test 4: Consulta de Ejemplo</h3>';
                    
                    $employee = new Employee($db);
                    $managers = $employee->getDepartmentManagers();
                    
                    if (count($managers) > 0) {
                        echo '<div class="status success">✅ Consultas funcionando correctamente</div>';
                        echo '<p><strong>Ejemplo - Managers encontrados:</strong></p>';
                        echo '<pre>';
                        foreach (array_slice($managers, 0, 3) as $manager) {
                            echo "Departamento: " . $manager['dept_name'] . "\n";
                            echo "Manager: " . $manager['manager_name'] . "\n";
                            echo "---\n";
                        }
                        echo '</pre>';
                    } else {
                        echo '<div class="status error">⚠️ No se encontraron managers</div>';
                    }
                    
                } else {
                    echo '<div class="status error" style="margin-top: 15px;">⚠️ La base de datos está vacía. Importa los datos.</div>';
                }
                
            } else {
                echo '<div class="status error">❌ Error: No se pudo conectar a la base de datos</div>';
            }
            
        } catch (Exception $e) {
            echo '<div class="status error">❌ Error: ' . $e->getMessage() . '</div>';
        }
        
        echo '</div>';
        
        // Resumen final
        echo '<div class="test-item">';
        echo '<h3>📋 Resumen</h3>';
        echo '<p>Si todos los tests pasaron exitosamente, tu sistema está listo para usar.</p>';
        echo '<p><strong>Próximos pasos:</strong></p>';
        echo '<ol>';
        echo '<li>Si todo está ✅, ve a <a href="index.php">index.php</a></li>';
        echo '<li>Si algo falló ❌, revisa el README.md</li>';
        echo '<li>Verifica que XAMPP esté corriendo</li>';
        echo '<li>Confirma que la base de datos "employees" exista</li>';
        echo '</ol>';
        echo '</div>';
        ?>
        
        <button class="btn" onclick="location.href='index.php'">
            Ir al Sistema Principal
        </button>
        
        <button class="btn" onclick="location.reload()" style="background: #28a745; margin-top: 10px;">
            🔄 Ejecutar Tests Nuevamente
        </button>
    </div>
</body>
</html>
