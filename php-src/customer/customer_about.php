<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Sunglasses</title>
    <style>
        /* Global Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f9f9f9;
            color: #333;
            line-height: 1.6;
            margin: 0;
        }

        /* Header Styles */
        header {
            background-color: #1fb0e5;
            padding: 20px;
            text-align: center;
        }

        header h1 {
            font-size: 2.5rem;
            color: #fff;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* About Section */
        .about-container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 70vh;
            padding: 20px;
        }

        .about-content {
            background-color: #fff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            max-width: 800px;
            text-align: center;
        }

        .about-content h2 {
            font-size: 2rem;
            color: #7699ad;
            margin-bottom: 15px;
        }

        .about-content p {
            font-size: 1.2rem;
            color: #555;
            margin-bottom: 20px;
        }

        .shop-now {
            background-color: #5d8edd;
            color: #fff;
            padding: 10px 30px;
            font-size: 1rem;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .shop-now:hover {
            background-color: #7875bc;
        }

        /* Footer Styles */
        footer {
            background-color: #35cec4;
            color: #300202;
            text-align: center;
            padding: 10px 0;
            font-size: 0.9rem;
        }

        footer p {
            margin: 0;
        }
    </style>
</head>
<body>
    <header>
        <h1>About Us</h1>
    </header>

    <section class="about-container">
        <div class="about-content">
            <h2>Welcome to Sunglasses</h2>
            <p>
                At Sunglasses, we offer a curated selection of stylish and high-quality sunglasses to suit every taste and occasion.
                Our collection is designed to protect your eyes while enhancing your look with our premium eyewear. Whether you're
                going for a casual day out or attending a formal event, our sunglasses are the perfect accessory.
            </p>
            <a href="shop.php"><button class="shop-now">Shop Now</button></a>
        </div>
    </section>

    <footer>
        <p>© 2024 Sunglasses. All rights reserved.</p>
    </footer>
</body>
</html>
