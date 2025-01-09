<?php
include '../includes/Classes/User.php';
include '../includes/session.php';

if(isLoggedIn())
{
    header('Location: home.php');
    exit;
}
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['username']))
{
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $ConfirmPassowrd = $_POST['confirm_password'];
     $errors = [] ;

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format";
    }

    if (strlen($password) < 8) {
        $errors[] = "Password must be at least 8.";
        
    }
    
    if ($password!= $ConfirmPassowrd) {
        $errors[] = "Passwords do not match";
    }

    if(empty($errors)) {
        if(User::create($username, $email, $password, $errors)){

            header('Location:../templates/login.php');
            exit;
        }else {
            $errors[] = "Registration failed";
        }
    }

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/register.css">

    <title>Register</title>
    
</head>
<body>
    <?php include '../includes/header.php' ?>
    <div class="container">
    <div class="registration-container">
        <h2>Create an Account</h2>

        <?php if (!empty($errors)): ?>
            <div class="error">
                <?php foreach ($errors as $error): ?>
                    <p><?= htmlspecialchars($error) ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <form action="register.php" method="POST">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" placeholder="Enter your Username" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Enter your Email"  required>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" placeholder="Enter your Password" name="password" required>
            </div>

            <div class="form-group">
                <label for="confirm_password">Confirm Password</label>
                <input type="password" id="confirm_password" placeholder="Confirm your Password" name="confirm_password" required>
            </div>

            <button type="submit" class="submit-btn">Register</button>
        </form>

        <div class="login-link">
            <p>Already have an account? <a href="login.php">Log in</a></p>
        </div>
    </div>
    </div>
    
    <?php include '../includes/footer.php' ?>
</body>
</html>
