<?php

require_once '../includes/Database.php';

class User {

    private $id;
    private $username;
    private $email;
    private $password;
    private $errors = array();

    public function __construct(?array $data = NULL) {
        if ($data) {
            $this->id = isset($data['id']) ? $data['id'] : null;
            $this->username = isset($data['username']) ? $data['username'] : null;
            $this->email = isset($data['email']) ? $data['email'] : null;
            $this->password = isset($data['password']) ? $data['password'] : null;
        } else {
            $this->id = null;
            $this->username = null;
            $this->email = null;
            $this->password = null;
        }
    }



    public static function create($username, $email, $password,array $errors) {
        $db = Database::getInstance();

        // Check if email exists
        if (self::getUserByEmail($email)) {
            $errors[] = 'Email already exists';
            return false;
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $query = "INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, ?)";
        $params = array($username, $email, $hashedPassword, 'user');

        // Execute the query
        $result = $db->execute($query, $params);

        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public static function getUserByUsername($username) {
        $db = Database::getInstance();
        $query = "SELECT * FROM users WHERE username = ? LIMIT 1";
        $params = array($username);
        $user = $db->fetchOne($query, $params);

        if ($user) {
            return new self($user);
        } else {
            return null;
        }
    }

    public static function getUserByEmail($email) {
        $db = Database::getInstance();
        $query = "SELECT * FROM users WHERE email = ? LIMIT 1";
        $params = array($email);
        $user = $db->fetchOne($query, $params);

        if ($user) {
            return new self($user);
        } else {
            return null;
        }
    }

    public static function getUserById($id) {
        $db = Database::getInstance();
        $query = "SELECT * FROM users WHERE id = ? LIMIT 1";
        $params = array($id);
        $user = $db->fetchOne($query, $params);

        if ($user) {
            return new self($user);
        } else {
            return null;
        }
    }

    public function update($data) {
        // Check if username or email has changed and check for uniqueness
        if (isset($data['username']) && $data['username'] != $this->username) {
            if (self::getUserByUsername($data['username'])) {
                $this->errors[] = 'Username already exists.';
                return false;
            }
        }

        if (isset($data['email']) && $data['email'] != $this->email) {
            if (self::getUserByEmail($data['email'])) {
                $this->errors[] = 'Email already exists.';
                return false;
            }
        }

        // Hash the password if it's being updated
        if (isset($data['password'])) {
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        }

        // Prepare the update query
        $set = '';
        $params = array();
        foreach ($data as $key => $value) {
            $set .= "$key = ?, ";
            $params[] = $value;
        }
        $set = rtrim($set, ', ');
        $query = "UPDATE users SET $set WHERE id = ?";
        $params[] = $this->id;

        // Execute the query
        $db = Database::getInstance();
        $result = $db->execute($query, $params);

        if ($result) {
            // Update the object properties
            foreach ($data as $key => $value) {
                if (property_exists($this, $key)) {
                    $this->$key = $value;
                }
            }
            return true;
        } else {
            return false;
        }
    }

    public function delete() {
        $db = Database::getInstance();
        $query = "DELETE FROM users WHERE id = ?";
        $params = array($this->id);
        $result = $db->execute($query, $params);

        if ($result) {
            return true;
        } else {
            return false;
        }
    }

}
?>