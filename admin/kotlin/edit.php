<?php
require_once '../../includes/auth.php';
require_once '../../includes/db.php';
redirectIfNotLoggedIn();

if (!isset($_GET['id'])) {
    header('Location: index.php');
    exit;
}

$id = $_GET['id'];

// Ambil data produk
$stmt = $pdo->prepare("
    SELECT kp.*, ka.name as app_name 
    FROM kotlin_products kp 
    JOIN kotlin_apps ka ON kp.app_id = ka.id 
    WHERE kp.id = ?
");
$stmt->execute([$id]);
$product = $stmt->fetch();

if (!$product) {
    header('Location: index.php');
    exit;
}

// Ambil semua apps untuk dropdown
$stmt = $pdo->query("SELECT * FROM kotlin_apps ORDER BY name");
$apps = $stmt->fetchAll();

// Update produk
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_product'])) {
    $app_id = $_POST['app_id'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    
    $stmt = $pdo->prepare("UPDATE kotlin_products SET app_id = ?, description = ?, price = ? WHERE id = ?");
    $stmt->execute([$app_id, $description, $price, $id]);
    
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Layanan - Kotlin Apps</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <header class="bg-white shadow-md">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold text-blue-600">Edit Layanan Kotlin Apps</h1>
                <nav class="mt-2">
                    <a href="../dashboard.php" class="text-gray-600 hover:text-blue-600 mr-4">Dashboard</a>
                    <a href="index.php" class="text-blue-600 font-semibold">Kembali ke Daftar</a>
                </nav>
            </div>
            <div>
                <span class="text-gray-600 mr-4">Halo, <?php echo $_SESSION['username']; ?></span>
                <a href="../../logout.php" class="text-red-600 hover:text-red-800">Logout</a>
            </div>
        </div>
    </header>

    <main class="container mx-auto px-4 py-8">
        <div class="bg-white p-6 rounded-lg shadow-md max-w-3xl mx-auto">
            <h2 class="text-xl font-semibold mb-6">Edit Layanan: <?php echo htmlspecialchars($product['app_name']); ?></h2>
            
            <form method="POST" action="">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="app_id">Aplikasi</label>
                        <select id="app_id" name="app_id" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            <option value="">Pilih Aplikasi</option>
                            <?php foreach ($apps as $app): ?>
                                <option value="<?php echo $app['id']; ?>" <?php echo $app['id'] == $product['app_id'] ? 'selected' : ''; ?>>
                                    <?php echo htmlspecialchars($app['name']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="price">Harga</label>
                        <input type="number" id="price" name="price" min="0" step="0.01" value="<?php echo $product['price']; ?>" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>
                </div>
                
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="description">Deskripsi Layanan</label>
                    <textarea id="description" name="description" rows="3" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"><?php echo htmlspecialchars($product['description']); ?></textarea>
                </div>
                
                <div class="flex justify-end">
                    <a href="index.php" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded mr-2">
                        Batal
                    </a>
                    <button type="submit" name="update_product" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded">
                        Update Layanan
                    </button>
                </div>
            </form>
        </div>
    </main>

    <footer class="bg-gray-800 text-white py-6 mt-12">
        <div class="container mx-auto px-4 text-center">
            <p>&copy; 2023 Admin Panel. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>