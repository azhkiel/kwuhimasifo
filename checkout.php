<?php
session_start();

if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    header('Location: cart.php');
    exit;
}

$cart = $_SESSION['cart'];
$total = 0;
$items_text = "";

foreach ($cart as $item) {
    $subtotal = $item['price'] * $item['quantity'];
    $total += $subtotal;
    $items_text .= "- " . $item['name'] . " x " . $item['quantity'] . "\n";
}

$message = "Halo, saya ingin memesan merchandise:\n" . $items_text . "Total: Rp " . number_format($total, 0, ',', '.') . "\nMohon konfirmasi ketersediaan.";
$encoded_message = urlencode($message);
$whatsapp_url = "https://wa.me/6283892036920?text=" . $encoded_message;

// Clear cart after checkout
unset($_SESSION['cart']);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <meta http-equiv="refresh" content="3;url=<?php echo $whatsapp_url; ?>">
</head>
<body class="bg-gray-100">
    <header class="bg-white shadow-md">
        <div class="container mx-auto px-4 py-4">
            <h1 class="text-2xl font-bold text-blue-600">Checkout</h1>
            <nav class="mt-4">
                <a href="minicanteen.php" class="text-gray-600 hover:text-blue-600 mr-4">Mini Canteen</a>
                <a href="kotlin.php" class="text-gray-600 hover:text-blue-600 mr-4">Kotlin Apps</a>
                <a href="mersi.php" class="text-gray-600 hover:text-blue-600">Merchandise</a>
            </nav>
        </div>
    </header>

    <main class="container mx-auto px-4 py-8">
        <div class="bg-white rounded-lg shadow-md p-8 text-center max-w-2xl mx-auto">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-green-500 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
            <h2 class="text-2xl font-bold mb-4">Pesanan Anda Berhasil!</h2>
            <p class="text-gray-600 mb-6">Anda akan diarahkan ke WhatsApp dalam 3 detik untuk menyelesaikan pemesanan.</p>
            <p class="text-gray-600 mb-6">Jika tidak otomatis terarah, klik tombol di bawah ini:</p>
            <a href="<?php echo $whatsapp_url; ?>" target="_blank" class="bg-green-500 hover:bg-green-600 text-white font-bold py-3 px-6 rounded-lg inline-flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z" />
                </svg>
                Hubungi via WhatsApp
            </a>
        </div>
    </main>

    <footer class="bg-gray-800 text-white py-6 mt-12">
        <div class="container mx-auto px-4 text-center">
            <p>&copy; 2023 Merchandise. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>