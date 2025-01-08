<?php

class Comment {
    private $conn;
    private $table_name = "comments";

    public $id;
    public $article_id;
    public $user_id;
    public $content;
    public $created_at;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . " SET article_id=:article_id, user_id=:user_id, content=:content";

        $stmt = $this->conn->prepare($query);

        $this->article_id = htmlspecialchars(strip_tags($this->article_id));
        $this->user_id = htmlspecialchars(strip_tags($this->user_id));
        $this->content = htmlspecialchars(strip_tags($this->content));

        $stmt->bindParam(":article_id", $this->article_id);
        $stmt->bindParam(":user_id", $this->user_id);
        $stmt->bindParam(":content", $this->content);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function read() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE article_id=:article_id ORDER BY created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":article_id", $this->article_id);
        $stmt->execute();
        return $stmt;
    }
}
?>
