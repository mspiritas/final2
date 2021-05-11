<?php
    class Category {
        // DB info
        private $conn;
        private $table = 'categories';
       
        // Table properties
        public $category;

        // Constructor with DB
        public function __construct($db) {
            $this->conn = $db;
        }

        // Get categories
        public function read() {
            // Create query
            $query = 'SELECT id, category
                      FROM ' . $this->table . '
                      ORDER BY id';

            // Prepare statement
            $stmt = $this->conn->prepare($query);

            // Execute query
            $stmt->execute();

            return $stmt;
                      
        }

        // Read single category
        public function read_single() {
            // Create query
            $query = 'SELECT id, category
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
        $this->id = $row['id'];
        $this->category = $row['category'];
        }

    // Create category
    public function create() {
        // Create query
        $query = 'INSERT INTO ' . $this->table . '
                  SET
                    category = :category';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->category = htmlspecialchars(strip_tags($this->category));        
    
        // Bind data
        $stmt->bindParam(':category', $this->category);
            
        // Execute query
        if($stmt->execute()) {
            return true;
        }
        //Print error
        printf("Error: %s.\n", $stmt->error);

        return false;
        }

    // Delete category
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

    // Update category
    public function update() {
        // Update query
        $query = 'UPDATE ' . $this->table . '
                  SET
                    category = :category
                    WHERE id = :id';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->category = htmlspecialchars(strip_tags($this->category));        
        $this->id = htmlspecialchars(strip_tags($this->id));        
    
        // Bind data
        $stmt->bindParam(':category', $this->category);
        $stmt->bindParam(':id', $this->id);
            
        // Execute query
        if($stmt->execute()) {
            return true;
        }
        //Print error
        printf("Error: %s.\n", $stmt->error);

        return false;
        }

        // Get categories
        public function get_categories() {
            global $db;
            $query = 'SELECT * FROM categories ORDER by id';
            $statement = $db->prepare($query);
            $statement->execute();
            $makes = $statement->fetchAll();
            $statement->closeCursor();
            return $categories;
        }

        public function get_quote_category() {
            global $db;
            $query = 'SELECT * FROM categories WHERE id = :categoryId';
            $statement = $db->prepare($query);
            $statement->bindValue(':categoryId', $categoryId);
            $statement->execute();
            $make = $statement->fetch();
            $statement->closeCursor();
            $category_name = $category['category'];
            return $category_name;
        }
}