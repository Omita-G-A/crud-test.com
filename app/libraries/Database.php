<?php
// clase DATABASE, que será la encargada de conectar
// con la base de datos, preparar las consultas, binds
// de PDO y devolver los registros de la bd.

class Database {
    private $host = DB_HOST;
    private $port = BD_PORT;
    private $user = DB_USER;
    private $pass = DB_PASS;
    private $dbname = DB_NAME;

    // 'conn' es conexión, 'stmt' es statement
    private $conn;
    private $stmt;
    private $error;

    // 'dsn' es por data service name
    public function __construct(){
        $dsn = 'mysql:host='.$this->host.';port='.$this->port.';dbname='.$this->dbname;
        $options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];

        try{
            $this->conn = new PDO($dsn, $this->user, $this->pass, $options);
        }catch(PDOException $e){
            $this->error = $e;
            echo $this->error;
            exit;
        }
    }

    // método para hacer consultas
    public function query($sql) {
        $this->stmt = $this->conn->prepare($sql);
    }

    public function bind($param, $value, $type = null) {
        if(is_null($type)){
            switch(true){
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            }
        }
        $this->stmt->bindValue($param, $value, $type);
    }

    public function execute(){
        return $this->stmt->execute();
    }

    // método para devolver un array de objetos
    public function resultSet(){
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_OBJ);
    }

    // Método para devolver un sólo registro en forma de objeto
    public function single(){
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_OBJ);
    }

    // método que devuelve la cantidad de registros que genera
    // la consulta. Se suele utilizar para saber si un registro
    // existe o no (o sea, si el stmt devuelve un registro o no)
    public function rowCount(){
        return $this->stmt->rowCount();
    }
}