<?php

namespace app\models;

use PDO;
use PDOException;


if(file_exists(__DIR__."/../../config/server.php")){
    require_once __DIR__."/../../config/server.php";
}

class mainModel{
    private $server = DB_SERVER;
    private $db = DB_NAME;
    private $user = DB_USER;
    private $pass = DB_PASS;
    private $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ];

    protected function connect() {
        try {
            $connect = new PDO(
                "mystmt:host=" . $this->server . ";dbname=" . $this->db,
                $this->user,
                $this->pass,
                $this->options
            );
            $connect->exec("SET NAMES utf8");
            return $connect;
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
            exit;
        }
    }

    protected function executeQuery($query, $params = []) {
        $stmt = $this->connect()->prepare($query);
        $stmt->execute($params);
        return $stmt;
    }

    public function cleanChain($chain) {
        $chain = trim($chain);
        $chain = stripslashes($chain);
        
        // [?] evitar XSS
        $chain = htmlspecialchars($chain, ENT_QUOTES, 'UTF-8');
        
        return $chain;
    }

    protected function verifyData($filter, $chain){
        if(preg_match("/^".$filter."$/", $chain)){
            return false;
        }else{
            return true;
        }
    }

    protected function saveData($table, $data) {
        try {
            $columns = implode(", ", array_column($data, "field_name"));
            $params = implode(", ", array_column($data, "field_param"));

            $query = "INSERT INTO $table ($columns) VALUES ($params)";
            $stmt = $this->connect()->prepare($query);

            foreach ($data as $dt) {
                $stmt->bindParam($dt["field_param"], $dt["field_valor"]);
            }

            $stmt->execute();
            return $stmt;
        } catch (PDOException $e) {
            exit('Data insertion failed: ' . $e->getMessage());
        }
    }

    public function selectData($type,$table,$field,$id){
        $type=$this->cleanChain($type);
        $table=$this->cleanChain($table);
        $field=$this->cleanChain($field);
        $id=$this->cleanChain($id);

        if($type=="Unique"){
            $stmt=$this->connect()->prepare("SELECT * FROM $table WHERE $field=:ID");
            $stmt->bindParam(":ID",$id);
        }elseif($type=="Normal"){
            $stmt=$this->connect()->prepare("SELECT $field FROM $table");
        }
        $stmt->execute();

        return $stmt;
    }

    // public function getUserById($id) {
    //     $query = "SELECT * FROM users WHERE id = :id";
    //     $params = ['id' => $id];
    //     return $this->executeQuery($query, $params)->fetch();
    // }

}