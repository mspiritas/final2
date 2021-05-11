<?php
    // Headers

    // Accessed by anyone
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type,Access-Control-Allow-Method, Authorization,X-Requested-With');

    include_once '../../config/Database.php';
    include_once '../../models/Category.php';

    // Instantiate DB and connect
    $database = new Database();
    // connect function in Database.php
    $db = $database->connect();

    // Instantiate category object
    $category = new Category($db);

    // Get raw posted data
    $data = json_decode(file_get_contents("php://input"));
    
    $category->category = $data->category;

    // Create category
    if($category->create()) {
        echo json_encode(
            array('message'=> 'Category created')
        );
    } else {
        echo json_encode(
            array('message'=> 'Category not created')
        );
    }