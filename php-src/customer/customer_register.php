<?php
require_once "../connection.php";

if(!empty($_POST)){ 
    $name=$_POST['name'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    $address=$_POST['address'];
    $phonenumber=$_POST['phonenumber'];
    
    // Validation
    $errors = [];
    if(empty($name)) {
        $errors['name'] = "Name is required";
    }

    if(empty($email)) {
        $errors['email'] = "Email is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Invalid email format";
    }

    if(empty($password)) {
        $errors['password'] = "Password is required";
    }elseif(strlen($password)<8){
        $errors['password']="Password must be more than 8 characters";
    }
    if(empty($address)) {
        $errors['address'] = "Address is required";
    }

    if(empty($phonenumber)) {
        $errors['phonenumber'] = "Phone number is required";
    } elseif (!preg_match("/^98[0-9]{8}$/", $phonenumber)) {
        $errors['phonenumber'] = "Invalid phone number format";
    }

    if(empty($errors)) {
        // Proceed with insertion
        $password = md5($password); // MD5 hash the password
        $sql = "INSERT INTO customer (name, email, password, address, phonenumber) VALUES ('$name', '$email', '$password', '$address', '$phonenumber')";
        $result=mysqli_query($conn,$sql);
        if($result){
            echo "<script>alert('Registration successful');
            window.location.href = 'customer_login.php';</script>";
            
        }
       
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Shade Paradise</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body class="bg-gray-100 font-sans">
    <div class="min-h-screen flex items-center justify-center p-4">
        <div class="bg-white rounded-xl shadow-xl overflow-hidden max-w-4xl w-full flex flex-col md:flex-row">
            <div class="md:w-1/2 hidden md:block relative">
                <img src="../images/content.jpg" alt="Shade Paradise" class="absolute inset-0 w-full h-full object-cover">
                <div class="absolute inset-0 bg-black bg-opacity-40 flex items-end p-8">
                    <div>
                        <h2 class="text-white text-3xl font-bold mb-2">Shade Paradise</h2>
                        <p class="text-gray-200">Join us for premium eyewear experiences</p>
                    </div>
                </div>
            </div>
            <div class="md:w-1/2 p-8 md:p-12">
                <div class="mb-8 text-center">
                    <h1 class="text-3xl font-bold text-gray-900 mb-2">Create Account</h1>
                    <p class="text-gray-600">Sign up to get started</p>
                </div>
                
                <form action="" method="post">
                    <div class="mb-4">
                        <label for="name" class="block text-gray-700 text-sm font-semibold mb-2">Full Name</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-user text-gray-400"></i>
                            </div>
                            <input 
                                type="text" 
                                id="name"
                                name="name" 
                                placeholder="John Doe"
                                value="<?php echo htmlspecialchars($_POST['name'] ?? '', ENT_QUOTES); ?>"
                                class="w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                            >
                        </div>
                        <?php if(isset($errors['name'])): ?>
                            <p class="mt-1 text-sm text-red-600"><?= $errors['name']; ?></p>
                        <?php endif; ?>
                    </div>
                    
                    <div class="mb-4">
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
                        <?php if(isset($errors['email'])): ?>
                            <p class="mt-1 text-sm text-red-600"><?= $errors['email']; ?></p>
                        <?php endif; ?>
                    </div>

                    <div class="mb-4">
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
                        <?php if(isset($errors['password'])): ?>
                            <p class="mt-1 text-sm text-red-600"><?= $errors['password']; ?></p>
                        <?php endif; ?>
                    </div>

                    <div class="mb-4">
                        <label for="address" class="block text-gray-700 text-sm font-semibold mb-2">Address</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fa-sharp fa-solid fa-location-dot text-gray-400"></i>
                            </div>
                            <input 
                                type="text" 
                                id="address"
                                name="address" 
                                placeholder="Your address"
                                value="<?php echo htmlspecialchars($_POST['address'] ?? '', ENT_QUOTES); ?>"
                                class="w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                            >
                        </div>
                        <?php if(isset($errors['address'])): ?>
                            <p class="mt-1 text-sm text-red-600"><?= $errors['address']; ?></p>
                        <?php endif; ?>
                    </div>

                    <div class="mb-6">
                        <label for="phonenumber" class="block text-gray-700 text-sm font-semibold mb-2">Phone Number</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fa-solid fa-phone text-gray-400"></i>
                            </div>
                            <input 
                                type="text" 
                                id="phonenumber"
                                name="phonenumber" 
                                placeholder="98xxxxxxxx"
                                value="<?php echo htmlspecialchars($_POST['phonenumber'] ?? '', ENT_QUOTES); ?>"
                                class="w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                            >
                        </div>
                        <?php if(isset($errors['phonenumber'])): ?>
                            <p class="mt-1 text-sm text-red-600"><?= $errors['phonenumber']; ?></p>
                        <?php endif; ?>
                    </div>
               
                    <button type="submit" class="w-full bg-blue-600 text-white py-2 px-4 rounded-lg font-semibold hover:bg-blue-700 transition duration-200">
                        Create Account
                    </button>
                    
                    <p class="mt-6 text-center text-gray-600">
                        Already have an account? 
                        <a href="customer_login.php" class="text-blue-600 font-semibold hover:underline">Sign In</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
</body>
</html>

