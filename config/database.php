<?php
/**
 * Database Configuration
 * لتبديل قاعدة البيانات، غيّر DB_DRIVER فقط
 */

// ===== SQLite (الافتراضي) =====
define('DB_DRIVER', 'sqlite');
define('DB_PATH',   __DIR__ . '/../database/university.sqlite');

// ===== MySQL (للمستقبل - فعّل هذا وعطّل SQLite أعلاه) =====
// define('DB_DRIVER', 'mysql');
// define('DB_HOST',   'localhost');
// define('DB_NAME',   'university_db');
// define('DB_USER',   'root');
// define('DB_PASS',   '');
// define('DB_CHARSET','utf8mb4');
