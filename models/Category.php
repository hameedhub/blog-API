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
    public function get_by_id(){
        $query = 'SELECT * FROM '.$this->table.'
        WHERE id =:id';

        $sth = $this->conn->prepare($query);

        $sth->bindParam(':id', $this->id);


        $sth->execute();

        return $result = $sth->fetch(PDO::FETCH_ASSOC);
    }
    public function update(){
        $query = 'UPDATE '.$this->table.'
        SET name =:name
        WHERE id =:id
        ';
        $sth = $this->conn->prepare($query);

        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->id = htmlspecialchars(strip_tags($this->id));

        $sth->bindParam(':name', $this->name);
        $sth->bindParam(':id', $this->id);

        $sth-> execute();
        if($sth-> execute()){
            return true;
        }
        return false;
    }
    public function delete(){
        $query = 'DELETE FROM '.$this->table.'
        WHERE id =:id
        ';
        
        $sth = $this->conn->prepare($query);

        $this->id = htmlspecialchars(strip_tags($this->id));

        $sth->bindParam(':id', $this->id);
        if($sth->execute()){
            return true;
        }
        return false;
    }

}