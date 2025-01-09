<?php
include '../includes/session.php';
if(isLoggedIn())
{
    header('Location: home.php');
    exit;
}else {
    header('Location: login.php');
    exit;
}
if(isset($_GET['action']) && $_GET['action'] == 'lg'){
    logoutUser();
    header('Location: login.php');
}
?>