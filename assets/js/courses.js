/**
 * courses.js - إدارة المقررات
 */

function getCoursesSystem() {
  return JSON.parse(localStorage.getItem('coursesSystem') || '{}');
}

function saveCoursesSystem(data) {
  localStorage.setItem('coursesSystem', JSON.stringify(data));
}

function addCourseSystem() {
  const dept = document.getElementById('courseDept').value;
  const year = document.getElementById('courseYear').value;
  const sem  = document.getElementById('courseSemester').value;
  const name = document.getElementById('courseName').value.trim();

  if (!dept || !year || !sem || !name) { alert('أدخل جميع البيانات'); return; }

  const data = getCoursesSystem();
  if (!data[dept])       data[dept]       = {};
  if (!data[dept][year]) data[dept][year] = {};
  if (!data[dept][year][sem]) data[dept][year][sem] = [];

  data[dept][year][sem].push(name);
  saveCoursesSystem(data);
  renderCoursesSystem();

  document.getElementById('courseName').value = '';
  document.getElementById('courseDept').selectedIndex = 0;
  document.getElementById('courseYear').selectedIndex = 0;
  document.getElementById('courseSemester').selectedIndex = 0;
  alert('تمت إضافة المادة ✅');
}

function deleteDepartmentCourses(dept) {
  if (!confirm('هل تريد حذف القسم وكل مقرراته؟')) return;
  const data = getCoursesSystem();
  delete data[dept];
  saveCoursesSystem(data);
  renderCoursesSystem();
}

function editCourse(dept, year, sem, index) {
  const data    = getCoursesSystem();
  const newName = prompt('تعديل اسم المادة:', data[dept][year][sem][index]);
  if (!newName) return;
  data[dept][year][sem][index] = newName.trim();
  saveCoursesSystem(data);
  renderCoursesSystem();
}

function deleteCourse(dept, year, sem, index) {
  if (!confirm('هل تريد حذف هذه المادة؟')) return;
  const data = getCoursesSystem();
  data[dept][year][sem].splice(index, 1);
  saveCoursesSystem(data);
  renderCoursesSystem();
}

function renderCoursesSystem() {
  const container = document.getElementById('coursesContainer');
  if (!container) return;
  container.innerHTML = '';

  const data = getCoursesSystem();

  for (const dept in data) {
    const deptCard = document.createElement('div');
    deptCard.className = 'course-dept-card';

    const delBtn = document.createElement('button');
    delBtn.innerHTML      = '<i class="fa-solid fa-trash"></i> حذف القسم';
    delBtn.style.cssText  = 'float:left; margin-bottom:10px; width:auto; padding:6px 12px;';
    delBtn.onclick        = () => deleteDepartmentCourses(dept);
    deptCard.appendChild(delBtn);

    const title = document.createElement('h2');
    title.textContent = dept;
    deptCard.appendChild(title);

    for (const year in data[dept]) {
      const yearBlock = document.createElement('div');
      yearBlock.className   = 'course-year';
      yearBlock.innerHTML   = `<h3>${year}</h3>`;

      for (const sem in data[dept][year]) {
        const semBlock = document.createElement('div');
        semBlock.className = 'course-semester';
        semBlock.innerHTML = `<strong>${sem}</strong>`;

        const ul = document.createElement('ul');
        data[dept][year][sem].forEach((course, index) => {
          const li = document.createElement('li');
          li.style.cssText = 'display:flex; justify-content:space-between; align-items:center;';
          li.innerHTML = `
            <span>${course}</span>
            <span>
              <button class="edit-btn"   onclick="editCourse('${dept}','${year}','${sem}',${index})"><i class="fa-solid fa-pen"></i></button>
              <button class="delete-btn" onclick="deleteCourse('${dept}','${year}','${sem}',${index})"><i class="fa-solid fa-trash"></i></button>
            </span>`;
          ul.appendChild(li);
        });

        semBlock.appendChild(ul);
        yearBlock.appendChild(semBlock);
      }
      deptCard.appendChild(yearBlock);
    }
    container.appendChild(deptCard);
  }
}

document.addEventListener('DOMContentLoaded', renderCoursesSystem);
