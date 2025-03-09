<?php
ob_start();
session_start(); 
require_once "../connection.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST)) {
    $email = trim($_POST['email']);  // Trim spaces
    $password = $_POST['password'];

    // Validation
    $errors = [];
    if (empty($email)) {
        $errors['email'] = "Email is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Invalid email format";
    }

    if (empty($password)) {
        $errors['password'] = "Password is required";
    } elseif (strlen($password) < 8) {
        $errors['password'] = "Password must be more than 8 characters";
    }

    if (empty($errors)) {
        // Sanitize input
        $email = mysqli_real_escape_string($conn, $email);
        $hashed_password = md5($password);  // Hash the password

        // SQL query
        $sql = "SELECT * FROM customer WHERE email = '$email' AND password = '$hashed_password'";
        $result = mysqli_query($conn, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
            $user = mysqli_fetch_assoc($result);

            // Set session variables
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['users_name'] = $user['name'];
            $_SESSION['is_login'] = true;

            // Redirect to customer index
            header('Location: customer_index.php');
            exit;
        } else {
            $_SESSION['error'] = "Invalid email or password";
        }
    } else {
        // Store validation errors
        $_SESSION['validation_errors'] = $errors;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../customer/css/customer_login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="container">
        <?php if (isset($_SESSION['error'])): ?>
            <script>
                alert('<?php echo $_SESSION['error']; unset($_SESSION['error']); ?>');
            </script>
        <?php endif; ?>

        <div class="image">
            <img src="../images/content.jpg" alt="Shade Paradise">
        </div>
        <div class="content">
            <h1 class="main-heading">Shade Paradise</h1>
            <p class="welcome-message">Welcome to Shade Paradise</p>
            <form action="" method="post">
                <div class="input-container">
                    <i class="fas fa-envelope"></i>
                    <input type="email" name="email" placeholder="Email" value="<?php echo htmlspecialchars($_POST['email'] ?? '', ENT_QUOTES); ?>">
                    <?php if (isset($_SESSION['validation_errors']['email'])): ?>
                        <span class="error"><?= $_SESSION['validation_errors']['email']; unset($_SESSION['validation_errors']['email']); ?></span>
                    <?php endif; ?>
                </div>

                <div class="input-container">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="password" placeholder="Password">
                    <?php if (isset($_SESSION['validation_errors']['password'])): ?>
                        <span class="error"><?= $_SESSION['validation_errors']['password']; unset($_SESSION['validation_errors']['password']); ?></span>
                    <?php endif; ?>
                </div>

                <button type="submit">Login</button>
                <h4>Don't Have an Account? <a href="customer_register.php">Signup</a></h4>
            </form>
        </div>
    </div>
</body>
</html>

