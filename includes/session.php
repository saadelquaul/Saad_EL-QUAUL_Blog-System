<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


function setSession($key, $value) {
    $_SESSION[$key] = $value;
}


function getSession($key) {
    return isset($_SESSION[$key]) ? $_SESSION[$key] : null;
}


function hasSession($key) {
    return isset($_SESSION[$key]);
}


function unsetSession($key) {
    if (isset($_SESSION[$key])) {
        unset($_SESSION[$key]);
    }
}


function destroySession() {
    session_unset(); // Remove all session variables
    session_destroy(); // Destroy the session
}


function isLoggedIn() {
    return hasSession('user_id'); 
}


function loginUser($userId, $username) {
    setSession('user_id', $userId);
    setSession('username', $username);
}

function logoutUser() {
    destroySession();
}
?>
