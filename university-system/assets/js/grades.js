/**
 * grades.js - إدارة العلامات
 */

const studentsTables = () => document.getElementById('studentsTables');

// ===== إنشاء / جلب جدول الطالب =====
function createOrGetStudentTable(grade) {
  const container = studentsTables();
  let div = container.querySelector(`div[data-student='${grade.studentId}']`);

  if (!div) {
    div = document.createElement('div');
    div.className = 'student-grades';
    div.setAttribute('data-student',    grade.studentId);
    div.dataset.department = grade.department;
    div.dataset.year       = grade.year;
    div.dataset.semester   = grade.semester;
    div.style.marginBottom = '40px';

    // عنوان الطالب
    const title = document.createElement('h3');
    title.textContent = `${grade.studentName} (${grade.studentId}) - القسم: ${grade.department} - سنة ${grade.year} فصل ${grade.semester}`;

    // زر طباعة
    const printBtn = document.createElement('button');
    printBtn.textContent  = '🖨️ طباعة الطالب';
    printBtn.style.cssText = 'width:auto; padding:5px 10px; margin-right:10px;';
    printBtn.onclick = () => printSingleStudent(grade.studentId);
    title.appendChild(printBtn);

    // زر حذف الجدول
    const delTableBtn = document.createElement('button');
    delTableBtn.textContent  = '🗑️ حذف جدول الطالب';
    delTableBtn.style.cssText = 'width:auto; padding:5px 10px;';
    delTableBtn.onclick = () => {
      if (confirm(`هل تريد حذف جميع العلامات للطالب ${grade.studentName}?`)) {
        div.remove();
        saveGrades();
      }
    };
    title.appendChild(delTableBtn);
    div.appendChild(title);

    // جدول المواد
    const table = document.createElement('table');
    table.style.cssText = 'width:100%; border-collapse:collapse; margin-bottom:10px;';
    table.innerHTML = `<tr><th>المادة</th><th>العلامة</th><th>تحكم</th></tr>`;
    div.appendChild(table);

    // المعدل
    const avg = document.createElement('div');
    avg.className = 'studentAverage';
    div.appendChild(avg);

    container.appendChild(div);
  }
  return div;
}

// ===== إضافة صف علامة =====
function createGradeRow(grade) {
  const div   = createOrGetStudentTable(grade);
  const table = div.querySelector('table');
  const row   = table.insertRow(-1);

  row.insertCell(0).textContent = grade.subject;
  row.insertCell(1).textContent = grade.grade;

  const ctrl    = row.insertCell(2);
  const editBtn = document.createElement('button');
  editBtn.textContent  = '✏️';
  editBtn.style.cssText = 'background:white; width:32px; height:32px;';
  editBtn.onclick = () => openEditGrade(row, grade.studentId);

  const delBtn = document.createElement('button');
  delBtn.textContent  = '🗑️';
  delBtn.style.cssText = 'background:white; width:32px; height:32px;';
  delBtn.onclick = () => {
    if (confirm('هل تريد حذف العلامة؟')) {
      row.remove();
      saveGrades();
      updateStudentAverage(grade.studentId);
    }
  };

  ctrl.append(editBtn, delBtn);
  updateStudentAverage(grade.studentId);
}

// ===== تعديل علامة =====
function openEditGrade(row, studentId) {
  const gradeCell = row.cells[1];
  const oldGrade  = gradeCell.textContent;
  gradeCell.innerHTML = `<input type="number" value="${oldGrade}" min="0" max="100" style="width:60px">`;

  const editBtn = row.cells[2].querySelector('button:first-child');
  editBtn.textContent = '💾';
  editBtn.onclick = () => {
    gradeCell.textContent = gradeCell.querySelector('input').value;
    editBtn.textContent   = '✏️';
    editBtn.onclick       = () => openEditGrade(row, studentId);
    saveGrades();
    updateStudentAverage(studentId);
  };
}

// ===== تحديث المعدل =====
function updateStudentAverage(studentId) {
  const div = studentsTables().querySelector(`div[data-student='${studentId}']`);
  if (!div) return;
  const table = div.querySelector('table');
  let sum = 0, count = 0;
  for (let i = 1; i < table.rows.length; i++) {
    sum += parseFloat(table.rows[i].cells[1].textContent);
    count++;
  }
  div.querySelector('.studentAverage').textContent =
    `معدل الطالب: ${count > 0 ? (sum / count).toFixed(2) : 0}`;
}

