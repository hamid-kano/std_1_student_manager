<?php
/**
 * migrate.php - إنشاء الجداول وبيانات أولية
 * شغّله مرة واحدة: http://localhost/std_1_student_manager/database/migrate.php
 */
require_once __DIR__ . '/../app/bootstrap.php';

try {
    $db  = Database::getInstance();
    $sql = file_get_contents(__DIR__ . '/schema.sql');

    foreach (array_filter(array_map('trim', explode(';', $sql))) as $stmt) {
        $db->exec($stmt);
    }

    // إضافة مستخدم admin بكلمة مرور مشفرة
    $hash = password_hash('admin123', PASSWORD_DEFAULT);
    $db->prepare("INSERT OR IGNORE INTO users (username, password, role) VALUES (?, ?, 'admin')")
       ->execute(['admin', $hash]);

    echo '<div style="font-family:Cairo,Arial;direction:rtl;padding:40px;max-width:500px;margin:auto;">';
    echo '<h2 style="color:#16a34a">✅ تم إنشاء قاعدة البيانات بنجاح</h2>';
    echo '<p>بيانات الدخول الافتراضية:</p>';
    echo '<p><strong>المستخدم:</strong> admin</p>';
    echo '<p><strong>كلمة المرور:</strong> admin123</p>';
    echo '<br><a href="/std_1_student_manager/" style="background:#2563eb;color:white;padding:10px 20px;border-radius:8px;text-decoration:none;">الدخول للنظام</a>';
    echo '</div>';

} catch (Exception $e) {
    echo '<div style="font-family:Arial;direction:rtl;padding:30px;color:red;">';
    echo '<h2>❌ خطأ</h2><p>' . $e->getMessage() . '</p>';
    echo '</div>';
}
