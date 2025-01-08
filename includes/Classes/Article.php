<?php

class Article {
    private $conn;
    private $table_name = "articles";

    public $id;
    public $title;
    public $content;
    public $category_id;
    public $author_id;
    public $tags;  // New field for tags
    public $image; // New field for image URL
    public $created_at;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Create a new article
    public function create() {
        $query = "INSERT INTO " . $this->table_name . " 
                  SET title=:title, content=:content, category_id=:category_id, author_id=:author_id, 
                      tags=:tags, image=:image";

        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->content = htmlspecialchars(strip_tags($this->content));
        $this->category_id = htmlspecialchars(strip_tags($this->category_id));
        $this->author_id = htmlspecialchars(strip_tags($this->author_id));
        $this->tags = htmlspecialchars(strip_tags($this->tags));  // Clean tags
        $this->image = htmlspecialchars(strip_tags($this->image));  // Clean image URL

        // Bind parameters
        $stmt->bindParam(":title", $this->title);
        $stmt->bindParam(":content", $this->content);
        $stmt->bindParam(":category_id", $this->category_id);
        $stmt->bindParam(":author_id", $this->author_id);
        $stmt->bindParam(":tags", $this->tags);
        $stmt->bindParam(":image", $this->image);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // Read all articles
    public function read() {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Read a single article by ID
    public function readOne() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = :id LIMIT 0,1";
        $stmt = $this->conn->prepare($query);

        // Bind ID parameter
        $stmt->bindParam(":id", $this->id);

        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // Assign values to properties
        if ($row) {
            $this->title = $row['title'];
            $this->content = $row['content'];
            $this->category_id = $row['category_id'];
            $this->author_id = $row['author_id'];
            $this->tags = $row['tags'];
            $this->image = $row['image'];
            $this->created_at = $row['created_at'];
        }

        return $row;
    }

    // Update an article
    public function update() {
        $query = "UPDATE " . $this->table_name . " 
                  SET title = :title, content = :content, category_id = :category_id, 
                      author_id = :author_id, tags = :tags, image = :image 
                  WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->content = htmlspecialchars(strip_tags($this->content));
        $this->category_id = htmlspecialchars(strip_tags($this->category_id));
        $this->author_id = htmlspecialchars(strip_tags($this->author_id));
        $this->tags = htmlspecialchars(strip_tags($this->tags));
        $this->image = htmlspecialchars(strip_tags($this->image));

        // Bind parameters
        $stmt->bindParam(":title", $this->title);
        $stmt->bindParam(":content", $this->content);
        $stmt->bindParam(":category_id", $this->category_id);
        $stmt->bindParam(":author_id", $this->author_id);
        $stmt->bindParam(":tags", $this->tags);
        $stmt->bindParam(":image", $this->image);
        $stmt->bindParam(":id", $this->id);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // Delete an article
    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        $this->id = htmlspecialchars(strip_tags($this->id));

        // Bind the ID
        $stmt->bindParam(":id", $this->id);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
}
?>
