<?php
header('Access-Control-Methods: POST');
header('Access-Control-Origin: *');
//header('Access-Control');

include_once '../../config/Database.php';
include_once '../../models/Category.php';


$database = new Database();
$db = $database->connect();

$category = new Category($db);

$data = json_decode(file_get_contents("php://input"));


//print_r($data);

$category->name =  $data->name;

if($category->create()){
    echo json_encode(
        array(
            'status'=> true,
            'message'=> 'Category was successfully added'
        )
        );
}else{
    echo json_encode(
        array(
            'status'=> false,
            'error'=> 'Something went wrong, category was not added'
        )
        );
}
