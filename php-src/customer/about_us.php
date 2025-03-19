<?php
session_start();
// Check if user is logged in
if (!isset($_SESSION['is_login']) || $_SESSION['is_login'] !== true) {
    header('Location: ../index.php');
    exit;
}
$page_title = "About Us - Shade Paradise";
include '../includes/header.php';
?>

<!-- Hero section -->
<div class="relative h-[60vh]">
    <div class="absolute inset-0">
        <img src="../images/header.jpg" alt="" class="w-full h-full object-cover brightness-75">
        <div class="absolute inset-0 bg-gradient-to-b from-black/70 via-blue-900/40 to-black/20"></div>
    </div>
    
    <div class="relative z-10 h-full flex items-center justify-center">
        <div class="text-center">
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-playfair font-bold text-white mb-4">
                About <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-purple-500">Us</span>
            </h1>
            <p class="text-xl text-gray-200 font-montserrat">
                Our Story and Team
            </p>
        </div>
    </div>
</div>

<!-- Our Story section -->
<div class="container mx-auto px-6 md:px-12 py-24">
    <div class="max-w-4xl mx-auto text-center mb-16">
        <h2 class="text-3xl md:text-4xl font-playfair font-bold mb-6 text-blue-600">Our Story</h2>
        <p class="text-gray-600 text-lg leading-relaxed font-montserrat">
            Founded in 2024, Shade Paradise emerged from a shared passion for premium eyewear and exceptional customer service. 
            Our journey began with a simple vision: to provide high-quality sunglasses that combine style, comfort, and protection.
        </p>
    </div>
</div>

<!-- Team section -->
<div class="bg-gray-50 py-24">
    <div class="container mx-auto px-6 md:px-12">
        <h2 class="text-3xl md:text-4xl font-playfair font-bold text-center mb-16 text-blue-600">
            Meet Our Team
        </h2>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
            <!-- Shrijana - Owner -->
            <div class="text-center">
                <div class="relative w-48 h-48 mx-auto mb-6 rounded-full overflow-hidden shadow-lg">
                    <img src="../images/team/shrijana.jpg" alt="Shrijana Khatiwada" class="w-full h-full object-cover hover:scale-105 transition duration-300">
                </div>
                <h3 class="text-2xl font-playfair font-bold mb-2">Shrijana Khatiwada</h3>
                <p class="text-blue-600 font-semibold mb-4">Owner & Founder</p>
                <p class="text-gray-600">
                    With a passion for fashion and an eye for quality, Shrijana leads our team with vision and dedication.
                    Her commitment to excellence drives our brand forward.
                </p>
            </div>

            <!-- Sami - Partner -->
            <div class="text-center">
                <div class="relative w-48 h-48 mx-auto mb-6 rounded-full overflow-hidden shadow-lg">
                    <img src="../images/team/sami.jpg" alt="Sami Bista" class="w-full h-full object-cover hover:scale-105 transition duration-300">
                </div>
                <h3 class="text-2xl font-playfair font-bold mb-2">Sami Bista</h3>
                <p class="text-blue-600 font-semibold mb-4">Partner</p>
                <p class="text-gray-600">
                    Bringing expertise in business development and customer relations, Sami helps shape our brand's growth
                    and ensures exceptional service delivery.
                </p>
            </div>

            <!-- Indra - Partner -->
            <div class="text-center">
                <div class="relative w-48 h-48 mx-auto mb-6 rounded-full overflow-hidden shadow-lg">
                    <img src="../images/team/indra.jpg" alt="Indra Kafle" class="w-full h-full object-cover hover:scale-105 transition duration-300">
                </div>
                <h3 class="text-2xl font-playfair font-bold mb-2">Indra Kafle</h3>
                <p class="text-blue-600 font-semibold mb-4">Partner</p>
                <p class="text-gray-600">
                    With a keen eye for design and market trends, Indra contributes to our product selection and
                    ensures we stay ahead of industry standards.
                </p>
            </div>
        </div>
    </div>
</div>

<!-- Values section -->
<div class="container mx-auto px-6 md:px-12 py-24">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
        <div>
            <h2 class="text-3xl md:text-4xl font-playfair font-bold mb-6 text-blue-600">Our Vision</h2>
            <p class="text-gray-600 text-lg leading-relaxed font-montserrat mb-8">
                To be the leading provider of premium eyewear, known for our exceptional quality, 
                innovative designs, and outstanding customer service.
            </p>
            <a href="shop.php" class="inline-block px-6 py-3 bg-blue-600 hover:bg-blue-700 rounded-full transition duration-300 text-white text-center font-semibold uppercase tracking-wider">
                Explore Collection
            </a>
        </div>
        <div class="grid grid-cols-2 gap-6">
            <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-lg transition duration-300">
                <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-blue-100 flex items-center justify-center">
                    <i class="fas fa-medal text-2xl text-blue-600"></i>
                </div>
                <h3 class="text-xl font-bold mb-2">Quality</h3>
                <p class="text-gray-600">Premium materials and craftsmanship in every piece.</p>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-lg transition duration-300">
                <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-blue-100 flex items-center justify-center">
                    <i class="fas fa-shield-alt text-2xl text-blue-600"></i>
                </div>
                <h3 class="text-xl font-bold mb-2">Protection</h3>
                <p class="text-gray-600">Superior UV protection for your eyes.</p>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-lg transition duration-300">
                <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-blue-100 flex items-center justify-center">
                    <i class="fas fa-heart text-2xl text-blue-600"></i>
                </div>
                <h3 class="text-xl font-bold mb-2">Customer Focus</h3>
                <p class="text-gray-600">Dedicated to your satisfaction and comfort.</p>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-lg transition duration-300">
                <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-blue-100 flex items-center justify-center">
                    <i class="fas fa-star text-2xl text-blue-600"></i>
                </div>
                <h3 class="text-xl font-bold mb-2">Excellence</h3>
                <p class="text-gray-600">Striving for the best in everything we do.</p>
            </div>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?> 