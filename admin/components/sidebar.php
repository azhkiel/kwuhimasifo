<?php
// Pastikan session sudah dimulai
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

<div x-data="{ sidebarOpen: window.innerWidth >= 1024, isMobile: window.innerWidth < 1024 }" 
      @resize.window="isMobile = (window.innerWidth < 1024); if(!isMobile) sidebarOpen = true">
    <!-- Overlay untuk mobile -->
    <div x-show="isMobile && sidebarOpen" @click="sidebarOpen = false" 
         class="fixed inset-0 bg-black bg-opacity-50 z-20 transition-opacity duration-300">
    </div>

    <!-- Sidebar -->
    <div class="fixed top-0 left-0 h-full bg-white shadow-lg z-30 sidebar-transition w-64"
         :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'">
        
        <div class="p-5 border-b border-gray-200 flex items-center justify-between">
            <h1 class="text-xl font-bold text-blue-600">Kelola Mini Canteen</h1>
            <button @click="sidebarOpen = false" class="lg:hidden text-gray-500 hover:text-gray-700">
                <i class="fas fa-times text-lg"></i>
            </button>
        </div>
        
        <div class="p-4 border-b border-gray-200">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 rounded-full bg-blue-600 flex items-center justify-center text-white font-bold">
                    <?php echo substr($_SESSION['username'], 0, 1); ?>
                </div>
                <div>
                    <p class="text-sm font-medium">Halo, <?php echo $_SESSION['username']; ?></p>
                </div>
            </div>
        </div>
        
        <nav class="mt-4">
            <a href="../dashboard.php" class="flex items-center px-4 py-3 text-gray-600 hover:bg-blue-50 hover:text-blue-600 transition-all duration-200">
                <i class="fas fa-th-large mr-3"></i>
                <span>Dashboard</span>
            </a>
            <a href="index.php" class="flex items-center px-4 py-3 active-nav-link text-blue-600">
                <i class="fas fa-utensils mr-3"></i>
                <span>Mini Canteen</span>
            </a>
            <a href="../kotlin/" class="flex items-center px-4 py-3 text-gray-600 hover:bg-blue-50 hover:text-blue-600 transition-all duration-200">
                <i class="fab fa-android mr-3"></i>
                <span>Kotlin Apps</span>
            </a>
            <a href="../mersi/" class="flex items-center px-4 py-3 text-gray-600 hover:bg-blue-50 hover:text-blue-600 transition-all duration-200">
                <i class="fas fa-tshirt mr-3"></i>
                <span>Merchandise</span>
            </a>
            <a href="../../logout.php" class="flex items-center px-4 py-3 text-gray-600 hover:bg-blue-50 hover:text-red-600 transition-all duration-200 mt-4">
                <i class="fas fa-sign-out-alt mr-3"></i>
                <span>Logout</span>
            </a>
        </nav>
    </div>

    <div :class="sidebarOpen && !isMobile ? 'lg:ml-64' : ''" class="min-h-screen transition-all duration-300">
        <header class="bg-white shadow-md">
            <div class="px-4 py-4 flex justify-between items-center">
                <button @click="sidebarOpen = !sidebarOpen" class="text-gray-600 hover:text-blue-600">
                    <i class="fas fa-bars text-xl"></i>
                </button>
                <div>
                    <span class="text-gray-600 mr-4">Halo, <?php echo $_SESSION['username']; ?></span>
                    <a href="../../logout.php" class="text-red-600 hover:text-red-800">Logout</a>
                </div>
            </div>
        </header>
        <div class="p-6">