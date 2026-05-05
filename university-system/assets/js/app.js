/**
 * app.js - التنقل بين الصفحات
 */

function showPage(id, el) {
  document.querySelectorAll('.page').forEach(p => p.classList.remove('active'));
  document.getElementById(id).classList.add('active');
  document.querySelectorAll('.sidebar a').forEach(a => a.classList.remove('active'));
  el.classList.add('active');
}

function getNowDate() {
  return new Date().toLocaleString('ar-EG');
}
