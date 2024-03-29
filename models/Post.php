<?php
class Post{

    private $conn;
    private $table = 'posts';

    public $id;
    public $category_id;
    public $category_name;
    public $title;
    public $body;
    public $author;
    public $created_at;

    public function __construct($db){

        $this->conn = $db;
 
    }
    public function get(){
        $query = ' SELECT c.name as category_name, p.id, p.category_id, p.title,
        p.body, p.author, p.created_at
        FROM
        ' .$this->table .' p
        LEFT JOIN
        categories c ON p.category_id = c.id
        ORDER BY p.created_at DESC';

        $sth = $this->conn->prepare($query);
        $sth->execute();
        return $sth;
    }
    public function get_by_id(){
        $query = ' SELECT c.name as category_name, p.id, p.category_id, p.title,
        p.body, p.author, p.created_at
        FROM
        ' .$this->table .' p
        LEFT JOIN
        categories c ON p.category_id = c.id
        WHERE p.id = ?';

        $sth = $this->conn->prepare($query);
        $sth->bindParam(1, $this->id);
        $sth->execute();

        $row = $sth->fetch(PDO::FETCH_ASSOC);

        $this->title = $row['title'];
        $this->body = $row['body'];
        $this->author = $row['author'];
        $this->category_id = $row['category_id'];
        $this->category_name = $row['category_name']; 
    }
    public function create(){
        $query = 'INSERT INTO '.$this->table.'
        SET title =:title,
        body = :body, 
        author =:author,
        category_id =:category_id';
        $sth = $this->conn->prepare($query);

        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->body = htmlspecialchars(strip_tags($this->body));
        $this->author = htmlspecialchars(strip_tags($this->author));
        $this->category_id = htmlspecialchars(strip_tags($this->category_id));
        
        $sth->bindParam(':title', $this->title);
        $sth->bindParam(':body', $this->body);
        $sth->bindParam(':author', $this->author);
        $sth->bindParam(':category_id', $this->category_id);
        
        if($sth->execute()){
            return true;
        }

        printf("Error: %s.\n", $sth->error);

        return false;

    }
    public function update(){
       
       $query = 'UPDATE '.$this->table.'
        SET title=:title,
        body =:body, author =:author,
        category_id =:category_id WHERE id = :id';

        $sth = $this->conn->prepare($query);

        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->body = htmlspecialchars(strip_tags($this->body));
        $this->author = htmlspecialchars(strip_tags($this->author));
        $this->category_id = htmlspecialchars(strip_tags($this->category_id));
        $this->id = htmlspecialchars(strip_tags($this->id));

        
        $sth->bindParam(':title', $this->title);
        $sth->bindParam(':body', $this->body);
        $sth->bindParam(':author', $this->author);
        $sth->bindParam(':category_id', $this->category_id);
        $sth->bindParam(':id', $this->id);
        
        //print_r($sth->errorInfo());
        
        if($sth->execute()){
            return true;
        }

        printf("Error: %s.\n", $sth->error);

        return false;
    }
    public function delete(){
        $query = 'DELETE FROM '.$this->table.'
        WHERE id =:id';
        $sth = $this->conn->prepare($query);

        $sth->bindParam(':id', $this->id);

        if($sth->execute()){
            return true;
        }
        return false;
    }

}

?>