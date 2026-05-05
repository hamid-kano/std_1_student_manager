/**
 * auth.js - تسجيل الدخول والخروج
 */

const USERNAME = 'admin';
const PASSWORD = '1234';

function login() {
  const u = document.getElementById('loginUser').value.trim();
  const p = document.getElementById('loginPass').value.trim();

  if (u === USERNAME && p === PASSWORD) {
    sessionStorage.setItem('auth', '1');
    document.getElementById('loginPage').style.display = 'none';
    document.querySelector('.dashboard').style.display  = 'flex';
  } else {
    document.getElementById('loginError').style.display = 'block';
  }
}

function logout() {
  if (!confirm('هل تريد تسجيل الخروج؟')) return;
  sessionStorage.removeItem('auth');
  document.querySelector('.dashboard').style.display  = 'none';
  document.getElementById('loginPage').style.display  = 'flex';
  document.getElementById('loginUser').value = '';
  document.getElementById('loginPass').value = '';
}

// فحص الجلسة عند تحميل الصفحة
document.addEventListener('DOMContentLoaded', () => {
  if (sessionStorage.getItem('auth') === '1') {
    document.getElementById('loginPage').style.display = 'none';
    document.querySelector('.dashboard').style.display  = 'flex';
  }
});
