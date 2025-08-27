<?php
require_once 'includes/db.php';

// Ambil semua produk dengan kategori
$stmt = $pdo->query("
    SELECT mp.*, mc.name as category_name 
    FROM minicanteen_products mp 
    LEFT JOIN minicanteen_categories mc ON mp.category_id = mc.id 
    WHERE mp.stock > 0
    ORDER BY mc.name, mp.name
");
$products = $stmt->fetchAll();

// Kelompokkan produk berdasarkan kategori
$productsByCategory = [];
foreach ($products as $product) {
    $category = $product['category_name'] ?? 'Uncategorized';
    if (!isset($productsByCategory[$category])) {
        $productsByCategory[$category] = [];
    }
    $productsByCategory[$category][] = $product;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mini Canteen - Makanan & Minuman</title>
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
    <section class="bg-blue-600 text-white py-16">
        <div class="container mx-auto px-4 text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">Mini Canteen</h1>
            <p class="text-xl mb-8">Temukan berbagai makanan dan minuman lezat untuk menemani aktivitas Anda</p>
            <a href="#products" class="bg-white text-blue-600 font-semibold py-3 px-6 rounded-lg shadow-lg hover:bg-gray-100 transition">
                Jelajahi Menu
            </a>
        </div>
    </section>

    <section id="products" class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <h2 class="section-title text-3xl font-bold">Menu Snack & Minuman</h2>
            <?php if (empty($productsByCategory)): ?>
                <div class="bg-white rounded-xl shadow-md p-8 text-center">
                    <i class="fas fa-utensils text-5xl text-gray-400 mb-4"></i>
                    <h3 class="text-xl font-semibold mb-2">Menu Sedang Tidak Tersedia</h3>
                    <p class="text-gray-600">Silakan kembali lagi nanti untuk melihat menu terbaru kami.</p>
                </div>
            <?php else: ?>
                <?php foreach ($productsByCategory as $category => $items): ?>
                    <div class="mb-12">
                        <h3 class="text-2xl font-semibold mb-6 text-gray-800 border-b-2 border-blue-200 pb-2"><?php echo htmlspecialchars($category); ?></h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            <?php foreach ($items as $product): ?>
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
                                                <?php echo htmlspecialchars($category); ?>
                                            </span>
                                        </div>
                                        <p class="text-gray-600 text-sm mb-4"><?php echo htmlspecialchars($product['description']); ?></p>
                                        <div class="flex justify-between items-center">
                                            <span class="font-bold text-lg">Rp <?php echo number_format($product['price'], 0, ',', '.'); ?></span>
                                            <span class="text-sm text-green-600">
                                                Stok: <?php echo $product['stock']; ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </section>

    <section class="py-16 bg-white">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-3xl font-bold mb-4">Stok Habis atau Mau Request Produk lain?</h2>
            <p class="text-xl mb-8 max-w-2xl mx-auto">Hubungi kami untuk memberitahu mau kamu!</p>
            <a href="https://wa.me/628123456789?text=Halo,%20saya%20ingin%20bertanya%20tentang%20layanan%20catering" 
               target="_blank"
               class="bg-green-500 hover:bg-green-600 text-white font-semibold py-3 px-6 rounded-lg shadow-lg transition inline-flex items-center">
                <i class="fab fa-whatsapp mr-2"></i> Hubungi via WhatsApp
            </a>
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