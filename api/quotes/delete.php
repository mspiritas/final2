<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: DELETE');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Quote.php';

  // Instantiate & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate quote object
  $quote = new Quote($db);

  // Get raw data
  $data = json_decode(file_get_contents("php://input"));

  // Set ID to delete
  $quote->id = $data->id;

  // Delete quote
  if($quote->delete()) {
    echo json_encode(
      array('message' => 'Quote deleted')
    );
  } else {
    echo json_encode(
      array('message' => 'Quote not deleted')
    );
  }