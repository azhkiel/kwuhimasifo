<?php
require_once '../../includes/auth.php';
require_once '../../includes/db.php';
redirectIfNotLoggedIn();

if (!isset($_GET['id'])) {
    header('Location: apps.php');
    exit;
}

$id = $_GET['id'];

// Ambil data aplikasi
$stmt = $pdo->prepare("SELECT * FROM kotlin_apps WHERE id = ?");
$stmt->execute([$id]);
$app = $stmt->fetch();

if (!$app) {
    header('Location: apps.php');
    exit;
}

// Update aplikasi
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_app'])) {
    $name = $_POST['name'];
    
    // Handle file upload
    $image = $app['image'];
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
    
    $stmt = $pdo->prepare("UPDATE kotlin_apps SET name = ?, image = ? WHERE id = ?");
    $stmt->execute([$name, $image, $id]);
    
    header('Location: apps.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Aplikasi - Kotlin Apps</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <header class="bg-white shadow-md">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold text-blue-600">Edit Aplikasi Kotlin</h1>
                <nav class="mt-2">
                    <a href="../dashboard.php" class="text-gray-600 hover:text-blue-600 mr-4">Dashboard</a>
                    <a href="apps.php" class="text-blue-600 font-semibold">Kembali ke Daftar</a>
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
            <h2 class="text-xl font-semibold mb-6">Edit Aplikasi: <?php echo htmlspecialchars($app['name']); ?></h2>
            
            <form method="POST" action="" enctype="multipart/form-data">
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="name">Nama Aplikasi</label>
                    <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($app['name']); ?>" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="image">Gambar</label>
                    <input type="file" id="image" name="image" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    <?php if ($app['image']): ?>
                        <div class="mt-2">
                            <img src="../../uploads/<?php echo htmlspecialchars($app['image']); ?>" alt="Current image" class="h-20 object-cover rounded">
                            <p class="text-xs text-gray-500 mt-1">Gambar saat ini</p>
                        </div>
                    <?php endif; ?>
                </div>
                
                <div class="flex justify-end">
                    <a href="apps.php" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded mr-2">
                        Batal
                    </a>
                    <button type="submit" name="update_app" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded">
                        Update Aplikasi
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