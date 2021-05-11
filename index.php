<?php
    require('config/Database.php');
    require('models/Quote.php');
    require('models/Author.php');
    require('models/Category.php');

    $quote = filter_input(INPUT_POST, 'quote', FILTER_VALIDATE_INT);
    $authorId = filter_input(INPUT_POST, 'authorId', FILTER_VALIDATE_INT);
    $categoryId = filter_input(INPUT_POST, 'categoryId', FILTER_VALIDATE_INT);

    $quote_id = filter_input(INPUT_POST, 'quote_id', FILTER_VALIDATE_INT);
    if (!$quote_id) {
        $quote_id = filter_input(INPUT_GET, 'quote_id', FILTER_VALIDATE_INT);
    }

    $action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);
    if (!$action) {
        $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
        if (!$action) {
            $action = 'get_quotes_by_id';
        }
    }