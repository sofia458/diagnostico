<?php
/**
 * Configuración de conexión a la base de datos
 * Asegúrate de tener XAMPP corriendo y la base de datos 'employees' importada
 */

class Database {
    private $host = "localhost:3306";
    private $db_name = "employees";
    private $username = "bigdata";
    private $password = "bigdata123";
    public $conn;

    public function getConnection() {
        $this->conn = null;

        try {
            $this->conn = new PDO(
                "mysql:host=" . $this->host . ";dbname=" . $this->db_name,
                $this->username,
                $this->password
            );
            $this->conn->exec("set names utf8");
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $exception) {
            echo "Error de conexión: " . $exception->getMessage();
        }

        return $this->conn;
    }
}
?>
