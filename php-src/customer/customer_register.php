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
    <title>Login</title>
    <link rel="stylesheet" href="../customer/css/customer_register.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="container">
        <div class="image">
            <img src="../images/content.jpg" alt="" class="src">
        </div>
        <div class="content">
          
            <div class="Registration">
                <p>Registration Page</p>
            </div>
            <form action=""method="post">
                <div class="input-container">
                    <i class="fas fa-user"></i>
                    <input type="name" name="name" placeholder="Name">
                    <?php if(isset($errors['name'])): ?>
                    <span class="error"><?= $errors['name']; ?></span>
                <?php endif; ?>
                </div>
                
                <div class="input-container">
                    <i class="fas fa-envelope"></i>
                    <input type="email" name="email" placeholder="Email">
                    <?php if(isset($errors['email'])): ?>
                    <span class="error"><?= $errors['email']; ?></span>
                <?php endif; ?>
                </div>

                <div class="input-container">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="password" placeholder="Password">
                    <?php if(isset($errors['password'])): ?>
                    <span class="error"><?= $errors['password']; ?></span>
                <?php endif; ?>
                </div>

                <div class="input-container">
                    <i class="fa-sharp fa-solid fa-location-dot"></i>
                    <input type="address" name="address" placeholder="Address">
                    <?php if(isset($errors['address'])): ?>
                    <span class="error"><?= $errors['address']; ?></span>
                <?php endif; ?>
                </div>

                <div class="input-container">
                    <i class="fa-solid fa-phone"></i>
                    <input type="phonenumber" name="phonenumber" placeholder="Phonenumber">
                    <?php if(isset($errors['phonenumber'])): ?>
                    <span class="error"><?= $errors['phonenumber']; ?></span>
                <?php endif; ?>
                </div>
               
               
               <a href=""> <button>Register</button></a>
                <h4>Already Have an Account?<a href="customer_login.php">Login</a></h4>
            </form>
        </div>
    </div>
</body>
</html>

