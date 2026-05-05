<?php
require_once __DIR__ . '/../app/bootstrap.php';

$db   = Database::getInstance();
$user = $db->query("SELECT id, username, role, password FROM users")->fetchAll();

echo '<pre style="direction:ltr; padding:20px;">';
foreach ($user as $u) {
    echo "ID: {$u['id']} | Username: {$u['username']} | Role: {$u['role']}\n";
    echo "Hash: {$u['password']}\n";
    echo "Verify 'admin123': " . (password_verify('admin123', $u['password']) ? '✅ OK' : '❌ FAIL') . "\n\n";
}
echo '</pre>';
