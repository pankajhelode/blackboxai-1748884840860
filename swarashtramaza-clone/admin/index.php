<?php
session_start();

// Simple authentication check
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: login.php');
    exit;
}

// Database connection
$db = new PDO('sqlite:../data/news.db');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Fetch news articles
$stmt = $db->query('SELECT id, title, category, date FROM news ORDER BY date DESC');
$news = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="mr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>प्रशासन पॅनेल - स्वराष्ट्र माझा न्युज</title>
    <link href="https://cdn.tailwindcss.com" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Devanagari&display=swap" rel="stylesheet" />
    <style>
        body {
            font-family: 'Noto Sans Devanagari', sans-serif;
        }
    </style>
</head>
<body class="bg-white text-black">
    <header class="border-b border-gray-300 p-4">
        <h1 class="text-2xl font-bold">प्रशासन पॅनेल - स्वराष्ट्र माझा न्युज</h1>
        <a href="logout.php" class="text-blue-600 hover:underline">बाहेर पडा</a>
    </header>
    <main class="container mx-auto p-4">
        <a href="add_news.php" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">बातमी जोडा</a>
        <table class="w-full mt-4 border border-gray-300">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border border-gray-300 p-2">आयडी</th>
                    <th class="border border-gray-300 p-2">शीर्षक</th>
                    <th class="border border-gray-300 p-2">वर्ग</th>
                    <th class="border border-gray-300 p-2">दिनांक</th>
                    <th class="border border-gray-300 p-2">क्रिया</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($news as $article): ?>
                <tr>
                    <td class="border border-gray-300 p-2 text-center"><?php echo htmlspecialchars($article['id']); ?></td>
                    <td class="border border-gray-300 p-2"><?php echo htmlspecialchars($article['title']); ?></td>
                    <td class="border border-gray-300 p-2"><?php echo htmlspecialchars($article['category']); ?></td>
                    <td class="border border-gray-300 p-2 text-center"><?php echo htmlspecialchars($article['date']); ?></td>
                    <td class="border border-gray-300 p-2 text-center">
                        <a href="edit_news.php?id=<?php echo $article['id']; ?>" class="text-blue-600 hover:underline mr-2">संपादित करा</a>
                        <a href="delete_news.php?id=<?php echo $article['id']; ?>" class="text-red-600 hover:underline" onclick="return confirm('तुम्हाला खात्री आहे का की तुम्ही ही बातमी हटवू इच्छिता?');">हटवा</a>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php if (empty($news)): ?>
                <tr>
                    <td colspan="5" class="text-center p-4">कोणतीही बातमी सापडली नाही.</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </main>
</body>
</html>
