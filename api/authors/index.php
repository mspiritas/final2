<?php
    // Headers- Accessed by anyone
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Author.php';

    // Instantiate DB and connect
    $database = new Database();
    // connect function in Database.php
    $db = $database->connect();

    // Instantiate author object
    $author = new Author($db);

    // Author read query
    $result = $author->read();
    // Get row count
    $num = $result->rowCount();

    // Check if any authors
    if($num > 0) {
        // Quote array
        $cat_arr = array();
        $cat_arr['data'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            $cat_item = array(
                'id' => $id,
                'author' => $author,
            );

            // Push to data
            array_push($cat_arr['data'], $cat_item);
        }

        // Turn to JSON and output
        echo json_encode($cat_arr);

    } else {
        // No Quotes
        echo json_encode(
            array('message' => 'No authors found')
        );
    }