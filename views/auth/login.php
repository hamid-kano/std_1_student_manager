<?php require_once __DIR__ . '/../../config/app.php'; ?>
<div id="loginPage" class="login-overlay">
  <div class="login-card">

    <img src="<?= ASSETS_URL ?>/images/logo.jfif" alt="شعار" class="login-logo">
    <h2>نظام شؤون الطلاب</h2>
    <p class="subtitle">تسجيل الدخول للمتابعة</p>

    <div class="input-group">
      <input id="loginUser" required autocomplete="username">
      <label>اسم المستخدم</label>
    </div>

    <div class="input-group">
      <input id="loginPass" type="password" required autocomplete="current-password">
      <label>كلمة المرور</label>
    </div>

    <button onclick="login()">دخول</button>
    <p id="loginError" class="error">❌ اسم المستخدم أو كلمة المرور غير صحيحة</p>
  </div>
</div>
