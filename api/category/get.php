<?php

header('Access-Control-Allow-Origin: *');
header('Allow-Control-Methods: GET');
header('Content-Type, application/json');

include_once '../../models/Category.php';
include_once '../../config/Database.php';

$database = new Database();
$db = $database->connect();

$category = new Category($db);

$result = $category->get();
$num = $result->rowCount();

// print_r($result);

if($num > 0){
    $category_array['data'] = array();
    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $categories = array(
            'id'=> $id,
            'name' => $name,
            'created_at'=> $created_at
        );
        array_push($category_array['data'], $categories);
    }
    echo json_encode(
        array(
            'status'=> true,
            $category_array
        )
        );
}else{
    echo json_encode(
        array(
            'status'=> true,
            'error'=> 'No category found'
        )
        );
}