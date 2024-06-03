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
                "mysql:host=" . $this->server . ";dbname=" . $this->db,
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
        
        // avoid XSS
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

    protected function updateData($table, $data, $condition) {
        try {
            $setClause = implode(", ", array_map(function($item) {
                return "{$item['field_name']} = {$item['field_param']}";
            }, $data));
    
            $query = "UPDATE $table SET $setClause WHERE {$condition['condition_field']} = {$condition['condition_param']}";
            $stmt = $this->connect()->prepare($query);
    
            foreach ($data as $item) {
                $stmt->bindParam($item["field_param"], $item["field_value"]);
            }
    
            $stmt->bindParam($condition["condition_param"], $condition["condition_value"]);
            $stmt->execute();
            return $stmt;
        } catch (PDOException $e) {
            exit('Data update failed: ' . $e->getMessage());
        }
    }


    protected function deleteRecord($table, $field, $id) {
        $stmt = $this->connect()->prepare("DELETE FROM $table WHERE $field = :id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();

        return $stmt;
    }

    protected function paginateTables($currentPage, $totalPages, $url, $buttonsToShow) {
        $pagination = '<nav class="pagination is-centered is-rounded" role="navigation" aria-label="pagination">';
        
        // previous button
        if ($currentPage <= 1) {
            $pagination .= '<a class="pagination-previous is-disabled" disabled>Anterior</a>';
        } else {
            $pagination .= '<a class="pagination-previous" href="' . $url . ($currentPage - 1) . '/">Anterior</a>';
        }
    
        $pagination .= '<ul class="pagination-list">';
    
        // First page link and ellipsis if needed
        if ($currentPage > 1) {
            $pagination .= '<li><a class="pagination-link" href="' . $url . '1/">1</a></li>';
            if ($currentPage > 2) {
                $pagination .= '<li><span class="pagination-ellipsis">&hellip;</span></li>';
            }
        }
    
        // Page number links
        $start = max(1, $currentPage - floor($buttonsToShow / 2));
        $end = min($totalPages, $currentPage + floor($buttonsToShow / 2));
        if ($start > 1) {
            $end = min($totalPages, $start + $buttonsToShow - 1);
        }
        if ($end < $totalPages) {
            $start = max(1, $end - $buttonsToShow + 1);
        }
    
        for ($i = $start; $i <= $end; $i++) {
            if ($currentPage == $i) {
                $pagination .= '<li><a class="pagination-link is-current" href="' . $url . $i . '/">' . $i . '</a></li>';
            } else {
                $pagination .= '<li><a class="pagination-link" href="' . $url . $i . '/">' . $i . '</a></li>';
            }
        }
    
        // Last page link and ellipsis if needed
        if ($currentPage < $totalPages - 1) {
            if ($currentPage < $totalPages - 2) {
                $pagination .= '<li><span class="pagination-ellipsis">&hellip;</span></li>';
            }
            $pagination .= '<li><a class="pagination-link" href="' . $url . $totalPages . '/">' . $totalPages . '</a></li>';
        }
    
        $pagination .= '</ul>';
    
        // Next button
        if ($currentPage >= $totalPages) {
            $pagination .= '<a class="pagination-next is-disabled" disabled>Siguiente</a>';
        } else {
            $pagination .= '<a class="pagination-next" href="' . $url . ($currentPage + 1) . '/">Siguiente</a>';
        }
    
        $pagination .= '</nav>';
        return $pagination;
    }   

}