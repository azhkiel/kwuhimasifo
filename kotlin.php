<?php
require_once 'includes/db.php';

// Ambil semua produk kotlin dengan info app
$stmt = $pdo->query("
    SELECT kp.*, ka.name as app_name, ka.image as app_image 
    FROM kotlin_products kp 
    JOIN kotlin_apps ka ON kp.app_id = ka.id 
    ORDER BY ka.name, kp.price
");
$products = $stmt->fetchAll();

// Kelompokkan produk berdasarkan app
$productsByApp = [];
foreach ($products as $product) {
    $app = $product['app_name'];
    if (!isset($productsByApp[$app])) {
        $productsByApp[$app] = [
            'app_image' => $product['app_image'],
            'products' => []
        ];
    }
    $productsByApp[$app]['products'][] = $product;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kotlin - Konter Online</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
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
    </style>
</head>
<body class="bg-gray-50">
    <?php include 'components/header.php'; ?>
    <!-- Hero Section -->
    <section class="bg-green-600 text-white py-16">
        <div class="container mx-auto px-4 text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">Kotlin Apps</h1>
            <p class="text-xl mb-8">Akses layanan digital premium dengan harga terjangkau</p>
            <a href="#products" class="bg-white text-green-600 font-semibold py-3 px-6 rounded-lg shadow-lg hover:bg-gray-100 transition">
                Jelajahi Layanan
            </a>
        </div>
    </section>
    
    <!-- Products Section -->
    <section id="products" class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <h2 class="section-title text-3xl font-bold">Layanan Digital Premium</h2>
            <p class="text-gray-600 mb-8">Tingkatkan produktivitas dengan layanan digital terbaik</p>
            
            <?php if (empty($productsByApp)): ?>
                <div class="bg-white rounded-xl shadow-md p-8 text-center">
                    <i class="fas fa-laptop-code text-5xl text-gray-400 mb-4"></i>
                    <h3 class="text-xl font-semibold mb-2">Layanan Sedang Tidak Tersedia</h3>
                    <p class="text-gray-600">Silakan kembali lagi nanti untuk melihat layanan terbaru kami.</p>
                </div>
                <?php else: ?>
                    <?php foreach ($productsByApp as $app => $data): ?>
                        <div class="mb-12">
                            <div class="flex items-center mb-6 border-b-2 border-green-200 pb-2">
                                <?php if ($data['app_image']): ?>
                                    <img src="uploads/<?php echo htmlspecialchars($data['app_image']); ?>" 
                                    alt="<?php echo htmlspecialchars($app); ?>" 
                                    class="max-h-12 object-cover rounded-lg mr-4">
                                    <?php else: ?>
                                        <div class="h-12 w-12 bg-gray-200 rounded-lg flex items-center justify-center text-gray-400 mr-4">
                                            <i class="fas fa-app-store-ios text-xl"></i>
                                        </div>
                                        <?php endif; ?>
                                        <h3 class="text-2xl font-semibold text-gray-800"><?php echo htmlspecialchars($app); ?></h3>
                                    </div>
                                    
                                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                                        <?php foreach ($data['products'] as $product): ?>
                                <div class="bg-white rounded-xl shadow-md overflow-hidden card-hover p-6">
                                    <h4 class="font-semibold text-gray-800 mb-4 text-lg"><?php echo htmlspecialchars($product['description']); ?></h4>
                                    <div class="flex justify-between items-center mb-6">
                                        <span class="font-bold text-xl">Rp <?php echo number_format($product['price'], 0, ',', '.'); ?></span>
                                        <span class="text-sm text-green-600">
                                            <i class="fas fa-check-circle mr-1"></i> Tersedia
                                        </span>
                                    </div>
                                    <a href="https://wa.me/628123456789?text=Halo,%20saya%20ingin%20membeli%20layanan:%20<?php echo urlencode($app . ' - ' . $product['description']); ?>" 
                                    target="_blank"
                                    class="block w-full bg-green-500 hover:bg-green-600 text-white text-center font-bold py-3 px-4 rounded-lg transition">
                                    Beli Sekarang
                                </a>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </section>
            
            <!-- Benefits Section -->
            <section class="py-16 bg-white">
                <div class="container mx-auto px-4">
                    <h2 class="section-title text-3xl font-bold">Mengapa Memilih Layanan Kami?</h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-12">
                        <div class="text-center">
                            <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-bolt text-green-600 text-2xl"></i>
                            </div>
                            <h3 class="text-xl font-semibold mb-2">Aktivasi Cepat</h3>
                            <p class="text-gray-600">Proses aktivasi hanya membutuhkan waktu beberapa menit setelah pembayaran</p>
                        </div>
                        
                        <div class="text-center">
                            <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-shield-alt text-green-600 text-2xl"></i>
                            </div>
                            <h3 class="text-xl font-semibold mb-2">Aman dan Terpercaya</h3>
                            <p class="text-gray-600">Layanan resmi dengan garansi keamanan akun</p>
                        </div>
                        
                        <div class="text-center">
                            <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-headset text-green-600 text-2xl"></i>
                            </div>
                            <h3 class="text-xl font-semibold mb-2">Dukungan 24/7</h3>
                            <p class="text-gray-600">Tim support siap membantu Anda kapan saja</p>
                        </div>
                    </div>
                </div>
            </section>
            
            <?php include 'components/footer.php'; ?>
    <script>
        // Mobile menu toggle
        document.getElementById('mobile-menu-button').addEventListener('click', function() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        });
    </script>
</body>
</html>