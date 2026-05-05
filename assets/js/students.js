/**
 * students.js - إدارة الطلاب
 */

// ===== إنشاء صف الطالب =====
function createStudentRow(s) {
  const table = document.getElementById('studentsTableAdmin');
  const row   = table.insertRow(-1);

  row.insertCell(0).innerHTML = s.image
    ? `<img src="${s.image}" style="width:40px;height:40px;border-radius:50%">`
    : '—';

  row.insertCell(1).textContent = s.id;

  // أزرار التحكم
  const ctrl = row.insertCell(2);

  const statusBtn = document.createElement('button');
  statusBtn.textContent = s.status === 'inactive' ? 'موقوف' : 'منتظم';
  statusBtn.className   = 'btn ' + (s.status === 'inactive' ? 'inactive-btn' : 'active-btn');
  statusBtn.style.width = 'auto';
  statusBtn.onclick     = () => toggleStatus(statusBtn);

  const editBtn = document.createElement('button');
  editBtn.innerHTML = '✏️';
  editBtn.className = 'edit-btn';
  editBtn.onclick   = () => openEditStudent(row);

  const deleteBtn = document.createElement('button');
  deleteBtn.innerHTML = '🗑️';
  deleteBtn.className = 'delete-btn';
  deleteBtn.onclick   = () => deleteStudent(row);

  ctrl.append(statusBtn, editBtn, deleteBtn);

  // الحالة
  const statusCell = row.insertCell(3);
  statusCell.textContent = s.status === 'inactive' ? 'موقوف' : 'منتظم';
  statusCell.className   = 'status ' + (s.status === 'inactive' ? 'inactive' : 'active');

  row.insertCell(4).textContent  = s.name;
  row.insertCell(5).textContent  = s.faculty;
  row.insertCell(6).textContent  = s.department;
  row.insertCell(7).textContent  = s.birthPlace;
  row.insertCell(8).textContent  = s.birthDate;
  row.insertCell(9).textContent  = s.address;
  row.insertCell(10).textContent = s.phone;
  row.insertCell(11).textContent = s.mother;
  row.insertCell(12).textContent = s.father;
  row.insertCell(13).textContent = s.createdAt;
  row.insertCell(14).textContent = s.updatedAt;
  row.insertCell(15).textContent = s.gender || '-';
}

// ===== تسجيل طالب من نموذج التسجيل =====
function addStudentFromRegister() {
  const form   = document.getElementById('form');
  const inputs = form.querySelectorAll('input, select');
  const imageFile = inputs[0].files[0];

  const student = {
    image:      '',
    id:         inputs[1].value.trim(),
    name:       inputs[2].value.trim(),
    faculty:    inputs[3].value,
    department: inputs[4].value,
    birthPlace: inputs[5].value,
    birthDate:  inputs[6].value,
    address:    inputs[7].value,
    phone:      inputs[8].value,
    mother:     inputs[9].value,
    father:     inputs[10].value,
    gender:     inputs[11].value,
    status:     'active',
    createdAt:  getNowDate(),
    updatedAt:  '-'
  };

  if (!student.id || !student.name) {
    alert('الرجاء إدخال الرقم الجامعي والاسم');
    return;
  }

  const finish = () => {
    createStudentRow(student);
    saveStudents();
    updateStudentCount();
    form.reset();
    alert('تم تسجيل الطالب بنجاح ✅');
  };

  if (imageFile) {
    const reader = new FileReader();
    reader.onload = e => { student.image = e.target.result; finish(); };
    reader.readAsDataURL(imageFile);
  } else {
    finish();
  }
}

// ===== تغيير الحالة =====
function toggleStatus(btn) {
  const row        = btn.closest('tr');
  const statusCell = row.cells[3];

  if (statusCell.classList.contains('active')) {
    statusCell.className   = 'status inactive';
    statusCell.textContent = 'موقوف';
    btn.className          = 'btn inactive-btn';
    btn.textContent        = 'موقوف';
  } else {
    statusCell.className   = 'status active';
    statusCell.textContent = 'منتظم';
    btn.className          = 'btn active-btn';
    btn.textContent        = 'منتظم';
  }

  row.cells[14].textContent = getNowDate();
  saveStudents();
  updateStudentCount();
}

// ===== حذف طالب =====
function deleteStudent(row) {
  if (!confirm('هل أنت متأكد من حذف هذا الطالب؟')) return;
  row.remove();
  saveStudents();
  updateStudentCount();
}

// ===== Modal التعديل =====
let currentEditRow = null;

function openEditStudent(row) {
  currentEditRow = row;
  document.getElementById('editId').value         = row.cells[1].textContent;
  document.getElementById('editName').value       = row.cells[4].textContent;
  document.getElementById('editFaculty').value    = row.cells[5].textContent;
  document.getElementById('editDepartment').value = row.cells[6].textContent;
  document.getElementById('editBirthPlace').value = row.cells[7].textContent;
  document.getElementById('editBirthDate').value  = row.cells[8].textContent;
  document.getElementById('editAddress').value    = row.cells[9].textContent;
  document.getElementById('editPhone').value      = row.cells[10].textContent;
  document.getElementById('editMother').value     = row.cells[11].textContent;
  document.getElementById('editFather').value     = row.cells[12].textContent;
  document.getElementById('editgender').value     = row.cells[15].textContent;

  const modal = document.getElementById('editModal');
  modal.style.display     = 'flex';
}

