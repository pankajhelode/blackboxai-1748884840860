<?php
// Initialize SQLite database and create tables

$db = new PDO('sqlite:news.db');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Create news table
$db->exec("CREATE TABLE IF NOT EXISTS news (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    title TEXT NOT NULL,
    category TEXT NOT NULL,
    content TEXT NOT NULL,
    image_url TEXT,
    date TEXT NOT NULL
)");

// Create users table for admin authentication (optional for future)
$db->exec("CREATE TABLE IF NOT EXISTS users (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    username TEXT NOT NULL UNIQUE,
    password_hash TEXT NOT NULL
)");

// Insert default admin user (username: admin, password: password)
$check = $db->query("SELECT COUNT(*) FROM users WHERE username = 'admin'")->fetchColumn();
if ($check == 0) {
    $passwordHash = password_hash('password', PASSWORD_DEFAULT);
    $stmt = $db->prepare("INSERT INTO users (username, password_hash) VALUES (?, ?)");
    $stmt->execute(['admin', $passwordHash]);
}

echo "Database initialized successfully.\n";
?>
