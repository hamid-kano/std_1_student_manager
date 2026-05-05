/**
 * faculties.js - إدارة الكليات
 */

function editFaculty(btn) {
  const row = btn.closest('tr');

  if (btn.dataset.mode === 'edit') {
    row.cells[0].textContent = row.cells[0].querySelector('input').value;
    row.cells[1].textContent = row.cells[1].querySelector('input').value;
    btn.innerHTML     = '✏️';
    btn.dataset.mode  = 'view';
    saveFaculties();
    return;
  }

  row.cells[0].innerHTML = `<input value="${row.cells[0].textContent}" style="width:100%">`;
  row.cells[1].innerHTML = `<input value="${row.cells[1].textContent}" style="width:100%">`;
  btn.innerHTML    = '💾';
  btn.dataset.mode = 'edit';
}

function saveFaculties() {
  const table = document.getElementById('facultiesTable');
  const data  = [];
  for (let i = 1; i < table.rows.length; i++) {
    data.push({
      name: table.rows[i].cells[0].textContent,
      dean: table.rows[i].cells[1].textContent
    });
  }
  localStorage.setItem('facultiesData', JSON.stringify(data));
}

function loadFaculties() {
  const data = JSON.parse(localStorage.getItem('facultiesData') || '[]');
  if (!data.length) return;

  const table = document.getElementById('facultiesTable');
  while (table.rows.length > 1) table.deleteRow(1);

  data.forEach(f => {
    const row = table.insertRow(-1);
    row.insertCell(0).textContent = f.name;
    row.insertCell(1).textContent = f.dean;
    row.insertCell(2).innerHTML   = `<button class="edit-btn" onclick="editFaculty(this)"><i class="fa-solid fa-pen"></i></button>`;
  });
}

document.addEventListener('DOMContentLoaded', loadFaculties);
