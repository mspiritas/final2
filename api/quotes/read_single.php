<?php
    // Headers- Accessed by anyone
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Quote.php';

    // Instantiate DB and connect
    $database = new Database();
    // Connect function in Database.php
    $db = $database->connect();

    // Instantiate quote object
    $quote = new Quote($db);

    // Get ID from URL     ? means then, : means else
    $quote->id = isset($_GET['id']) ? $_GET['id'] : die();

    // Get quote from read_single function in Quote.php
    $quote->read_single();

    // Create array
    $cat_arr = array(
        'quote' => $quote->quote
    );

    // Convert to JSON data
    print_r(json_encode($cat_arr));