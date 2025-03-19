<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Shade Paradise</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700;900&family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        .font-playfair {
            font-family: 'Playfair Display', serif;
        }
        .font-montserrat {
            font-family: 'Montserrat', sans-serif;
        }
        .dashboard-card {
            transition: all 0.3s ease;
        }
        .dashboard-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
        .gradient-text {
            background: linear-gradient(to right, #3b82f6, #8b5cf6);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }
    </style>
</head>
<body class="bg-gray-50 font-montserrat">
    <div class="min-h-screen flex">
        <!-- Sidebar -->
        <div class="bg-gradient-to-b from-blue-800 to-blue-900 text-white w-64 py-6 flex flex-col hidden md:flex">
            <div class="px-6 pb-6 flex items-center border-b border-blue-700">
                <img src="../images/sunglasses.png" alt="Shade Paradise" class="h-10 mr-3">
                <h1 class="text-xl font-playfair font-bold">SHADE PARADISE</h1>
            </div>
            <div class="flex-1 px-6 py-4">
                <nav class="space-y-1">
                    <a href="admin_index.php" class="block py-2.5 px-4 rounded bg-blue-700 transition duration-200">
                        <i class="fas fa-tachometer-alt mr-2"></i> Dashboard
                    </a>
                    <a href="view_products.php" class="block py-2.5 px-4 rounded hover:bg-blue-700 transition duration-200">
                        <i class="fas fa-glasses mr-2"></i> Products
                    </a>
                    <a href="add_product.php" class="block py-2.5 px-4 rounded hover:bg-blue-700 transition duration-200">
                        <i class="fas fa-plus-circle mr-2"></i> Add Product
                    </a>
                    <a href="view_categories.php" class="block py-2.5 px-4 rounded hover:bg-blue-700 transition duration-200">
                        <i class="fas fa-tag mr-2"></i> Categories
                    </a>
                    <a href="view_orders.php" class="block py-2.5 px-4 rounded hover:bg-blue-700 transition duration-200">
                        <i class="fas fa-shopping-cart mr-2"></i> Orders
                    </a>
                    <a href="view_customers.php" class="block py-2.5 px-4 rounded hover:bg-blue-700 transition duration-200">
                        <i class="fas fa-users mr-2"></i> Customers
                    </a>
                </nav>
            </div>
            <div class="px-6 py-4 border-t border-blue-700">
                <a href="logout.php" class="block py-2.5 px-4 rounded hover:bg-blue-700 transition duration-200">
                    <i class="fas fa-sign-out-alt mr-2"></i> Logout
                </a>
            </div>
        </div>

        <!-- Mobile sidebar toggle -->
        <div class="md:hidden fixed bottom-4 right-4 z-50">
            <button id="mobile-menu-toggle" class="bg-blue-600 text-white p-3 rounded-full shadow-lg">
                <i class="fas fa-bars"></i>
            </button>
        </div>

        <!-- Mobile Navigation Menu (Hidden by default) -->
        <div id="mobile-menu" class="fixed inset-0 bg-blue-900 bg-opacity-95 z-40 transform translate-x-full transition-transform duration-300 md:hidden">
            <div class="flex flex-col h-full overflow-y-auto">
                <div class="flex justify-between items-center p-4 border-b border-blue-800">
                    <div class="flex items-center">
                        <img src="../images/sunglasses.png" alt="Shade Paradise" class="h-8 mr-2">
                        <h1 class="text-lg font-playfair font-bold text-white">SHADE PARADISE</h1>
                    </div>
                    <button id="close-menu" class="text-white text-xl">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="flex-1 p-4">
                    <nav class="space-y-2">
                        <a href="admin_index.php" class="block py-2 px-4 rounded bg-blue-700 text-white">
                            <i class="fas fa-tachometer-alt mr-2"></i> Dashboard
                        </a>
                        <a href="view_products.php" class="block py-2 px-4 rounded text-white hover:bg-blue-700">
                            <i class="fas fa-glasses mr-2"></i> Products
                        </a>
                        <a href="add_product.php" class="block py-2 px-4 rounded text-white hover:bg-blue-700">
                            <i class="fas fa-plus-circle mr-2"></i> Add Product
                        </a>
                        <a href="view_categories.php" class="block py-2 px-4 rounded text-white hover:bg-blue-700">
                            <i class="fas fa-tag mr-2"></i> Categories
                        </a>
                        <a href="view_orders.php" class="block py-2 px-4 rounded text-white hover:bg-blue-700">
                            <i class="fas fa-shopping-cart mr-2"></i> Orders
                        </a>
                        <a href="view_customers.php" class="block py-2 px-4 rounded text-white hover:bg-blue-700">
                            <i class="fas fa-users mr-2"></i> Customers
                        </a>
                    </nav>
                </div>
                <div class="p-4 border-t border-blue-800">
                    <a href="logout.php" class="block py-2 px-4 rounded text-white hover:bg-blue-700">
                        <i class="fas fa-sign-out-alt mr-2"></i> Logout
                    </a>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col">
            <!-- Top Navigation -->
            <header class="bg-white shadow-sm">
                <div class="flex justify-between items-center py-4 px-6">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-800 font-playfair">Admin Dashboard</h1>
                    </div>
                    <div class="flex items-center space-x-4">
                        <span class="text-gray-700">Welcome, Admin</span>
                        <a href="logout.php" class="text-blue-600 hover:text-blue-800 transition duration-200">
                            <i class="fas fa-sign-out-alt"></i>
                        </a>
                    </div>
                </div>
            </header>

            <!-- Dashboard Content -->
            <main class="flex-1 overflow-y-auto p-6 bg-gray-50">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    <!-- Total Products Card -->
                    <div class="bg-white rounded-lg shadow-md p-6 dashboard-card">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-semibold text-gray-700">Total Products</h3>
                            <div class="w-12 h-12 rounded-full bg-blue-100 flex items-center justify-center">
                                <i class="fas fa-glasses text-blue-600 text-xl"></i>
                            </div>
                        </div>
                        <p class="text-3xl font-bold gradient-text">28</p>
                        <p class="text-gray-500 text-sm mt-2">
                            <span class="text-green-500"><i class="fas fa-arrow-up"></i> 12%</span> from last month
                        </p>
                    </div>

                    <!-- Total Orders Card -->
                    <div class="bg-white rounded-lg shadow-md p-6 dashboard-card">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-semibold text-gray-700">Total Orders</h3>
                            <div class="w-12 h-12 rounded-full bg-purple-100 flex items-center justify-center">
                                <i class="fas fa-shopping-cart text-purple-600 text-xl"></i>
                            </div>
                        </div>
                        <p class="text-3xl font-bold gradient-text">124</p>
                        <p class="text-gray-500 text-sm mt-2">
                            <span class="text-green-500"><i class="fas fa-arrow-up"></i> 18%</span> from last month
                        </p>
                    </div>

                    <!-- Total Customers Card -->
                    <div class="bg-white rounded-lg shadow-md p-6 dashboard-card">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-semibold text-gray-700">Total Customers</h3>
                            <div class="w-12 h-12 rounded-full bg-green-100 flex items-center justify-center">
                                <i class="fas fa-users text-green-600 text-xl"></i>
                            </div>
                        </div>
                        <p class="text-3xl font-bold gradient-text">89</p>
                        <p class="text-gray-500 text-sm mt-2">
                            <span class="text-green-500"><i class="fas fa-arrow-up"></i> 7%</span> from last month
                        </p>
                    </div>

                    <!-- Revenue Card -->
                    <div class="bg-white rounded-lg shadow-md p-6 dashboard-card">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-semibold text-gray-700">Revenue</h3>
                            <div class="w-12 h-12 rounded-full bg-yellow-100 flex items-center justify-center">
                                <i class="fas fa-dollar-sign text-yellow-600 text-xl"></i>
                            </div>
                        </div>
                        <p class="text-3xl font-bold gradient-text">Rs. 92,582</p>
                        <p class="text-gray-500 text-sm mt-2">
                            <span class="text-green-500"><i class="fas fa-arrow-up"></i> 15%</span> from last month
                        </p>
                    </div>
                </div>

                <!-- Recent Orders -->
                <div class="bg-white rounded-lg shadow-md p-6 mb-8">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-xl font-bold text-gray-800 font-playfair">Recent Orders</h2>
                        <a href="view_orders.php" class="text-blue-600 hover:text-blue-800 transition duration-200">
                            View All <i class="fas fa-arrow-right ml-1"></i>
                        </a>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full table-auto">
                            <thead>
                                <tr class="bg-gray-50">
                                    <th class="px-4 py-2 text-left text-gray-700">Order ID</th>
                                    <th class="px-4 py-2 text-left text-gray-700">Customer</th>
                                    <th class="px-4 py-2 text-left text-gray-700">Date</th>
                                    <th class="px-4 py-2 text-left text-gray-700">Amount</th>
                                    <th class="px-4 py-2 text-left text-gray-700">Status</th>
                                    <th class="px-4 py-2 text-left text-gray-700">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="border-b">
                                    <td class="px-4 py-3">#ORD-001</td>
                                    <td class="px-4 py-3">John Doe</td>
                                    <td class="px-4 py-3">2024-06-01</td>
                                    <td class="px-4 py-3">Rs. 3,200</td>
                                    <td class="px-4 py-3"><span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs">Delivered</span></td>
                                    <td class="px-4 py-3"><a href="#" class="text-blue-600 hover:text-blue-800">View</a></td>
                                </tr>
                                <tr class="border-b">
                                    <td class="px-4 py-3">#ORD-002</td>
                                    <td class="px-4 py-3">Jane Smith</td>
                                    <td class="px-4 py-3">2024-05-30</td>
                                    <td class="px-4 py-3">Rs. 1,850</td>
                                    <td class="px-4 py-3"><span class="px-2 py-1 bg-yellow-100 text-yellow-800 rounded-full text-xs">Processing</span></td>
                                    <td class="px-4 py-3"><a href="#" class="text-blue-600 hover:text-blue-800">View</a></td>
                                </tr>
                                <tr class="border-b">
                                    <td class="px-4 py-3">#ORD-003</td>
                                    <td class="px-4 py-3">Robert Johnson</td>
                                    <td class="px-4 py-3">2024-05-29</td>
                                    <td class="px-4 py-3">Rs. 4,500</td>
                                    <td class="px-4 py-3"><span class="px-2 py-1 bg-blue-100 text-blue-800 rounded-full text-xs">Shipped</span></td>
                                    <td class="px-4 py-3"><a href="#" class="text-blue-600 hover:text-blue-800">View</a></td>
                                </tr>
                                <tr>
                                    <td class="px-4 py-3">#ORD-004</td>
                                    <td class="px-4 py-3">Emily Davis</td>
                                    <td class="px-4 py-3">2024-05-28</td>
                                    <td class="px-4 py-3">Rs. 2,750</td>
                                    <td class="px-4 py-3"><span class="px-2 py-1 bg-red-100 text-red-800 rounded-full text-xs">Cancelled</span></td>
                                    <td class="px-4 py-3"><a href="#" class="text-blue-600 hover:text-blue-800">View</a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Popular Products -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-xl font-bold text-gray-800 font-playfair">Popular Products</h2>
                        <a href="view_products.php" class="text-blue-600 hover:text-blue-800 transition duration-200">
                            View All <i class="fas fa-arrow-right ml-1"></i>
                        </a>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="border rounded-lg overflow-hidden">
                            <div class="h-40 bg-gray-200 flex items-center justify-center">
                                <i class="fas fa-glasses text-gray-400 text-4xl"></i>
                            </div>
                            <div class="p-4">
                                <h3 class="font-semibold text-gray-800">Premium Aviator</h3>
                                <p class="text-sm text-gray-600 mb-2">In stock: 24</p>
                                <div class="flex justify-between items-center">
                                    <span class="font-bold text-blue-600">Rs. 2,500</span>
                                    <span class="text-sm text-gray-500">152 sold</span>
                                </div>
                            </div>
                        </div>
                        <div class="border rounded-lg overflow-hidden">
                            <div class="h-40 bg-gray-200 flex items-center justify-center">
                                <i class="fas fa-glasses text-gray-400 text-4xl"></i>
                            </div>
                            <div class="p-4">
                                <h3 class="font-semibold text-gray-800">Designer Round</h3>
                                <p class="text-sm text-gray-600 mb-2">In stock: 18</p>
                                <div class="flex justify-between items-center">
                                    <span class="font-bold text-blue-600">Rs. 2,850</span>
                                    <span class="text-sm text-gray-500">124 sold</span>
                                </div>
                            </div>
                        </div>
                        <div class="border rounded-lg overflow-hidden">
                            <div class="h-40 bg-gray-200 flex items-center justify-center">
                                <i class="fas fa-glasses text-gray-400 text-4xl"></i>
                            </div>
                            <div class="p-4">
                                <h3 class="font-semibold text-gray-800">Sport Elite</h3>
                                <p class="text-sm text-gray-600 mb-2">In stock: 31</p>
                                <div class="flex justify-between items-center">
                                    <span class="font-bold text-blue-600">Rs. 3,200</span>
                                    <span class="text-sm text-gray-500">98 sold</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script>
        // Mobile menu functionality
        const mobileMenuToggle = document.getElementById('mobile-menu-toggle');
        const closeMenu = document.getElementById('close-menu');
        const mobileMenu = document.getElementById('mobile-menu');
        
        mobileMenuToggle.addEventListener('click', () => {
            mobileMenu.classList.toggle('translate-x-full');
        });
        
        closeMenu.addEventListener('click', () => {
            mobileMenu.classList.add('translate-x-full');
        });
    </script>
</body> 