/**
 * absences.js - إدارة الغيابات
 */

function addAbsence() {
  const name     = document.getElementById('searchName').value.trim();
  const id       = document.getElementById('searchId').value.trim();
  const date     = document.getElementById('absenceDate').value;
  const subject  = document.getElementById('absenceSubject').value.trim();
  const year     = document.getElementById('absenceYear').value;
  const semester = document.getElementById('absenceSemester').value;

  if (!name || !id || !date || !subject) {
    alert('الرجاء إدخال الاسم والرقم والتاريخ والمادة');
    return;
  }

  addAbsenceRow({ name, id, date, subject, year, semester });
  saveAbsences();
}

function addAbsenceRow(a) {
  const table = document.getElementById('absenceTable');
  const row   = table.insertRow();

  row.insertCell(0).textContent = a.name;
  row.insertCell(1).textContent = a.id;
  row.insertCell(2).textContent = a.date;
  row.insertCell(3).textContent = a.subject;
  row.insertCell(4).textContent = a.year;
  row.insertCell(5).textContent = a.semester;

  const editCell = row.insertCell(6);
  const editBtn  = document.createElement('button');
  editBtn.textContent  = '✏️';
  editBtn.style.cssText = 'width:auto;';
  editBtn.onclick = () => editAbsence(row);
  editCell.appendChild(editBtn);

  const delCell = row.insertCell(7);
  const delBtn  = document.createElement('button');
  delBtn.textContent  = '🗑️';
  delBtn.style.cssText = 'width:auto;';
  delBtn.onclick = () => {
    if (confirm('هل تريد حذف هذا الغياب؟')) { row.remove(); saveAbsences(); }
  };
  delCell.appendChild(delBtn);
}

function editAbsence(row) {
  const name     = row.cells[0].textContent;
  const id       = row.cells[1].textContent;
  const date     = row.cells[2].textContent;
  const subject  = row.cells[3].textContent;
  const year     = row.cells[4].textContent;
  const semester = row.cells[5].textContent;

  row.cells[0].innerHTML = `<input value="${name}">`;
  row.cells[1].innerHTML = `<input value="${id}">`;
  row.cells[2].innerHTML = `<input type="date" value="${date}">`;
  row.cells[3].innerHTML = `<input value="${subject}">`;
  row.cells[4].innerHTML = `<select>
    <option ${year==='1'?'selected':''}>1</option>
    <option ${year==='2'?'selected':''}>2</option>
    <option ${year==='3'?'selected':''}>3</option>
    <option ${year==='4'?'selected':''}>4</option>
  </select>`;
  row.cells[5].innerHTML = `<select>
    <option ${semester==='أول'?'selected':''}>أول</option>
    <option ${semester==='ثاني'?'selected':''}>ثاني</option>
  </select>`;

  const editBtn = row.cells[6].querySelector('button');
  editBtn.textContent = '💾';
  editBtn.onclick = () => {
    row.cells[0].textContent = row.cells[0].querySelector('input').value;
    row.cells[1].textContent = row.cells[1].querySelector('input').value;
    row.cells[2].textContent = row.cells[2].querySelector('input').value;
    row.cells[3].textContent = row.cells[3].querySelector('input').value;
    row.cells[4].textContent = row.cells[4].querySelector('select').value;
    row.cells[5].textContent = row.cells[5].querySelector('select').value;
    editBtn.textContent = '✏️';
    editBtn.onclick = () => editAbsence(row);
    saveAbsences();
  };
}

function saveAbsences() {
  const table = document.getElementById('absenceTable');
  const data  = [];
  for (let i = 0; i < table.rows.length; i++) {
    const r = table.rows[i];
    data.push({
      name:     r.cells[0].textContent,
      id:       r.cells[1].textContent,
      date:     r.cells[2].textContent,
      subject:  r.cells[3].textContent,
      year:     r.cells[4].textContent,
      semester: r.cells[5].textContent
    });
  }
  localStorage.setItem('absencesData', JSON.stringify(data));
}

function loadAbsences() {
  const data = JSON.parse(localStorage.getItem('absencesData') || '[]');
  data.forEach(a => addAbsenceRow(a));
}

// ===== ربط الأحداث =====
document.addEventListener('DOMContentLoaded', () => {
  loadAbsences();

  // بحث سريع
  document.getElementById('absenceSearch')?.addEventListener('input', function () {
    const val   = this.value.toLowerCase().trim();
    const table = document.getElementById('absenceTable');
    for (let i = 0; i < table.rows.length; i++) {
      const name = table.rows[i].cells[0].textContent.toLowerCase();
      const id   = table.rows[i].cells[1].textContent.toLowerCase();
      table.rows[i].style.display = (name.includes(val) || id.includes(val)) ? '' : 'none';
    }
  });
});
