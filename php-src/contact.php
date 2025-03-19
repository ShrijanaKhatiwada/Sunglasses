<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
       body {
    font-family: 'Roboto', sans-serif;
    margin: 0;
    padding: 0;
    background-color: #a4cac7;
    color: #333;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

/* Container Styling */
.container {
    max-width: 900px;
    width: 100%;
    padding: 20px;
    background-color: #d8e3e2;
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    display: flex;
    gap: 20px;
}

/* Left Section Styling */
.left-side {
    width: 70%;
    padding: 20px;
}

h1 {
    color: #14cae6;
    font-size: 2rem;
    margin-bottom: 20px;
}

.form-group {
    margin-bottom: 20px;
}

.form-group label {
    display: block;
    font-weight: bold;
    color: #333;
    margin-bottom: 5px;
    font-size: 14px;
}

.form-group input[type="text"],
.form-group input[type="email"] {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;
    font-size: 14px;
    background-color: #f9f9f9;
    color: #333;
    transition: border-color 0.3s ease;
}

.form-group input:focus {
    border-color: #4c61af;
    outline: none;
}

.form-group button {
    padding: 10px 20px;
    background-color: #5ea6ae;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
    width: 100%;
    transition: background-color 0.3s;
}

.form-group button:hover {
    background-color: #4e6aa1;
}

/* Right Section Styling */
.contact-info {
    width: 30%;
    padding: 20px;
    background-color: #f4f4f4;
    border-radius: 10px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    text-align: left;
}

.contact-info h2 {
    color: #0c0c0c;
    font-size: 1.5rem;
    margin-bottom: 15px;
}

.contact-info p {
    color: #555;
    margin: 10px 0;
    font-size: 14px;
    display: flex;
    align-items: center;
    gap: 8px;
}

.contact-info p i {
    color: #2fe0e6;
}

/* Back to Home Button */
.back-to-home {
    position: absolute;
    top: 20px;
    left: 20px;
}

.back-to-home button {
    padding: 10px 15px;
    background-color: #13010c;
    color: #f7f2f2;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 14px;
    transition: background-color 0.3s;
}

.back-to-home button:hover {
    background-color: #3a3c3c;
    color: rgb(236, 228, 228);
}

    </style>
</head>
<body>

<div class="container">
    <div class="left-side">
        <h1>Contact Us</h1>
        <form id="contactForm" action="submit_contact.php" method="POST">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="address">Address:</label>
                <input type="text" id="address" name="address" required>
            </div>
            <div class="form-group">
                <label for="phone">Phone:</label>
                <input type="text" id="phone" name="phone" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <button type="submit">Submit</button>
            </div>
        </form>
    </div>
    <div class="contact-info">
        <h2>Contact Information</h2>
        <p><i class="fa fa-phone"></i> Phone 1: 9856763345</p>
        <p><i class="fa fa-phone"></i> Phone 2: 9810102255</p>
        <p><i class="fa fa-envelope"></i> Email: pubgheaven@gmail.com</p>
    </div>
    <div class="back-to-home">
        <button onclick="window.location.href = 'index.php';">Back to Home</button>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Get the contact form
        var contactForm = document.getElementById('contactForm');
        
        // Add submit event listener to the form
        contactForm.addEventListener('submit', function(event) {
            // Prevent the default form submission
            event.preventDefault();
            
            // Show the alert message
            alert('Thank you for contacting us.');
            
            // Reset the form fields
            contactForm.reset();
            
            // Redirect to homepage
            window.location.href = 'customer_index.php';
        });
    });
</script>

</body>
</html>
