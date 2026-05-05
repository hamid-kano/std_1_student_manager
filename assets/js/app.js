/**
 * app.js - التنقل بين الصفحات + Mobile menu
 */

function showPage(id, el) {
  document.querySelectorAll('.page').forEach(p => p.classList.remove('active'));
  document.getElementById(id).classList.add('active');
  document.querySelectorAll('.sidebar a').forEach(a => a.classList.remove('active'));
  el.classList.add('active');

  // إغلاق القائمة في الموبايل بعد الاختيار
  if (window.innerWidth <= 768) {
    closeSidebar();
  }
}

function getNowDate() {
  return new Date().toLocaleString('ar-EG');
}

// Mobile sidebar toggle
function toggleSidebar() {
  const sidebar = document.getElementById('sidebar');
  const overlay = document.getElementById('sidebarOverlay');
  sidebar.classList.toggle('open');
  overlay.classList.toggle('show');
}

function closeSidebar() {
  document.getElementById('sidebar').classList.remove('open');
  document.getElementById('sidebarOverlay').classList.remove('show');
}
