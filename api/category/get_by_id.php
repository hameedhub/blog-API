<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Methods: GET');

include_once '../../models/Category.php';
include_once '../../config/Database.php';

$database = new Database();
$db = $database->connect();

$category = new Category($db);

$category->id = isset($_GET['id'])? $_GET['id'] : die();

extract($category->get_by_id());
$details['data'] = array(
    'id'=> $id,
    'name'=> $name,
    'created_at'=> $created_at
);
echo json_encode(
    array(
        'status'=> true,
        $details
    )
    );