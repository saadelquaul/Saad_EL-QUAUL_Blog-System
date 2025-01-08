<?php

// Utilities.php - Helper functions for the blog platform
function sanitizeInput($data) {
    return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8');
}

function getCategories(PDO $db) {
    $query = "SELECT id, name FROM categories ORDER BY name ASC";
    $stmt = $db->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getArticles(PDO $db, $search = '', $category_id = null) {
}
function isAuthenticated() {
    return isset($_SESSION['user_id']);
}

function redirectTo($url) {
    header("Location: $url");
    exit;
}
function handleImageUpload($file, $uploadDir = 'uploads/') {
    if ($file['error'] !== UPLOAD_ERR_OK) {
        return null;
    }

    $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
    $fileExtension = pathinfo($file['name'], PATHINFO_EXTENSION);

    if (!in_array(strtolower($fileExtension), $allowedExtensions)) {
        return null;
    }

    $uniqueFileName = uniqid() . '.' . $fileExtension;
    $destination = $uploadDir . $uniqueFileName;

    if (move_uploaded_file($file['tmp_name'], $destination)) {
        return $destination;
    }

    return null;
}

function hashPassword($password) {
    return password_hash($password, PASSWORD_BCRYPT);
}

function verifyPassword($password, $hash) {
    return password_verify($password, $hash);
}
