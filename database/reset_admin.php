<?php
require_once __DIR__ . '/../app/bootstrap.php';

$db   = Database::getInstance();
$hash = password_hash('admin123', PASSWORD_DEFAULT);

// حذف المستخدم القديم وإعادة إنشائه بكلمة مرور صحيحة
$db->exec("DELETE FROM users WHERE username = 'admin'");
$db->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, 'admin')")
   ->execute(['admin', $hash]);

echo '<div style="font-family:Cairo,Arial;direction:rtl;padding:40px;max-width:400px;margin:auto;">';
echo '<h2 style="color:#16a34a">✅ تم إعادة تعيين كلمة المرور</h2>';
echo '<p><strong>المستخدم:</strong> admin</p>';
echo '<p><strong>كلمة المرور:</strong> admin123</p>';
echo '<br><a href="/std_1_student_manager/" style="background:#2563eb;color:white;padding:10px 20px;border-radius:8px;text-decoration:none;">الدخول للنظام</a>';
echo '</div>';
