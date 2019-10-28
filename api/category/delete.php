<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Method: DELETE');
header('Content-Type, application/json');


include_once '../../config/Database.php';
include_once '../../models/Category.php';

$database = new Database();
$db = $database->connect();

$category = new Category($db);

$category->id = isset($_GET['id'])? $_GET['id'] : die();

if($category->delete()){
    echo json_encode(
        array(
            'status'=> true,
            'message'=> 'Category was successfully deleted'
        )
        );
}else{
    echo json_encode(
        array(
            'status'=> false,
            'error'=> 'Something went trying to delete category'
        )
        );
}
