<?php

header('Access-Control-Access-Origin: *');
header('Access-Control-Method: PUT');
header('Content-Type, application/json');

include_once '../../config/Database.php';
include_once '../../models/Category.php';

$database = new Database();
$db = $database->connect();

$category = new Category($db);

$data = json_decode(file_get_contents("php://input"));

$category->name = $data->name;
$category->id = $data->id;

if($category->update()){
    echo json_encode(
        array(
            'status'=> true,
            'message'=> 'Category was updated successfully'
        )
        );
}else{
    echo json_encode(
        array(
            'status'=> false,
            'error'=>'Something went wrong while trying to update category'
        )
        );
}
