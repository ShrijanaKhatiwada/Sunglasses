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
    <title>Login - Shade Paradise</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body class="bg-gray-100 font-sans">
    <?php if (isset($_SESSION['error'])): ?>
        <script>
            alert('<?php echo $_SESSION['error']; unset($_SESSION['error']); ?>');
        </script>
    <?php endif; ?>

    <div class="min-h-screen flex items-center justify-center p-4">
        <div class="bg-white rounded-xl shadow-xl overflow-hidden max-w-4xl w-full flex flex-col md:flex-row">
            <div class="md:w-1/2 hidden md:block relative">
                <img src="../images/content.jpg" alt="Shade Paradise" class="absolute inset-0 w-full h-full object-cover">
                <div class="absolute inset-0 bg-black bg-opacity-40 flex items-end p-8">
                    <div>
                        <h2 class="text-white text-3xl font-bold mb-2">Shade Paradise</h2>
                        <p class="text-gray-200">Elevate your style with premium eyewear</p>
                    </div>
                </div>
            </div>
            <div class="md:w-1/2 p-8 md:p-12">
                <div class="mb-8 text-center">
                    <h1 class="text-3xl font-bold text-gray-900 mb-2">Welcome Back</h1>
                    <p class="text-gray-600">Sign in to access your account</p>
                </div>
                
                <form action="" method="post">
                    <div class="mb-6">
                        <label for="email" class="block text-gray-700 text-sm font-semibold mb-2">Email Address</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-envelope text-gray-400"></i>
                            </div>
                            <input 
                                type="email" 
                                id="email"
                                name="email" 
                                placeholder="your@email.com" 
                                value="<?php echo htmlspecialchars($_POST['email'] ?? '', ENT_QUOTES); ?>"
                                class="w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                            >
                        </div>
                        <?php if (isset($_SESSION['validation_errors']['email'])): ?>
                            <p class="mt-1 text-sm text-red-600"><?= $_SESSION['validation_errors']['email']; unset($_SESSION['validation_errors']['email']); ?></p>
                        <?php endif; ?>
                    </div>

                    <div class="mb-6">
                        <label for="password" class="block text-gray-700 text-sm font-semibold mb-2">Password</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-lock text-gray-400"></i>
                            </div>
                            <input 
                                type="password"
                                id="password" 
                                name="password" 
                                placeholder="••••••••" 
                                class="w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                            >
                        </div>
                        <?php if (isset($_SESSION['validation_errors']['password'])): ?>
                            <p class="mt-1 text-sm text-red-600"><?= $_SESSION['validation_errors']['password']; unset($_SESSION['validation_errors']['password']); ?></p>
                        <?php endif; ?>
                    </div>

                    <button type="submit" class="w-full bg-blue-600 text-white py-2 px-4 rounded-lg font-semibold hover:bg-blue-700 transition duration-200">
                        Sign In
                    </button>
                    
                    <p class="mt-6 text-center text-gray-600">
                        Don't have an account? 
                        <a href="customer_register.php" class="text-blue-600 font-semibold hover:underline">Sign Up</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
</body>
</html>

