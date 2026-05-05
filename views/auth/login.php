<?php require_once __DIR__ . '/../../config/app.php'; ?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>تسجيل الدخول - نظام شؤون الطلاب</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="<?= ASSETS_URL ?>/css/main.css">
  <link rel="stylesheet" href="<?= ASSETS_URL ?>/css/login.css">
</head>
<body>

<div class="login-overlay">
  <div class="login-card">

    <img src="<?= ASSETS_URL ?>/images/logo.jfif" alt="شعار" class="login-logo">
    <h2>نظام شؤون الطلاب</h2>
    <p class="subtitle">تسجيل الدخول للمتابعة</p>

    <?php if ($err = Session::flash('error')): ?>
      <p class="error" style="display:block"><?= htmlspecialchars($err) ?></p>
    <?php endif; ?>

    <form method="POST" action="/std_1_student_manager/controllers/router.php">
      <input type="hidden" name="controller" value="auth">
      <input type="hidden" name="action"     value="login">

      <div class="input-group">
        <input type="text" name="username" id="loginUser"
               value="<?= htmlspecialchars($_POST['username'] ?? '') ?>" required autocomplete="username">
        <label for="loginUser">اسم المستخدم</label>
      </div>

      <div class="input-group">
        <input type="password" name="password" id="loginPass" required autocomplete="current-password">
        <label for="loginPass">كلمة المرور</label>
      </div>

      <button type="submit">دخول</button>
    </form>

  </div>
</div>

</body>
</html>
