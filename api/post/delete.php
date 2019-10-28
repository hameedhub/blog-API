<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type, application/json');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorizaiton, X-Requested-With');

include_once '../../models/Post.php';
include_once '../../config/Database.php';

$database = new Database();
$db = $database->connect();

$post = new Post($db);

$post->id = isset($_GET['id'])? $_GET['id']: null;


if($post->delete()){
    echo json_encode(
        array(
            'status'=> true,
            'message'=> 'Post was successful deleted'
        )
        );
}else{
    echo json_encode(
        array(
            'status'=> false,
            'error'=> 'Something went wrong, post could not be deleted'
        )
        );
}