function closeEditModal() {
  document.getElementById('editModal').style.display = 'none';
  currentEditRow = null;
}

function saveEditStudent() {
  if (!currentEditRow) return;
  currentEditRow.cells[4].textContent  = document.getElementById('editName').value;
  currentEditRow.cells[5].textContent  = document.getElementById('editFaculty').value;
  currentEditRow.cells[6].textContent  = document.getElementById('editDepartment').value;
  currentEditRow.cells[7].textContent  = document.getElementById('editBirthPlace').value;
  currentEditRow.cells[8].textContent  = document.getElementById('editBirthDate').value;
  currentEditRow.cells[9].textContent  = document.getElementById('editAddress').value;
  currentEditRow.cells[10].textContent = document.getElementById('editPhone').value;
  currentEditRow.cells[11].textContent = document.getElementById('editMother').value;
  currentEditRow.cells[12].textContent = document.getElementById('editFather').value;
  currentEditRow.cells[14].textContent = getNowDate();
  saveStudents();
  updateStudentCount();
  closeEditModal();
}

// ===== البحث الموحد =====
function unifiedSearchWithDepartment() {
  const nameVal   = document.getElementById('searchInput').value.toLowerCase();
  const idVal     = document.getElementById('idSearchInput').value.toLowerCase();
  const statusVal = document.getElementById('statusFilter').value;
  const deptVal   = document.getElementById('departmentFilter').value;
  const table     = document.getElementById('studentsTableAdmin');
  if (!table) return;

  for (let i = 1; i < table.rows.length; i++) {
    const row        = table.rows[i];
    const matchId    = row.cells[1].textContent.toLowerCase().includes(idVal);
    const matchName  = row.cells[4].textContent.toLowerCase().includes(nameVal);
    const matchDept  = deptVal === 'all' || row.cells[6].textContent === deptVal;
    const matchStatus =
      statusVal === 'all' ||
      (statusVal === 'active'   && row.cells[3].classList.contains('active')) ||
      (statusVal === 'inactive' && row.cells[3].classList.contains('inactive'));

    row.style.display = (matchId && matchName && matchDept && matchStatus) ? '' : 'none';
  }
  updateStudentCount();
}

// ===== عدادات =====
function updateStudentCount() {
  const table = document.getElementById('studentsTableAdmin');
  if (!table) return;
  let total = 0, active = 0, inactive = 0;

  for (let i = 1; i < table.rows.length; i++) {
    const row = table.rows[i];
    if (row.style.display === 'none') continue;
    total++;
    if (row.cells[3].classList.contains('active'))   active++;
    if (row.cells[3].classList.contains('inactive')) inactive++;
  }

  document.getElementById('studentCount').textContent  = total;
  document.getElementById('activeCount').textContent   = active;
  document.getElementById('inactiveCount').textContent = inactive;
}

// ===== localStorage =====
function saveStudents() {
  const table = document.getElementById('studentsTableAdmin');
  if (!table) return;
  const students = [];

  for (let i = 1; i < table.rows.length; i++) {
    const r = table.rows[i];
    students.push({
      image:      r.cells[0].querySelector('img')?.src || '',
      id:         r.cells[1].textContent,
      status:     r.cells[3].classList.contains('active') ? 'active' : 'inactive',
      name:       r.cells[4].textContent,
      faculty:    r.cells[5].textContent,
      department: r.cells[6].textContent,
      birthPlace: r.cells[7].textContent,
      birthDate:  r.cells[8].textContent,
      address:    r.cells[9].textContent,
      phone:      r.cells[10].textContent,
      mother:     r.cells[11].textContent,
      father:     r.cells[12].textContent,
      createdAt:  r.cells[13].textContent,
      updatedAt:  r.cells[14].textContent,
      gender:     r.cells[15].textContent,
    });
  }
  localStorage.setItem('studentsData', JSON.stringify(students));
}

function loadStudents() {
  const data  = JSON.parse(localStorage.getItem('studentsData') || '[]');
  const table = document.getElementById('studentsTableAdmin');
  while (table.rows.length > 1) table.deleteRow(1);
  data.forEach(s => createStudentRow(s));
  updateStudentCount();
}

// ===== ربط الأحداث =====
document.addEventListener('DOMContentLoaded', () => {
  loadStudents();

  document.getElementById('searchInput')?.addEventListener('keyup',    unifiedSearchWithDepartment);
  document.getElementById('idSearchInput')?.addEventListener('keyup',  unifiedSearchWithDepartment);
  document.getElementById('statusFilter')?.addEventListener('change',  unifiedSearchWithDepartment);
  document.getElementById('departmentFilter')?.addEventListener('change', unifiedSearchWithDepartment);
});