// ===== فلتر القسم =====
function filterByDepartment() {
  const selected = document.getElementById('departmentFilters').value;
  document.querySelectorAll('.student-grades').forEach(div => {
    div.style.display = (selected === 'all' || div.dataset.department === selected) ? 'block' : 'none';
  });
}

// ===== بحث =====
function filterGrades() {
  const nameVal = document.getElementById('gradesSearchName').value.toLowerCase();
  const idVal   = document.getElementById('gradesSearchId').value.toLowerCase();
  studentsTables().querySelectorAll('div[data-student]').forEach(div => {
    const title = div.querySelector('h3').textContent.toLowerCase();
    const id    = div.getAttribute('data-student').toLowerCase();
    div.style.display = (title.includes(nameVal) && id.includes(idVal)) ? '' : 'none';
  });
}

// ===== طباعة =====
function printAllStudents() {
  const content = studentsTables()?.innerHTML?.trim();
  if (!content) { alert('لا يوجد طلاب لطباعتهم'); return; }
  openPrintWindow('تقرير علامات جميع الطلاب', content);
}

function printSingleStudent(studentId) {
  const div = studentsTables().querySelector(`div[data-student='${studentId}']`);
  if (!div) { alert('لا يوجد بيانات لهذا الطالب'); return; }
  openPrintWindow('تقرير علامات الطالب', div.innerHTML);
}

function printFiltered() {
  const selected = document.getElementById('departmentFilters').value;
  let content = '';
  document.querySelectorAll('.student-grades').forEach(div => {
    if (selected === 'all' || div.dataset.department === selected) {
      content += div.outerHTML + '<hr>';
    }
  });
  if (!content) { alert('لا يوجد طلاب في هذا القسم'); return; }
  openPrintWindow(`علامات قسم: ${selected}`, content);
}

function openPrintWindow(title, content) {
  const win = window.open('', '', 'width=1000,height=800');
  win.document.write(`
    <html><head><title>${title}</title>
    <style>
      body{font-family:Arial;direction:rtl;padding:20px;}
      table{width:100%;border-collapse:collapse;margin-bottom:25px;}
      th,td{border:1px solid #000;padding:8px;text-align:center;}
      button{display:none!important;}
    </style></head>
    <body><h2>${title}</h2>${content}</body></html>`);
  win.document.close();
  win.focus();
  win.print();
}

// ===== localStorage =====
function saveGrades() {
  const data = [];
  studentsTables().querySelectorAll('div[data-student]').forEach(div => {
    const studentId = div.getAttribute('data-student');
    const name      = div.querySelector('h3').textContent.split(' (')[0];
    const table     = div.querySelector('table');
    for (let i = 1; i < table.rows.length; i++) {
      data.push({
        studentId,
        studentName: name,
        department:  div.dataset.department,
        year:        div.dataset.year,
        semester:    div.dataset.semester,
        subject:     table.rows[i].cells[0].textContent,
        grade:       table.rows[i].cells[1].textContent
      });
    }
  });
  localStorage.setItem('gradesData', JSON.stringify(data));
}

function loadGrades() {
  const data = JSON.parse(localStorage.getItem('gradesData') || '[]');
  data.forEach(g => createGradeRow(g));
}

// ===== ربط الأحداث =====
document.addEventListener('DOMContentLoaded', () => {
  loadGrades();

  document.getElementById('addGradeForm')?.addEventListener('submit', function (e) {
    e.preventDefault();
    const grade = {
      studentId:   document.getElementById('studentId').value.trim(),
      studentName: document.getElementById('studentName').value.trim(),
      department:  document.getElementById('studentDepartment').value,
      year:        document.getElementById('year').value,
      semester:    document.getElementById('semester').value,
      subject:     document.getElementById('subject').value.trim(),
      grade:       document.getElementById('grade').value
    };
    createGradeRow(grade);
    saveGrades();
    this.reset();
  });

  document.getElementById('gradesSearchName')?.addEventListener('keyup', filterGrades);
  document.getElementById('gradesSearchId')?.addEventListener('keyup',   filterGrades);
});
