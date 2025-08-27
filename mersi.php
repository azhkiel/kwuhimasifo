<?php
session_start();
require_once 'includes/db.php';

// Ambil semua produk merchandise
$stmt = $pdo->query("SELECT * FROM mersi_products WHERE stock > 0 ORDER BY name");
$products = $stmt->fetchAll();

// Tambah ke keranjang
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_cart'])) {
    $product_id = $_POST['product_id'];
    $quantity = 1; // Default quantity
    
    // Cari produk
    $product = null;
    foreach ($products as $p) {
        if ($p['id'] == $product_id) {
            $product = $p;
            break;
        }
    }
    
    if ($product) {
        // Inisialisasi keranjang jika belum ada
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }
        
        // Cek jika produk sudah ada di keranjang
        $found = false;
        foreach ($_SESSION['cart'] as &$item) {
            if ($item['id'] == $product_id) {
                $item['quantity'] += $quantity;
                $found = true;
                break;
            }
        }
        
        // Jika belum ada, tambahkan produk baru
        if (!$found) {
            $_SESSION['cart'][] = [
                'id' => $product['id'],
                'name' => $product['name'],
                'price' => $product['price'],
                'quantity' => $quantity,
                'image' => $product['image']
            ];
        }
        
        // Redirect untuk menghindari resubmission
        header('Location: mersi.php');
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Merchandise - Produk Eksklusif</title>
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
    <section class="bg-purple-600 text-white py-16">
        <div class="container mx-auto px-4 text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">Merchandise</h1>
            <p class="text-xl mb-8">Tampil beda dengan merchandise koleksi terbatas</p>
            <a href="#products" class="bg-white text-purple-600 font-semibold py-3 px-6 rounded-lg shadow-lg hover:bg-gray-100 transition">
                Jelajahi Koleksi
            </a>
        </div>
    </section>

    <!-- Products Section -->
    <section id="products" class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <h2 class="section-title text-3xl font-bold">Koleksi Merchandise Eksklusif</h2>
            <p class="text-gray-600 mb-8">Temukan merchandise berkualitas dengan desain yang trendy</p>
            
            <?php if (empty($products)): ?>
                <div class="bg-white rounded-xl shadow-md p-8 text-center">
                    <i class="fas fa-tshirt text-5xl text-gray-400 mb-4"></i>
                    <h3 class="text-xl font-semibold mb-2">Merchandise Sedang Tidak Tersedia</h3>
                    <p class="text-gray-600">Silakan kembali lagi nanti untuk melihat koleksi terbaru kami.</p>
                </div>
            <?php else: ?>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <?php foreach ($products as $product): ?>
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
                                    <span class="text-sm text-green-600">
                                        Stok: <?php echo $product['stock']; ?>
                                    </span>
                                </div>
                                <form method="POST" action="">
                                    <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                                    <button type="submit" name="add_to_cart" 
                                        class="w-full bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded transition">
                                        Tambah ke Keranjang
                                    </button>
                                </form>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <!-- Shopping Info Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <h2 class="section-title text-3xl font-bold">Info Pembelian</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-12">
                <div class="text-center">
                    <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-truck text-purple-600 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Pengiriman Cepat</h3>
                    <p class="text-gray-600">Pesanan dikirim dalam 1-2 hari kerja setelah pembayaran</p>
                </div>
                
                <div class="text-center">
                    <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-undo-alt text-purple-600 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Pengembalian Mudah</h3>
                    <p class="text-gray-600">Garansi 7 hari pengembalian untuk produk cacat</p>
                </div>
                
                <div class="text-center">
                    <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-credit-card text-purple-600 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Pembayaran Aman</h3>
                    <p class="text-gray-600">Berbagai metode pembayaran yang aman dan terpercaya</p>
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