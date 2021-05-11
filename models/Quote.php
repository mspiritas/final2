<?php
    class Quote {
        // DB info
        private $conn;
        private $table = 'quotes';
       
        // Table properties
        public $id;
        public $quote;
        public $author;
        public $authorId;
        public $category;
        public $categoryId;

        // Constructor with DB
        public function __construct($db) {
            $this->conn = $db;
        }

        // Get quotes
        public function read() {
            // Create query
            $query = 'SELECT q.id, q.quote, a.author, c.category
                      FROM ' . $this->table . ' q
                      LEFT JOIN
                        authors a ON q.authorId = a.id
                      LEFT JOIN
                        categories c ON q.categoryId = c.id
                      ORDER BY q.id';

            // Prepare statement
            $stmt = $this->conn->prepare($query);

            // Execute query
            $stmt->execute();

            return $stmt;
                      
        }

        // Read single quote
        public function read_single() {
            // Create query
            $query = 'SELECT quote
                      FROM ' . $this->table . '
                      WHERE id = ?
                      LIMIT 0,1';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Bind ID
        $stmt->bindParam(1, $this->id);
            
        // Execute query
        $stmt->execute();
            
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
            
        // Set properties

        $this->quote = $row['quote'];

        }

        /*
        // Read single quote by authorId
        public function read_single_by_authorId() {
          // Create query
          $query = 'SELECT quote
                    FROM ' . $this->table . '
                    LEFT JOIN
                      authors a ON q.authorId = a.id
                    WHERE a.id = ?
                    LIMIT 0,1';
    
        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Bind ID
        $stmt->bindParam(1, $this->id);
          
        // Execute query
        $stmt->execute();
          
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
          
        // Set properties

        $this->quote = $row['quote'];

        }*/

      // Create category
      public function create() {
      // Create query
      $query = 'INSERT INTO ' . $this->table . '
                SET
                  quote = :quote;
                  authorId = :authorId,
                  categoryId= :categoryId';

      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Clean data
      $this->quote = htmlspecialchars(strip_tags($this->quote));
      $this->authorId = htmlspecialchars(strip_tags($this->authorId));
      $this->categoryId = htmlspecialchars(strip_tags($this->categoryId));
      
      // Bind data
      $stmt->bindParam(':quote', $this->quote);
      $stmt->bindParam(':authorId', $this->authorId);
      $stmt->bindParam(':categoryId', $this->categoryId);
      
      // Execute query
      if($stmt->execute()) {
          return true;
      }
      //Print error
      printf("Error: %s.\n", $stmt->error);

      return false;
      }

    // Update quote
    public function update() {
        // Create query
        $query = 'UPDATE ' . $this->table . '
                  SET
                    id = :id,
                    quote = :quote,
                    authorId = :authorId,
                    categoryId = :categoryId
                  WHERE id = :id';
                    
            // Prepare statement
            $stmt = $this->conn->prepare($query);

            // Clean data
            $this->quote = htmlspecialchars(strip_tags($this->quote));
            $this->authorId = htmlspecialchars(strip_tags($this->authorId));
            $this->categoryId = htmlspecialchars(strip_tags($this->categoryId));
            $this->id = htmlspecialchars(strip_tags($this->id));

            // Bind data
            $stmt->bindParam(':quote', $this->quote);
            $stmt->bindParam(':authorId', $this->authorId);
            $stmt->bindParam(':categoryId', $this->categoryId);
            $stmt->bindParam(':id', $this->id);

            // Execute query
            if($stmt->execute()) {
                return TRUE;
            }

            // Print error
            printf("Error: %s.\n", $stmt->error);
            return FALSE;
            }

    // Delete quote
    public function delete() {
            // Create query
            $query = 'DELETE FROM ' . $this->table .'
                    WHERE id = :id';

            // Prepare statement
            $stmt = $this->conn->prepare($query);

            // Clean data
            $this->id = htmlspecialchars(strip_tags($this->id));

            // Bind data
            $stmt->bindParam(':id', $this->id);

            // Execute query
            if($stmt->execute()) {
                return true;
            }

            // Print error
            printf("Error: %s.\n", $stmt->error);

            return false;
        }

        function get_quotes_by_id() {
          global $db;
          $query = 'SELECT q.quote, a.author, c.category
                    FROM quotes q
                    LEFT JOIN authors a
                    ON q.authorId = a.id
                    LEFT JOIN categories c
                    ON q.categoryId = c.id
                    ORDER BY id';
          $statement = $db->prepare($query);
          $statement->execute();
          $quotes = $statement->fetchAll();
          $statement->closeCursor();
          return $quotes;
      }
    }