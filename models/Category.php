<?php

class Category{

    private $conn;
    private $table = 'categories';
    
    public $name;
    public $created_at;

    public function __construct($db){
        $this->conn = $db;
    }

    public function create(){
        $query = 'INSERT INTO '.$this->table.'
        SET name = :name';

        $sth = $this->conn->prepare($query);
        
        $sth->name = htmlspecialchars(strip_tags($this->name));

        $sth->bindParam(':name', $this->name);

        
        if($sth->execute()){
            return true;
        }
        return false;
    }
    public function get(){
        $query = 'SELECT * FROM '.$this->table.' ORDER BY
        id DESC
        ';
        $sth = $this->conn->prepare($query);
        $sth->execute();

        return $sth;
    }


}