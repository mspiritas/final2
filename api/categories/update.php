<?php
    // Headers

    // Accessed by anyone
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: PUT');
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

    // Set ID to update
    $category->id = $data->id;
    
    $category->category = $data->category;

    // Update category
    if($category->update()) {
        echo json_encode(
            array('message'=> 'Category updated')
        );
    } else {
        echo json_encode(
            array('message'=> 'Category Not updated')
        );
    }