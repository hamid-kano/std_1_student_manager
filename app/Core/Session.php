<?php
class Session
{
    public static function start(): void
    {
        if (session_status() === PHP_SESSION_NONE) session_start();
    }

    public static function set(string $key, mixed $value): void
    {
        self::start();
        $_SESSION[$key] = $value;
    }

    public static function get(string $key, mixed $default = null): mixed
    {
        self::start();
        return $_SESSION[$key] ?? $default;
    }

    public static function has(string $key): bool
    {
        self::start();
        return isset($_SESSION[$key]);
    }

    public static function remove(string $key): void
    {
        self::start();
        unset($_SESSION[$key]);
    }

    public static function destroy(): void
    {
        self::start();
        session_destroy();
    }

    // Flash message — يظهر مرة واحدة فقط
    public static function flash(string $key, mixed $value = null): mixed
    {
        self::start();
        if ($value !== null) {
            $_SESSION['_flash'][$key] = $value;
            return null;
        }
        $val = $_SESSION['_flash'][$key] ?? null;
        unset($_SESSION['_flash'][$key]);
        return $val;
    }

    public static function isLoggedIn(): bool
    {
        self::start();
        return !empty($_SESSION['user']);
    }

    public static function user(): array|null
    {
        self::start();
        return $_SESSION['user'] ?? null;
    }

    // حماية الصفحات
    public static function requireLogin(): void
    {
        if (!self::isLoggedIn()) {
            header('Location: /std_1_student_manager/?page=login');
            exit;
        }
    }
}
