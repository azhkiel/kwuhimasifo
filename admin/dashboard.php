<?php
require_once '../includes/auth.php';
require_once '../includes/db.php';
redirectIfNotLoggedIn();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>
<body class="bg-gray-100">
    <header class="bg-white shadow-md">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <h1 class="text-2xl font-bold text-blue-600">Dashboard Admin</h1>
            <div>
                <span class="text-gray-600 mr-4">Halo, <?php echo $_SESSION['username']; ?></span>
                <a href="../logout.php" class="text-red-600 hover:text-red-800">Logout</a>
            </div>
        </div>
    </header>

    <main class="container mx-auto px-4 py-8">
        <h2 class="text-3xl font-bold mb-8 text-center">Panel Admin</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Mini Canteen Card -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow">
                <div class="h-48 bg-blue-100 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7" />
                    </svg>
                </div>
                <div class="p-6">
                    <h3 class="font-bold text-xl mb-4">Mini Canteen</h3>
                    <p class="text-gray-700 mb-4">Kelola produk makanan dan minuman</p>
                    <a href="minicanteen/" class="block w-full bg-blue-500 hover:bg-blue-600 text-white text-center font-bold py-2 px-4 rounded">
                        Kelola
                    </a>
                </div>
            </div>
            
            <!-- Kotlin Apps Card -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow">
                <div class="h-48 bg-green-100 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z" />
                    </svg>
                </div>
                <div class="p-6">
                    <h3 class="font-bold text-xl mb-4">Kotlin Apps</h3>
                    <p class="text-gray-700 mb-4">Kelola layanan digital premium</p>
                    <a href="kotlin/" class="block w-full bg-green-500 hover:bg-green-600 text-white text-center font-bold py-2 px-4 rounded">
                        Kelola
                    </a>
                </div>
            </div>
            
            <!-- Mersi Card -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow">
                <div class="h-48 bg-purple-100 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                    </svg>
                </div>
                <div class="p-6">
                    <h3 class="font-bold text-xl mb-4">Merchandise</h3>
                    <p class="text-gray-700 mb-4">Kelola produk merchandise</p>
                    <a href="mersi/" class="block w-full bg-purple-500 hover:bg-purple-600 text-white text-center font-bold py-2 px-4 rounded">
                        Kelola
                    </a>
                </div>
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