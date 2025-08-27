<?php 
$current_page = basename($_SERVER['PHP_SELF']); 
?>
<header class="bg-white shadow-md sticky top-0 z-50">
    <div class="container mx-auto px-4 py-4 flex justify-between items-center">
        <a href="index.php" class="flex items-center space-x-2">
            <div class="w-10 h-10 bg-blue-600 rounded-lg flex items-center justify-center">
                <i class="fas fa-store text-white text-lg"></i>
            </div>
            <span class="text-xl font-bold text-gray-800">kwuhimasifo</span>
        </a>
        
        <nav class="hidden md:flex space-x-8">
            <a href="index.php" class="transition <?= $current_page == 'index.php' ? 'text-blue-600 font-semibold' : 'text-gray-600 hover:text-blue-600' ?>">Beranda</a>
            <a href="minicanteen.php" class="transition <?= $current_page == 'minicanteen.php' ? 'text-blue-600 font-semibold' : 'text-gray-600 hover:text-blue-600' ?>">Mini Canteen</a>
            <a href="kotlin.php" class="transition <?= $current_page == 'kotlin.php' ? 'text-blue-600 font-semibold' : 'text-gray-600 hover:text-blue-600' ?>">Kotlin Apps</a>
            <a href="mersi.php" class="transition <?= $current_page == 'mersi.php' ? 'text-blue-600 font-semibold' : 'text-gray-600 hover:text-blue-600' ?>">Merchandise</a>
        </nav>
        
        <div class="flex items-center space-x-4">
            <a href="cart.php" class="relative">
                <i class="fas fa-shopping-cart text-gray-700 text-xl"></i>
                <?php if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0): ?>
                    <span class="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">
                        <?php echo count($_SESSION['cart']); ?>
                    </span>
                <?php endif; ?>
            </a>
            <button class="md:hidden" id="mobile-menu-button">
                <i class="fas fa-bars text-gray-700 text-xl"></i>
            </button>
        </div>
    </div>
    
    <!-- Mobile Menu -->
    <div class="hidden md:hidden bg-white border-t" id="mobile-menu">
        <div class="container mx-auto px-4 py-3 flex flex-col space-y-3">
            <a href="index.php" class="<?= $current_page == 'index.php' ? 'text-blue-600 font-semibold' : 'text-gray-600 hover:text-blue-600' ?>">Beranda</a>
            <a href="minicanteen.php" class="<?= $current_page == 'minicanteen.php' ? 'text-blue-600 font-semibold' : 'text-gray-600 hover:text-blue-600' ?>">Mini Canteen</a>
            <a href="kotlin.php" class="<?= $current_page == 'kotlin.php' ? 'text-blue-600 font-semibold' : 'text-gray-600 hover:text-blue-600' ?>">Kotlin Apps</a>
            <a href="mersi.php" class="<?= $current_page == 'mersi.php' ? 'text-blue-600 font-semibold' : 'text-gray-600 hover:text-blue-600' ?>">Merchandise</a>
        </div>
    </div>
</header>
<div x-data="{ open: false, issue: '', desc: '' }">
    <!-- Floating Report Button -->
    <button 
        @click="open = true"
        class="fixed bottom-6 right-6 bg-red-600 text-white py-4 px-5 rounded-full shadow-lg hover:bg-red-700 focus:outline-none focus:ring-4 focus:ring-red-300 transition">
        <i class="fas fa-flag"></i>
    </button>

    <!-- Modal -->
    <div 
        x-show="open"
        class="fixed inset-0 flex items-center justify-center z-50"
        x-transition
    >
        <div class="bg-white rounded-2xl shadow-lg w-96 p-6 relative">
            <!-- Close -->
            <button 
                @click="open = false" 
                class="absolute top-3 right-3 text-gray-400 hover:text-gray-600">
                <i class="fas fa-times"></i>
            </button>

            <h2 class="text-xl font-semibold text-gray-800 mb-4">Laporkan Masalah</h2>

            <!-- Dropdown Pilihan -->
            <label class="block text-sm font-medium text-gray-700">Jenis Laporan</label>
            <select x-model="issue" class="w-full border rounded-lg px-3 py-2 mt-1 mb-3 focus:ring focus:ring-red-200">
                <option value="">-- Pilih Masalah --</option>
                <option value="Stok Habis">📦 Stok Habis</option>
                <option value="Website Ngebug">🐞 Website Ngebug</option>
                <option value="Kesalahan Data">📊 Kesalahan Data</option>
                <option value="Lainnya">✍️ Lainnya</option>
            </select>

            <!-- Deskripsi -->
            <label class="block text-sm font-medium text-gray-700">Deskripsi</label>
            <textarea x-model="desc" rows="3" class="w-full border rounded-lg px-3 py-2 mt-1 mb-4 focus:ring focus:ring-red-200" placeholder="Jelaskan lebih detail..."></textarea>

            <!-- Tombol Kirim -->
            <a 
                :href="'https://wa.me/6283892036920?text=' + encodeURIComponent(
                    '📢 *LAPORAN*\n\n' +
                    '*Jenis:* ' + issue + '\n' +
                    '*Deskripsi:* ' + desc
                )" 
                target="_blank"
                class="block w-full text-center bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition">
                Kirim ke WhatsApp
            </a>
        </div>
    </div>
</div>