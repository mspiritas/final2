<?php
    // Headers- Accessed by anyone
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Author.php';

    // Instantiate DB and connect
    $database = new Database();
    // Connect function in Database.php
    $db = $database->connect();

    // Instantiate category object
    $author = new Author($db);

    // Get ID from URL     ? means then, : means else
    $author->id = isset($_GET['id']) ? $_GET['id'] : die();

    // Get author from read_single function in author.php
    $author->read_single();

    // Create array
    $cat_arr = array(
        'id' => $author->id,
        'author' => $author->author
    );

    // Convert to JSON data
    print_r(json_encode($cat_arr));