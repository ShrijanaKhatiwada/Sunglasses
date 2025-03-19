<?php
require_once '../connection.php';

$csql="SELECT * FROM customer ";
$cresult=mysqli_query($conn,$csql);

$psql="SELECT * FROM product ";
$presult=mysqli_query($conn,$psql);

$osql="SELECT * FROM orders";
$oresult=mysqli_query($conn,$osql);

$total_customer=mysqli_num_rows($cresult);
$total_product=mysqli_num_rows($presult);
$total_order=mysqli_num_rows($oresult);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Shade Paradise</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body class="bg-gray-100 font-sans">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div id="sidebar" class="bg-gray-900 text-white w-64 min-h-screen flex-shrink-0 transition-all duration-300 ease-in-out">
            <div class="p-4 border-b border-gray-700">
                <h2 class="text-xl font-bold">Admin Dashboard</h2>
            </div>
            <nav class="mt-6">
                <ul>
                    <li class="px-4 py-3 hover:bg-gray-800 rounded-lg mx-2 mb-1 transition">
                        <a href="admin_dashboard.php" class="flex items-center">
                            <i class="fas fa-home mr-3"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="px-4 py-3 hover:bg-gray-800 rounded-lg mx-2 mb-1 transition">
                        <a href="add_product.php" class="flex items-center">
                            <i class="fas fa-plus mr-3"></i>
                            <span>Add Products</span>
                        </a>
                    </li>
                    <li class="px-4 py-3 hover:bg-gray-800 rounded-lg mx-2 mb-1 transition">
                        <a href="user.php" class="flex items-center">
                            <i class="fas fa-users mr-3"></i>
                            <span>Users</span>
                        </a>
                    </li>
                    <li class="px-4 py-3 hover:bg-gray-800 rounded-lg mx-2 mb-1 transition">
                        <a href="admin_order.php" class="flex items-center">
                            <i class="fas fa-shopping-bag mr-3"></i>
                            <span>Orders</span>
                        </a>
                    </li>
                    <li class="px-4 py-3 hover:bg-gray-800 rounded-lg mx-2 mb-1 transition">
                        <a href="products.php" class="flex items-center">
                            <i class="fas fa-glasses mr-3"></i>
                            <span>Products</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>

        <!-- Main Content -->
        <div id="main-content" class="flex-1 transition-all duration-300 ease-in-out">
            <!-- Header -->
            <header class="bg-white shadow-sm">
                <div class="flex items-center justify-between px-6 py-4">
                    <button id="toggle-btn" class="text-gray-500 focus:outline-none lg:hidden">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                    <div class="flex items-center">
                        <h1 class="text-xl font-semibold text-gray-800">Welcome, Admin</h1>
                    </div>
                    <div>
                        <a href="../index.php" class="text-blue-600 hover:text-blue-800">
                            <i class="fas fa-sign-out-alt mr-1"></i> Logout
                        </a>
                    </div>
                </div>
            </header>

            <!-- Dashboard Content -->
            <div class="p-6">
                <h2 class="text-2xl font-semibold text-gray-800 mb-6">Dashboard Overview</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Users Card -->
                    <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition duration-300">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-700 mb-2">Total Users</h3>
                                <p class="text-3xl font-bold text-blue-600"><?=$total_customer?></p>
                            </div>
                            <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                                <i class="fas fa-users text-2xl"></i>
                            </div>
                        </div>
                        <div class="mt-4">
                            <a href="user.php" class="text-blue-600 hover:text-blue-800 text-sm flex items-center">
                                View Details
                                <i class="fas fa-arrow-right ml-1"></i>
                            </a>
                        </div>
                    </div>

                    <!-- Products Card -->
                    <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition duration-300">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-700 mb-2">Total Products</h3>
                                <p class="text-3xl font-bold text-green-600"><?=$total_product?></p>
                            </div>
                            <div class="p-3 rounded-full bg-green-100 text-green-600">
                                <i class="fas fa-glasses text-2xl"></i>
                            </div>
                        </div>
                        <div class="mt-4">
                            <a href="products.php" class="text-green-600 hover:text-green-800 text-sm flex items-center">
                                View Details
                                <i class="fas fa-arrow-right ml-1"></i>
                            </a>
                        </div>
                    </div>

                    <!-- Orders Card -->
                    <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition duration-300">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-700 mb-2">Total Orders</h3>
                                <p class="text-3xl font-bold text-purple-600"><?=$total_order?></p>
                            </div>
                            <div class="p-3 rounded-full bg-purple-100 text-purple-600">
                                <i class="fas fa-shopping-bag text-2xl"></i>
                            </div>
                        </div>
                        <div class="mt-4">
                            <a href="admin_order.php" class="text-purple-600 hover:text-purple-800 text-sm flex items-center">
                                View Details
                                <i class="fas fa-arrow-right ml-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('toggle-btn').addEventListener('click', function() {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('main-content');
            
            if (sidebar.classList.contains('hidden')) {
                sidebar.classList.remove('hidden');
                sidebar.classList.add('block');
                mainContent.classList.remove('ml-0');
            } else {
                sidebar.classList.add('hidden');
                sidebar.classList.remove('block');
                mainContent.classList.add('ml-0');
            }
        });

        // Check screen size and hide sidebar on mobile by default
        function checkScreenSize() {
            if (window.innerWidth < 1024) {
                document.getElementById('sidebar').classList.add('hidden');
                document.getElementById('main-content').classList.add('ml-0');
            } else {
                document.getElementById('sidebar').classList.remove('hidden');
                document.getElementById('main-content').classList.remove('ml-0');
            }
        }

        // Run on page load
        checkScreenSize();
        
        // Run when window is resized
        window.addEventListener('resize', checkScreenSize);
    </script>
</body>
</html>
