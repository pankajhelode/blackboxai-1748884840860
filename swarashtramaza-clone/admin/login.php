<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // Simple hardcoded credentials for demo
    if ($username === 'admin' && $password === 'password') {
        $_SESSION['logged_in'] = true;
        header('Location: index.php');
        exit;
    } else {
        $error = "Invalid username or password";
    }
}
?>
<!DOCTYPE html>
<html lang="mr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>प्रवेश - प्रशासन पॅनेल</title>
    <link href="https://cdn.tailwindcss.com" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Devanagari&display=swap" rel="stylesheet" />
    <style>
        body {
            font-family: 'Noto Sans Devanagari', sans-serif;
        }
    </style>
</head>
<body class="bg-white text-black flex items-center justify-center min-h-screen">
    <form method="POST" class="bg-gray-100 p-6 rounded shadow-md w-full max-w-sm">
        <h1 class="text-2xl font-bold mb-4">प्रशासन प्रवेश</h1>
        <?php if (!empty($error)): ?>
            <p class="text-red-600 mb-4"><?php echo htmlspecialchars($error); ?></p>
        <?php endif; ?>
        <label class="block mb-2" for="username">वापरकर्तानाव</label>
        <input type="text" id="username" name="username" required class="w-full p-2 mb-4 border border-gray-300 rounded" />
        <label class="block mb-2" for="password">संकेतशब्द</label>
        <input type="password" id="password" name="password" required class="w-full p-2 mb-4 border border-gray-300 rounded" />
        <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700 transition">प्रवेश करा</button>
    </form>
</body>
</html>
