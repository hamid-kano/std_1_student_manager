/**
 * staff.js - إدارة المدرسين
 */

function addStaff() {
  const name = document.getElementById('staffName').value.trim();
  const uni  = document.getElementById('staffUniversity').value.trim();
  const exp  = document.getElementById('staffExperience').value.trim();

  if (!name || !uni || !exp) { alert('الرجاء إدخال جميع البيانات'); return; }

  createStaffRow({ name, uni, exp });
  saveStaff();

  document.getElementById('staffName').value       = '';
  document.getElementById('staffUniversity').value = '';
  document.getElementById('staffExperience').value = '';
}

function createStaffRow(s) {
  const table = document.getElementById('staffTable');
  const row   = table.insertRow(-1);

  row.insertCell(0).textContent = s.name;
  row.insertCell(1).textContent = s.uni;
  row.insertCell(2).textContent = s.exp;

  const ctrl    = row.insertCell(3);
  const editBtn = document.createElement('button');
  editBtn.innerHTML = '<i class="fa-solid fa-pen"></i>';
  editBtn.className = 'edit-btn';
  editBtn.onclick   = () => editStaff(editBtn);

  const delBtn = document.createElement('button');
  delBtn.innerHTML = '<i class="fa-solid fa-trash"></i>';
  delBtn.className = 'delete-btn';
  delBtn.onclick   = () => { if (confirm('حذف المدرس؟')) { row.remove(); saveStaff(); } };

  ctrl.append(editBtn, delBtn);
}

function editStaff(btn) {
  const row = btn.closest('tr');

  if (btn.dataset.mode === 'edit') {
    for (let i = 0; i < 3; i++) {
      row.cells[i].textContent = row.cells[i].querySelector('input').value;
    }
    btn.innerHTML    = '✏️';
    btn.dataset.mode = 'view';
    saveStaff();
    return;
  }

  for (let i = 0; i < 3; i++) {
    row.cells[i].innerHTML = `<input value="${row.cells[i].textContent}" style="width:100%">`;
  }
  btn.innerHTML    = '💾';
  btn.dataset.mode = 'edit';
}

function saveStaff() {
  const table = document.getElementById('staffTable');
  const data  = [];
  for (let i = 1; i < table.rows.length; i++) {
    data.push({
      name: table.rows[i].cells[0].textContent,
      uni:  table.rows[i].cells[1].textContent,
      exp:  table.rows[i].cells[2].textContent
    });
  }
  localStorage.setItem('staffData', JSON.stringify(data));
}

function loadStaff() {
  const data = JSON.parse(localStorage.getItem('staffData') || '[]');
  data.forEach(s => createStaffRow(s));
}

document.addEventListener('DOMContentLoaded', loadStaff);
