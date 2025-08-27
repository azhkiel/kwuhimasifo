<?php
require_once '../../includes/auth.php';
require_once '../../includes/db.php';
redirectIfNotLoggedIn();

// Ambil semua aplikasi
$stmt = $pdo->query("SELECT * FROM kotlin_apps ORDER BY name");
$apps = $stmt->fetchAll();

// Tambah aplikasi
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_app'])) {
    $name = $_POST['name'];
    
    // Handle file upload
    $image = null;
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = '../../uploads/';
        $fileName = uniqid() . '_' . basename($_FILES['image']['name']);
        $targetPath = $uploadDir . $fileName;
        
        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetPath)) {
            $image = $fileName;
        }
    }
    
    $stmt = $pdo->prepare("INSERT INTO kotlin_apps (name, image) VALUES (?, ?)");
    $stmt->execute([$name, $image]);
    
    header('Location: apps.php');
    exit;
}

// Hapus aplikasi
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    
    // Hapus file gambar jika ada
    $stmt = $pdo->prepare("SELECT image FROM kotlin_apps WHERE id = ?");
    $stmt->execute([$id]);
    $app = $stmt->fetch();
    
    if ($app && $app['image']) {
        $filePath = '../../uploads/' . $app['image'];
        if (file_exists($filePath)) {
            unlink($filePath);
        }
    }
    
    // Hapus aplikasi dan produk terkait (karena ON DELETE CASCADE)
    $stmt = $pdo->prepare("DELETE FROM kotlin_apps WHERE id = ?");
    $stmt->execute([$id]);
    
    header('Location: apps.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Aplikasi Kotlin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>
<body class="bg-gray-100">
    <header class="bg-white shadow-md">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold text-blue-600">Kelola Aplikasi Kotlin</h1>
                <nav class="mt-2">
                    <a href="../dashboard.php" class="text-gray-600 hover:text-blue-600 mr-4">Dashboard</a>
                    <a href="index.php" class="text-gray-600 hover:text-blue-600 mr-4">Layanan</a>
                    <a href="apps.php" class="text-blue-600 font-semibold">Aplikasi</a>
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
            <button @click="showForm = !showForm" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded mb-4">
                Tambah Aplikasi
            </button>
            
            <div x-show="showForm" class="bg-white p-6 rounded-lg shadow-md mb-6">
                <h3 class="text-xl font-semibold mb-4">Tambah Aplikasi Baru</h3>
                <form method="POST" action="" enctype="multipart/form-data">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="name">Nama Aplikasi</label>
                            <input type="text" id="name" name="name" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        </div>
                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="image">Gambar</label>
                            <input type="file" id="image" name="image" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        </div>
                    </div>
                    
                    <div class="flex justify-end">
                        <button type="button" @click="showForm = false" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded mr-2">
                            Batal
                        </button>
                        <button type="submit" name="add_app" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded">
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
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Gambar</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Aplikasi</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah Layanan</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php foreach ($apps as $app): 
                            // Hitung jumlah layanan untuk aplikasi ini
                            $stmt = $pdo->prepare("SELECT COUNT(*) as count FROM kotlin_products WHERE app_id = ?");
                            $stmt->execute([$app['id']]);
                            $serviceCount = $stmt->fetch()['count'];
                        ?>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="h-10 w-10 flex-shrink-0 bg-gray-200 rounded-full overflow-hidden">
                                        <?php if ($app['image']): ?>
                                            <img src="../../uploads/<?php echo htmlspecialchars($app['image']); ?>" 
                                                 alt="<?php echo htmlspecialchars($app['name']); ?>" 
                                                 class="h-full w-full object-cover">
                                        <?php else: ?>
                                            <div class="h-full w-full flex items-center justify-center text-gray-400">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z" />
                                                </svg>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900"><?php echo htmlspecialchars($app['name']); ?></div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <?php echo $serviceCount; ?> layanan
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <a href="edit_app.php?id=<?php echo $app['id']; ?>" class="text-blue-600 hover:text-blue-900 mr-3">Edit</a>
                                    <a href="apps.php?delete=<?php echo $app['id']; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus aplikasi ini? Semua layanan terkait juga akan dihapus.')" class="text-red-600 hover:text-red-900">Hapus</a>
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