<?php require_once __DIR__ . '/../../config/app.php'; ?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>نظام شؤون طلاب الجامعة</title>

  <!-- Google Fonts - Cairo -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700&display=swap" rel="stylesheet">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

  <link rel="stylesheet" href="<?= ASSETS_URL ?>/css/main.css">
  <link rel="stylesheet" href="<?= ASSETS_URL ?>/css/sidebar.css">
  <link rel="stylesheet" href="<?= ASSETS_URL ?>/css/forms.css">
  <link rel="stylesheet" href="<?= ASSETS_URL ?>/css/tables.css">
  <link rel="stylesheet" href="<?= ASSETS_URL ?>/css/cards.css">
  <link rel="stylesheet" href="<?= ASSETS_URL ?>/css/login.css">
</head>
<body>

<!-- ===== Header Bar ===== -->
<div class="header-bar">
  <div class="header-left">
    <span class="system-name"></span>
  </div>
  <div class="header-right">
    <button class="logout-btn" onclick="logout()">
      <i class="fa-solid fa-right-from-bracket"></i> تسجيل الخروج
    </button>
  </div>
</div>
