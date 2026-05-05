<?php require_once __DIR__ . '/../../config/app.php'; ?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>نظام شؤون طلاب الجامعة</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <link rel="stylesheet" href="<?= ASSETS_URL ?>/css/main.css">
  <link rel="stylesheet" href="<?= ASSETS_URL ?>/css/sidebar.css">
  <link rel="stylesheet" href="<?= ASSETS_URL ?>/css/forms.css">
  <link rel="stylesheet" href="<?= ASSETS_URL ?>/css/tables.css">
  <link rel="stylesheet" href="<?= ASSETS_URL ?>/css/cards.css">
</head>
<body>

<div class="header-bar">
  <div class="header-left">
    <span class="system-name">
      <i class="fa-solid fa-graduation-cap"></i>
      نظام شؤون الطلاب
    </span>
  </div>
  <div class="header-right">
    <span class="header-user">
      <i class="fa-solid fa-circle-user"></i>
      <?= htmlspecialchars(Session::user()['username'] ?? '') ?>
    </span>
    <form method="POST" action="/std_1_student_manager/controllers/router.php" style="display:inline">
      <input type="hidden" name="controller" value="auth">
      <input type="hidden" name="action"     value="logout">
      <button type="submit" class="logout-btn">
        <i class="fa-solid fa-right-from-bracket"></i> خروج
      </button>
    </form>
  </div>
</div>
