/**
 * departments.js - إدارة الأقسام
 */

function getDeptTable() {
  return document.getElementById('departmentsTable');
}

function createEditButton(row) {
  const ctrl = row.insertCell(3);

  const editBtn = document.createElement('button');
  editBtn.innerHTML = '<i class="fa-solid fa-pen"></i>';
  editBtn.className = 'icon-btn edit-icon';
  editBtn.addEventListener('click', () => {
    if (editBtn.innerHTML.includes('fa-pen')) {
      row.cells[1].innerHTML = `<input type="text" value="${row.cells[1].textContent}">`;
      row.cells[2].innerHTML = `<input type="text" value="${row.cells[2].textContent}">`;
      editBtn.innerHTML = '<i class="fa-solid fa-floppy-disk"></i>';
    } else {
      const newName    = row.cells[1].querySelector('input').value.trim();
      const newFaculty = row.cells[2].querySelector('input').value.trim();
      if (!newName || !newFaculty) { alert('الرجاء إدخال اسم القسم والكلية'); return; }
      row.cells[1].textContent = newName;
      row.cells[2].textContent = newFaculty;
      editBtn.innerHTML = '✏';
      saveDepartments();
    }
  });

  const deleteBtn = document.createElement('button');
  deleteBtn.innerHTML = '<i class="fa-solid fa-trash"></i>';
  deleteBtn.className = 'icon-btn delete-icon';
  deleteBtn.addEventListener('click', () => deleteDepartment(row));

  ctrl.append(editBtn, deleteBtn);
}

function deleteDepartment(row) {
  if (!confirm('هل أنت متأكد من حذف القسم: ' + row.cells[1].textContent + ' ؟')) return;
  row.remove();
  saveDepartments();
}

function addDepartment() {
  const faculty = document.getElementById('facultySelect').value;
  const name    = document.getElementById('departmentName').value.trim();

  if (!faculty || faculty === 'اختر الكلية') { alert('اختر الكلية أولاً'); return; }
  if (!name) { alert('ادخل اسم القسم'); return; }

  const table = getDeptTable();
  const row   = table.insertRow(-1);
  row.insertCell(0).textContent = Date.now();
  row.insertCell(1).textContent = name;
  row.insertCell(2).textContent = faculty;
  createEditButton(row);
  saveDepartments();

  document.getElementById('departmentName').value = '';
  document.getElementById('facultySelect').selectedIndex = 0;
  alert('تمت إضافة القسم بنجاح ✅');
}

function saveDepartments() {
  const table = getDeptTable();
  const data  = [];
  for (let i = 1; i < table.rows.length; i++) {
    data.push({
      id:      table.rows[i].cells[0].textContent,
      name:    table.rows[i].cells[1].textContent,
      faculty: table.rows[i].cells[2].textContent
    });
  }
  localStorage.setItem('departmentsData', JSON.stringify(data));
}

function loadDepartments() {
  const data  = JSON.parse(localStorage.getItem('departmentsData') || '[]');
  const table = getDeptTable();
  while (table.rows.length > 1) table.deleteRow(1);
  data.forEach(d => {
    const row = table.insertRow(-1);
    row.insertCell(0).textContent = d.id;
    row.insertCell(1).textContent = d.name;
    row.insertCell(2).textContent = d.faculty;
    createEditButton(row);
  });
}

document.addEventListener('DOMContentLoaded', loadDepartments);
