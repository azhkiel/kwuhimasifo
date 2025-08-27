<?php
session_start();
require_once 'includes/db.php';

// Ambil beberapa produk dari setiap kategori untuk ditampilkan
$minicanteen_products = [];
$kotlin_products = [];
$mersi_products = [];

try {
    // Produk MiniCanteen
    $stmt = $pdo->query("
        SELECT mp.*, mc.name as category_name 
        FROM minicanteen_products mp 
        LEFT JOIN minicanteen_categories mc ON mp.category_id = mc.id 
        WHERE mp.stock > 0 
        ORDER BY RAND() LIMIT 3
    ");
    $minicanteen_products = $stmt->fetchAll();

    // Produk Kotlin
    $stmt = $pdo->query("
        SELECT kp.*, ka.name as app_name, ka.image as app_image 
        FROM kotlin_products kp 
        JOIN kotlin_apps ka ON kp.app_id = ka.id 
        ORDER BY RAND() LIMIT 3
    ");
    $kotlin_products = $stmt->fetchAll();

    // Produk Mersi
    $stmt = $pdo->query("
        SELECT * FROM mersi_products 
        WHERE stock > 0 
        ORDER BY RAND() LIMIT 3
    ");
    $mersi_products = $stmt->fetchAll();
} catch (PDOException $e) {
    // Tangani error
    error_log("Error fetching products: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda - kwuhimasifo </title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#3B82F6',
                        secondary: '#10B981',
                        accent: '#8B5CF6',
                        dark: '#1F2937',
                        light: '#F9FAFB'
                    }
                }
            }
        }
    </script>
    <style>
        .hero-pattern {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .card-hover {
            transition: all 0.3s ease;
        }
        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        .section-title {
            position: relative;
            display: inline-block;
            margin-bottom: 2rem;
        }
        .section-title:after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 0;
            width: 50px;
            height: 3px;
            background: #3B82F6;
        }
        .category-card {
            transition: all 0.3s ease;
            overflow: hidden;
        }
        .category-card:hover {
            transform: scale(1.05);
        }
        .category-card img {
            transition: transform 0.5s ease;
        }
        .category-card:hover img {
            transform: scale(1.1);
        }
    </style>
</head>
<body class="bg-gray-50">
    <?php include 'components/header.php'; ?>
    <!-- Hero Section -->
    <section class="hero-pattern text-white py-20">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row items-center">
                <div class="md:w-1/2 mb-10 md:mb-0">
                    <h1 class="text-4xl md:text-5xl font-bold mb-4">Tempat Belanja Online Terlengkap</h1>
                    <p class="text-xl mb-8">Dapatkan makanan, layanan digital, dan merchandise eksklusif dalam satu platform</p>
                    <div class="flex flex-wrap gap-4">
                        <a href="#minicanteen" class="bg-white text-blue-600 font-semibold py-3 px-6 rounded-lg shadow-lg hover:bg-gray-100 transition">Explore Mini Canteen</a>
                        <a href="#kotlin" class="bg-transparent border-2 border-white text-white font-semibold py-3 px-6 rounded-lg hover:bg-white hover:text-blue-600 transition">Lihat Layanan Digital</a>
                    </div>
                </div>
                <div class="md:w-1/2">
                    <img src="https://cdn.pixabay.com/photo/2018/05/18/15/30/web-design-3411373_1280.jpg" alt="Online Shopping" class="rounded-lg shadow-xl">
                </div>
            </div>
        </div>
    </section>

    <!-- Categories Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-12">Kategori Produk</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Mini Canteen Card -->
                <a href="minicanteen.php" class="category-card bg-blue-50 rounded-xl overflow-hidden shadow-md">
                    <div class="h-48 overflow-hidden">
                        <img src="https://cdn.pixabay.com/photo/2017/09/22/11/16/food-2775135_1280.jpg" alt="Mini Canteen" class="w-full h-full object-cover">
                    </div>
                    <div class="p-6">
                        <div class="flex items-center mb-4">
                            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mr-4">
                                <i class="fas fa-utensils text-blue-600 text-xl"></i>
                            </div>
                            <h3 class="text-xl font-bold">Mini Canteen</h3>
                        </div>
                        <p class="text-gray-600">Temukan berbagai makanan dan minuman lezat untuk menemani aktivitas Anda</p>
                    </div>
                </a>
                
                <!-- Kotlin Apps Card -->
                <a href="kotlin.php" class="category-card bg-green-50 rounded-xl overflow-hidden shadow-md">
                    <div class="h-48 overflow-hidden">
                        <img src="https://cdn.pixabay.com/photo/2021/01/27/06/12/digital-5954003_1280.jpg" alt="Kotlin Apps" class="w-full h-full object-cover">
                    </div>
                    <div class="p-6">
                        <div class="flex items-center mb-4">
                            <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mr-4">
                                <i class="fas fa-laptop-code text-green-600 text-xl"></i>
                            </div>
                            <h3 class="text-xl font-bold">Kotlin Apps</h3>
                        </div>
                        <p class="text-gray-600">Akses layanan digital premium dengan harga terjangkau</p>
                    </div>
                </a>
                
                <!-- Mersi Card -->
                <a href="mersi.php" class="category-card bg-purple-50 rounded-xl overflow-hidden shadow-md">
                    <div class="h-48 overflow-hidden">
                        <img src="https://cdn.pixabay.com/photo/2017/08/07/01/41/tshirt-2596615_1280.jpg" alt="Merchandise" class="w-full h-full object-cover">
                    </div>
                    <div class="p-6">
                        <div class="flex items-center mb-4">
                            <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center mr-4">
                                <i class="fas fa-tshirt text-purple-600 text-xl"></i>
                            </div>
                            <h3 class="text-xl font-bold">Merchandise</h3>
                        </div>
                        <p class="text-gray-600">Koleksi merchandise eksklusif dengan desain yang trendy</p>
                    </div>
                </a>
            </div>
        </div>
    </section>

    <!-- Mini Canteen Products -->
    <section id="minicanteen" class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <h2 class="section-title text-3xl font-bold">Produk Mini Canteen</h2>
            <p class="text-gray-600 mb-8">Rasakan kelezatan hidangan dari Mini Canteen kami</p>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php foreach ($minicanteen_products as $product): ?>
                    <div class="bg-white rounded-xl shadow-md overflow-hidden card-hover">
                        <div class="h-48 bg-gray-200 overflow-hidden">
                            <?php if ($product['image']): ?>
                                <img src="uploads/<?php echo htmlspecialchars($product['image']); ?>" 
                                     alt="<?php echo htmlspecialchars($product['name']); ?>" 
                                     class="w-full h-full object-cover">
                            <?php else: ?>
                                <div class="w-full h-full flex items-center justify-center text-gray-400">
                                    <i class="fas fa-image text-5xl"></i>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="p-6">
                            <div class="flex justify-between items-start mb-2">
                                <h3 class="font-bold text-lg"><?php echo htmlspecialchars($product['name']); ?></h3>
                                <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded">
                                    <?php echo htmlspecialchars($product['category_name'] ?? 'Uncategorized'); ?>
                                </span>
                            </div>
                            <p class="text-gray-600 text-sm mb-4"><?php echo htmlspecialchars($product['description']); ?></p>
                            <div class="flex justify-between items-center">
                                <span class="font-bold text-lg">Rp <?php echo number_format($product['price'], 0, ',', '.'); ?></span>
                                <span class="text-sm <?php echo $product['stock'] > 0 ? 'text-green-600' : 'text-red-600'; ?>">
                                    <?php echo $product['stock'] > 0 ? "Stok: {$product['stock']}" : 'Habis'; ?>
                                </span>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            
            <div class="text-center mt-10">
                <a href="minicanteen.php" class="inline-flex items-center text-blue-600 font-semibold hover:text-blue-800 transition">
                    Lihat Semua Produk
                    <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- Kotlin Apps Products -->
    <section id="kotlin" class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <h2 class="section-title text-3xl font-bold">Layanan Kotlin Apps</h2>
            <p class="text-gray-600 mb-8">Tingkatkan produktivitas dengan layanan digital premium</p>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php foreach ($kotlin_products as $product): ?>
                    <div class="bg-white rounded-xl shadow-md overflow-hidden card-hover p-6">
                        <div class="flex items-center mb-4">
                            <?php if ($product['app_image']): ?>
                                <img src="uploads/<?php echo htmlspecialchars($product['app_image']); ?>" 
                                     alt="<?php echo htmlspecialchars($product['app_name']); ?>" 
                                     class="w-12 h-12 object-cover rounded-lg mr-4">
                            <?php else: ?>
                                <div class="w-12 h-12 bg-gray-200 rounded-lg flex items-center justify-center text-gray-400 mr-4">
                                    <i class="fas fa-app-store-ios text-xl"></i>
                                </div>
                            <?php endif; ?>
                            <h3 class="font-bold text-lg"><?php echo htmlspecialchars($product['app_name']); ?></h3>
                        </div>
                        <h4 class="font-semibold text-gray-800 mb-2"><?php echo htmlspecialchars($product['description']); ?></h4>
                        <div class="flex justify-between items-center mb-4">
                            <span class="font-bold text-lg">Rp <?php echo number_format($product['price'], 0, ',', '.'); ?></span>
                        </div>
                        <a href="https://wa.me/628123456789?text=Halo,%20saya%20ingin%20membeli%20layanan:%20<?php echo urlencode($product['app_name'] . ' - ' . $product['description']); ?>" 
                           target="_blank"
                           class="block w-full bg-green-500 hover:bg-green-600 text-white text-center font-bold py-2 px-4 rounded">
                            Beli Sekarang
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
            
            <div class="text-center mt-10">
                <a href="kotlin.php" class="inline-flex items-center text-blue-600 font-semibold hover:text-blue-800 transition">
                    Lihat Semua Layanan
                    <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- Mersi Products -->
    <section id="mersi" class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <h2 class="section-title text-3xl font-bold">Merchandise Eksklusif</h2>
            <p class="text-gray-600 mb-8">Tampil beda dengan merchandise koleksi terbatas</p>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php foreach ($mersi_products as $product): ?>
                    <div class="bg-white rounded-xl shadow-md overflow-hidden card-hover">
                        <div class="h-48 bg-gray-200 overflow-hidden">
                            <?php if ($product['image']): ?>
                                <img src="uploads/<?php echo htmlspecialchars($product['image']); ?>" 
                                     alt="<?php echo htmlspecialchars($product['name']); ?>" 
                                     class="w-full h-full object-cover">
                            <?php else: ?>
                                <div class="w-full h-full flex items-center justify-center text-gray-400">
                                    <i class="fas fa-image text-5xl"></i>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="p-6">
                            <h3 class="font-bold text-lg mb-2"><?php echo htmlspecialchars($product['name']); ?></h3>
                            <p class="text-gray-600 text-sm mb-4"><?php echo htmlspecialchars($product['description']); ?></p>
                            <div class="flex justify-between items-center mb-4">
                                <span class="font-bold text-lg">Rp <?php echo number_format($product['price'], 0, ',', '.'); ?></span>
                                <span class="text-sm <?php echo $product['stock'] > 0 ? 'text-green-600' : 'text-red-600'; ?>">
                                    <?php echo $product['stock'] > 0 ? "Stok: {$product['stock']}" : 'Habis'; ?>
                                </span>
                            </div>
                            <form method="POST" action="mersi.php">
                                <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                                <button type="submit" name="add_to_cart" 
                                    class="w-full bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded disabled:bg-gray-400"
                                    <?php echo $product['stock'] <= 0 ? 'disabled' : ''; ?>>
                                    Tambah ke Keranjang
                                </button>
                            </form>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            
            <div class="text-center mt-10">
                <a href="mersi.php" class="inline-flex items-center text-blue-600 font-semibold hover:text-blue-800 transition">
                    Lihat Semua Merchandise
                    <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-12">Apa Kata Pelanggan Kami</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-gray-50 p-6 rounded-xl shadow-md">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mr-4">
                            <i class="fas fa-user text-blue-600"></i>
                        </div>
                        <div>
                            <h4 class="font-bold">Rina Santoso</h4>
                            <p class="text-sm text-gray-500">Pelanggan Mini Canteen</p>
                        </div>
                    </div>
                    <p class="text-gray-600">"Makanan di Mini Canteen selalu fresh dan harganya terjangkau. Recommended banget!"</p>
                    <div class="flex mt-4">
                        <?php for ($i = 0; $i < 5; $i++): ?>
                            <i class="fas fa-star text-yellow-400"></i>
                        <?php endfor; ?>
                    </div>
                </div>
                
                <div class="bg-gray-50 p-6 rounded-xl shadow-md">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mr-4">
                            <i class="fas fa-user text-green-600"></i>
                        </div>
                        <div>
                            <h4 class="font-bold">Budi Pratama</h4>
                            <p class="text-sm text-gray-500">Pelanggan Kotlin Apps</p>
                        </div>
                    </div>
                    <p class="text-gray-600">"Layanan Canva Pro-nya sangat membantu pekerjaan saya. Prosesnya cepat dan mudah."</p>
                    <div class="flex mt-4">
                        <?php for ($i = 0; $i < 5; $i++): ?>
                            <i class="fas fa-star text-yellow-400"></i>
                        <?php endfor; ?>
                    </div>
                </div>
                
                <div class="bg-gray-50 p-6 rounded-xl shadow-md">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center mr-4">
                            <i class="fas fa-user text-purple-600"></i>
                        </div>
                        <div>
                            <h4 class="font-bold">Sari Dewi</h4>
                            <p class="text-sm text-gray-500">Pelanggan Merchandise</p>
                        </div>
                    </div>
                    <p class="text-gray-600">"Kualitas merchandise-nya bagus banget dan harganya reasonable. Bakal beli lagi deh!"</p>
                    <div class="flex mt-4">
                        <?php for ($i = 0; $i < 5; $i++): ?>
                            <i class="fas fa-star text-yellow-400"></i>
                        <?php endfor; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-16 bg-blue-600 text-white">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-3xl font-bold mb-4">Tunggu Apa Lagi?</h2>
            <p class="text-xl mb-8 max-w-2xl mx-auto">Temukan berbagai produk terbaik kami dan nikmati pengalaman berbelanja yang menyenangkan</p>
            <div class="flex flex-wrap justify-center gap-4">
                <a href="minicanteen.php" class="bg-white text-blue-600 font-semibold py-3 px-6 rounded-lg shadow-lg hover:bg-gray-100 transition">
                    Beli Makanan
                </a>
                <a href="kotlin.php" class="bg-transparent border-2 border-white text-white font-semibold py-3 px-6 rounded-lg hover:bg-white hover:text-blue-600 transition">
                    Lihat Layanan Digital
                </a>
                <a href="mersi.php" class="bg-transparent border-2 border-white text-white font-semibold py-3 px-6 rounded-lg hover:bg-white hover:text-blue-600 transition">
                    Jelajahi Merchandise
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-12">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-xl font-bold mb-4">OnlineStore</h3>
                    <p class="text-gray-400">Tempat belanja online terlengkap dengan berbagai pilihan produk terbaik.</p>
                </div>
                
                <div>
                    <h4 class="font-semibold mb-4">Tautan Cepat</h4>
                    <ul class="space-y-2">
                        <li><a href="minicanteen.php" class="text-gray-400 hover:text-white transition">Mini Canteen</a></li>
                        <li><a href="kotlin.php" class="text-gray-400 hover:text-white transition">Kotlin Apps</a></li>
                        <li><a href="mersi.php" class="text-gray-400 hover:text-white transition">Merchandise</a></li>
                        <li><a href="cart.php" class="text-gray-400 hover:text-white transition">Keranjang Belanja</a></li>
                    </ul>
                </div>
                
                <div>
                    <h4 class="font-semibold mb-4">Layanan Pelanggan</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-white transition">Bantuan</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition">FAQ</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition">Kebijakan Privasi</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition">Syarat & Ketentuan</a></li>
                    </ul>
                </div>
                
                <div>
                    <h4 class="font-semibold mb-4">Hubungi Kami</h4>
                    <ul class="space-y-2">
                        <li class="flex items-center">
                            <i class="fas fa-map-marker-alt mr-3 text-gray-400"></i>
                            <span class="text-gray-400">Jl. Contoh No. 123, Jakarta</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-phone mr-3 text-gray-400"></i>
                            <span class="text-gray-400">+62 812 3456 7890</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-envelope mr-3 text-gray-400"></i>
                            <span class="text-gray-400">info@onlinestore.com</span>
                        </li>
                    </ul>
                </div>
            </div>
            
            <div class="border-t border-gray-700 mt-8 pt-8 flex flex-col md:flex-row justify-between items-center">
                <p class="text-gray-400">© 2023 OnlineStore. All rights reserved.</p>
                <div class="flex space-x-4 mt-4 md:mt-0">
                    <a href="#" class="text-gray-400 hover:text-white transition">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white transition">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white transition">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white transition">
                        <i class="fab fa-whatsapp"></i>
                    </a>
                </div>
            </div>
        </div>
    </footer>

    <script>
        // Mobile menu toggle
        document.getElementById('mobile-menu-button').addEventListener('click', function() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        });

        // Simple animation on scroll
        document.addEventListener('DOMContentLoaded', function() {
            const scrollElements = document.querySelectorAll('.card-hover, .category-card');
            
            const elementInView = (el, dividend = 1) => {
                const elementTop = el.getBoundingClientRect().top;
                return (
                    elementTop <= (window.innerHeight || document.documentElement.clientHeight) / dividend
                );
            };
            
            const displayScrollElement = (element) => {
                element.style.opacity = "1";
                element.style.transform = "translateY(0)";
            };
            
            const hideScrollElement = (element) => {
                element.style.opacity = "0";
                element.style.transform = "translateY(20px)";
            };
            
            const handleScrollAnimation = () => {
                scrollElements.forEach((el) => {
                    if (elementInView(el, 1.2)) {
                        displayScrollElement(el);
                    } else {
                        hideScrollElement(el);
                    }
                });
            };
            
            // Set initial state
            scrollElements.forEach(el => {
                el.style.transition = "opacity 0.6s ease, transform 0.6s ease";
                hideScrollElement(el);
            });
            
            window.addEventListener('scroll', () => {
                handleScrollAnimation();
            });
            
            // Trigger once on load
            handleScrollAnimation();
        });
    </script>
</body>
</html>