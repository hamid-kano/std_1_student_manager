<div id="loginPage" class="login-overlay">
  <div class="login-card">
    <h2>تسجيل الدخول</h2>
    <p class="subtitle">نظام شؤون الطلاب</p>

    <div class="input-group">
      <input id="loginUser" required>
      <label>اسم المستخدم</label>
    </div>

    <div class="input-group">
      <input id="loginPass" type="password" required>
      <label>كلمة المرور</label>
    </div>

    <button onclick="login()">دخول</button>
    <p id="loginError" class="error">بيانات غير صحيحة</p>
  </div>
</div>
