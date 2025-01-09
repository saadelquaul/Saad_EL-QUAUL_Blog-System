<?php
include '../includes/session.php';
include '../includes/Classes/User.php';

$errors = [];
if(isLoggedIn())
{
    header('Location: home.php');
    exit;
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['email'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $user = User::getUserByEmail($email);
    
    if ($user) {
        if ($user->CheckPassword($password)) {
            $user->fillSession();

            if($_SESSION['role'] == 'admin') {
                header('Location: dashboard.php');
            }else {
                header('Location: home.php');
            }
            exit;
        } else {
            $errors[] = 'Invalid email or password.';
        }
    } else {
        $errors[] = 'Invalid email or password.';
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
    <div class="container" style="place-self: start; margin-left: 10%;">
    <div class="registration-container">
        <h2>Log In</h2>

        <?php if (!empty($errors)): ?>
            <div class="error">
                <?php foreach ($errors as $error): ?>
                    <p><?= htmlspecialchars($error) ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <form action="login.php" method="POST">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Enter your Email" required>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" placeholder="Enter your Password" name="password" required>
            </div>

            <button type="submit" class="submit-btn">Log in</button>
        </form>

        <div class="login-link">
            <p>Don't have an account? <a href="register.php">Register now</a></p>
        </div>
    </div>
    </div>
    
    <?php include '../includes/footer.php' ?>
</body>
</html>
