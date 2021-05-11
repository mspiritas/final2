<?php
    // Headers- Accessed by anyone
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Category.php';

    // Instantiate DB and connect
    $database = new Database();
    // Connect function in Database.php
    $db = $database->connect();

    // Instantiate category object
    $category = new Category($db);

    // Get ID from URL     ? means then, : means else
    $category->id = isset($_GET['id']) ? $_GET['id'] : die();

    // Get category from read_single function in Category.php
    $category->read_single();

    // Create array
    $cat_arr = array(
        'id' => $category->id,
        'category' => $category->category
    );

    // Convert to JSON data
    print_r(json_encode($cat_arr));