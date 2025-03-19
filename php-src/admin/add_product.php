<?php
require_once '../connection.php';

if(!empty($_POST)){
    $brand = $_POST['brand'];
    $color = $_POST['color'];
    $price = $_POST['price'];
    $category_id = $_POST['category_id'];
    $quantity = $_POST['quantity'];
    $description = $_POST['description'];
    $image = '';

    if (!empty($_FILES['image']['name'])) {
        $image = $_FILES['image']['name'];
        $tmp = $_FILES['image']['tmp_name'];
        $path = 'uploads/';

        move_uploaded_file($tmp, $path . $image);
    }

    $sql = "INSERT INTO product (brand, color, price, category_id, quantity, description, image) VALUES 
    ('$brand', '$color', '$price', '$category_id', '$quantity', '$description', '$image')";

    $result = mysqli_query($conn, $sql);

    if($result){
        $success_message = "Product added successfully!";
    } 
    else{
        $error_message = "Failed to add product. Please try again.";
    }
}

$categoryOptions = "";
$catsql = "SELECT * FROM category";
$catresult = $conn->query($catsql);

if ($catresult->num_rows > 0) {
    while ($row = $catresult->fetch_assoc()) {
        $categoryOptions .= "<option value='" . $row["id"] . "'>" . $row["cat_name"] . "</option>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product - Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body class="bg-gray-100 font-sans">
    <div class="min-h-screen flex flex-col">
        <!-- Admin Header -->
        <header class="bg-gray-900 text-white shadow-md">
            <div class="container mx-auto px-4 py-3">
                <div class="flex justify-between items-center">
                    <div class="flex items-center">
                        <img src="../images/sunglasses.png" alt="Shade Paradise" class="h-10 mr-3">
                        <span class="text-xl font-bold">Shade Paradise Admin</span>
                    </div>
                    <div>
                        <a href="admin_dashboard.php" class="bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-md transition">
                            <i class="fas fa-tachometer-alt mr-2"></i>Dashboard
                        </a>
                    </div>
                </div>
            </div>
        </header>

        <div class="container mx-auto px-4 py-8 flex-grow">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold text-gray-800">Add New Product</h1>
                <a href="admin_dashboard.php" class="bg-gray-200 hover:bg-gray-300 text-gray-800 py-2 px-4 rounded-md transition flex items-center">
                    <i class="fas fa-arrow-left mr-2"></i>Back to Dashboard
                </a>
            </div>

            <?php if (isset($success_message)): ?>
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
                    <p class="font-bold">Success!</p>
                    <p><?php echo $success_message; ?></p>
                </div>
            <?php endif; ?>

            <?php if (isset($error_message)): ?>
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6" role="alert">
                    <p class="font-bold">Error!</p>
                    <p><?php echo $error_message; ?></p>
                </div>
            <?php endif; ?>

            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="p-6 bg-gray-50 border-b">
                    <h2 class="text-lg font-semibold text-gray-700">Product Information</h2>
                    <p class="text-sm text-gray-600">Fill out the form below to add a new product to your inventory</p>
                </div>
                
                <form action="" method="post" enctype="multipart/form-data" class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-4">
                        <div>
                            <label for="brand" class="block text-sm font-medium text-gray-700 mb-1">Brand Name*</label>
                            <input type="text" id="brand" name="brand" required 
                                   class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                        </div>
                        
                        <div>
                            <label for="color" class="block text-sm font-medium text-gray-700 mb-1">Color*</label>
                            <input type="text" id="color" name="color" required 
                                   class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                        </div>
                        
                        <div>
                            <label for="price" class="block text-sm font-medium text-gray-700 mb-1">Price (Rs)*</label>
                            <input type="number" id="price" name="price" min="0" step="0.01" required 
                                   class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                        </div>
                        
                        <div>
                            <label for="quantity" class="block text-sm font-medium text-gray-700 mb-1">Quantity*</label>
                            <input type="number" id="quantity" name="quantity" min="0" required 
                                   class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                        </div>
                    </div>

                    <div class="space-y-4">
                        <div>
                            <label for="category_id" class="block text-sm font-medium text-gray-700 mb-1">Category*</label>
                            <select id="category_id" name="category_id" required
                                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                                <option value="">Select Category</option>
                                <?php echo $categoryOptions; ?>
                            </select>
                        </div>
                        
                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                            <textarea id="description" name="description" rows="4"
                                      class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"></textarea>
                        </div>
                        
                        <div>
                            <label for="image" class="block text-sm font-medium text-gray-700 mb-1">Product Image*</label>
                            <input type="file" id="image" name="image" accept="image/*" required
                                   class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                            <p class="mt-1 text-xs text-gray-500">Upload a clear image of the product (JPG, PNG formats)</p>
                        </div>
                    </div>

                    <div class="md:col-span-2 mt-4">
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white py-2 px-6 rounded-md font-medium transition shadow-md flex items-center">
                            <i class="fas fa-plus mr-2"></i>Add Product
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Footer -->
        <footer class="bg-gray-800 text-gray-400 py-4">
            <div class="container mx-auto px-4 text-center">
                <p>&copy; 2024 Shade Paradise Admin Panel. All rights reserved.</p>
            </div>
        </footer>
    </div>

    <!-- Preview Image Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const imageInput = document.getElementById('image');
            
            imageInput.addEventListener('change', function(e) {
                if (this.files && this.files[0]) {
                    // You could add image preview functionality here if desired
                    console.log('Image selected:', this.files[0].name);
                }
            });
        });
    </script>
</body>
</html>
