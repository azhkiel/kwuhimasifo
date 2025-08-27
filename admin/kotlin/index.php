<?php
require_once '../../includes/auth.php';
require_once '../../includes/db.php';
redirectIfNotLoggedIn();

// Ambil semua produk kotlin dengan info app
$stmt = $pdo->query("
    SELECT kp.*, ka.name as app_name 
    FROM kotlin_products kp 
    JOIN kotlin_apps ka ON kp.app_id = ka.id 
    ORDER BY ka.name, kp.price
");
$products = $stmt->fetchAll();

// Ambil semua apps untuk dropdown
$stmt = $pdo->query("SELECT * FROM kotlin_apps ORDER BY name");
$apps = $stmt->fetchAll();

// Tambah produk
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_product'])) {
    $app_id = $_POST['app_id'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    
    $stmt = $pdo->prepare("INSERT INTO kotlin_products (app_id, description, price) VALUES (?, ?, ?)");
    $stmt->execute([$app_id, $description, $price]);
    
    header('Location: index.php');
    exit;
}

// Hapus produk
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    
    $stmt = $pdo->prepare("DELETE FROM kotlin_products WHERE id = ?");
    $stmt->execute([$id]);
    
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Kotlin Apps</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>
<body class="bg-gray-100">
    <header class="bg-white shadow-md">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold text-blue-600">Kelola Kotlin Apps</h1>
                <nav class="mt-2">
                    <a href="../dashboard.php" class="text-gray-600 hover:text-blue-600 mr-4">Dashboard</a>
                    <a href="../minicanteen/" class="text-gray-600 hover:text-blue-600 mr-4">Mini Canteen</a>
                    <a href="index.php" class="text-blue-600 font-semibold mr-4">Kotlin Apps</a>
                    <a href="apps.php" class="text-gray-600 hover:text-blue-600">Aplikasi</a>
                    <a href="../mersi/" class="text-gray-600 hover:text-blue-600">Merchandise</a>
                </nav>
            </div>
            <div>
                <span class="text-gray-600 mr-4">Halo, <?php echo $_SESSION['username']; ?></span>
                <a href="../../logout.php" class="text-red-600 hover:text-red-800">Logout</a>
            </div>
        </div>
    </header>

    <main class="container mx-auto px-4 py-8">
        <div x-data="{ showForm: false }" class="mb-8">
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-3xl font-bold">Kelola Layanan Kotlin Apps</h2>
                <a href="apps.php" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded">
                    Kelola Aplikasi
                </a>
            </div>
            <button @click="showForm = !showForm" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded mb-4">
                Tambah Layanan
            </button>
            
            <div x-show="showForm" class="bg-white p-6 rounded-lg shadow-md mb-6">
                <h3 class="text-xl font-semibold mb-4">Tambah Layanan Baru</h3>
                <form method="POST" action="">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="app_id">Aplikasi</label>
                            <select id="app_id" name="app_id" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                <option value="">Pilih Aplikasi</option>
                                <?php foreach ($apps as $app): ?>
                                    <option value="<?php echo $app['id']; ?>"><?php echo htmlspecialchars($app['name']); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="price">Harga</label>
                            <input type="number" id="price" name="price" min="0" step="0.01" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="description">Deskripsi Layanan</label>
                        <textarea id="description" name="description" rows="3" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"></textarea>
                    </div>
                    
                    <div class="flex justify-end">
                        <button type="button" @click="showForm = false" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded mr-2">
                            Batal
                        </button>
                        <button type="submit" name="add_product" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
        
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aplikasi</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Deskripsi</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Harga</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php foreach ($products as $product): ?>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    <?php echo htmlspecialchars($product['app_name']); ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900"><?php echo htmlspecialchars($product['description']); ?></div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    Rp <?php echo number_format($product['price'], 0, ',', '.'); ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <a href="edit.php?id=<?php echo $product['id']; ?>" class="text-blue-600 hover:text-blue-900 mr-3">Edit</a>
                                    <a href="index.php?delete=<?php echo $product['id']; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus layanan ini?')" class="text-red-600 hover:text-red-900">Hapus</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <footer class="bg-gray-800 text-white py-6 mt-12">
        <div class="container mx-auto px-4 text-center">
            <p>&copy; 2023 Admin Panel. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>