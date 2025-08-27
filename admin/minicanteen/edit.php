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
$stmt = $pdo->prepare("SELECT * FROM minicanteen_products WHERE id = ?");
$stmt->execute([$id]);
$product = $stmt->fetch();

if (!$product) {
    header('Location: index.php');
    exit;
}

// Ambil semua kategori untuk dropdown
$stmt = $pdo->query("SELECT * FROM minicanteen_categories ORDER BY name");
$categories = $stmt->fetchAll();

// Update produk
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_product'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    $category_id = $_POST['category_id'];
    
    // Handle file upload
    $image = $product['image'];
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        // Hapus gambar lama jika ada
        if ($image) {
            $oldFilePath = '../../uploads/' . $image;
            if (file_exists($oldFilePath)) {
                unlink($oldFilePath);
            }
        }
        
        $uploadDir = '../../uploads/';
        $fileName = uniqid() . '_' . basename($_FILES['image']['name']);
        $targetPath = $uploadDir . $fileName;
        
        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetPath)) {
            $image = $fileName;
        }
    }
    
    $stmt = $pdo->prepare("UPDATE minicanteen_products SET name = ?, description = ?, price = ?, stock = ?, image = ?, category_id = ? WHERE id = ?");
    $stmt->execute([$name, $description, $price, $stock, $image, $category_id, $id]);
    
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Produk - Mini Canteen</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <header class="bg-white shadow-md">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold text-blue-600">Edit Produk Mini Canteen</h1>
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
            <h2 class="text-xl font-semibold mb-6">Edit Produk: <?php echo htmlspecialchars($product['name']); ?></h2>
            
            <form method="POST" action="" enctype="multipart/form-data">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="name">Nama Produk</label>
                        <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($product['name']); ?>" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="category_id">Kategori</label>
                        <select id="category_id" name="category_id" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            <option value="">Pilih Kategori</option>
                            <?php foreach ($categories as $category): ?>
                                <option value="<?php echo $category['id']; ?>" <?php echo $category['id'] == $product['category_id'] ? 'selected' : ''; ?>>
                                    <?php echo htmlspecialchars($category['name']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="description">Deskripsi</label>
                    <textarea id="description" name="description" rows="3" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"><?php echo htmlspecialchars($product['description']); ?></textarea>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="price">Harga</label>
                        <input type="number" id="price" name="price" min="0" step="0.01" value="<?php echo $product['price']; ?>" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="stock">Stok</label>
                        <input type="number" id="stock" name="stock" min="0" value="<?php echo $product['stock']; ?>" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="image">Gambar</label>
                        <input type="file" id="image" name="image" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        <?php if ($product['image']): ?>
                            <div class="mt-2">
                                <img src="../../uploads/<?php echo htmlspecialchars($product['image']); ?>" alt="Current image" class="h-20 object-cover rounded">
                                <p class="text-xs text-gray-500 mt-1">Gambar saat ini</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                
                <div class="flex justify-end">
                    <a href="index.php" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded mr-2">
                        Batal
                    </a>
                    <button type="submit" name="update_product" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                        Update Produk
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