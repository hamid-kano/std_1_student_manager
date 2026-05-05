<div id="students" class="page">

  <div class="page-header">
    <h1><i class="fa-solid fa-user-graduate"></i> الطلاب</h1>
    <p>إدارة بيانات الطلاب المسجلين</p>
  </div>

  <!-- فلاتر البحث -->
  <div class="filters-bar">
    <input type="text" id="searchInput" placeholder="ابحث بالاسم...">
    <input type="text" id="idSearchInput" placeholder="ابحث بالرقم الجامعي...">
    <select id="statusFilter">
      <option value="all">كل الحالات</option>
      <option value="active">منتظم</option>
      <option value="inactive">موقوف</option>
    </select>
    <select id="departmentFilter">
      <option value="all">كل الأقسام</option>
      <option value="هندسة الحاسوب">هندسة الحاسوب</option>
      <option value="هندسة اتصالات">هندسة اتصالات</option>
      <option value="هندسة ميكاترونيك">هندسة ميكاترونيك</option>
      <option value="رياضيات">رياضيات</option>
      <option value="فيزياء">فيزياء</option>
      <option value="كيمياء">كيمياء</option>
      <option value="بيولوجيا">بيولوجيا</option>
      <option value="بيوكيمياء">بيوكيمياء</option>
    </select>
  </div>

  <!-- جدول الطلاب -->
  <div class="card">
    <div class="table-wrapper">
      <table id="studentsTableAdmin">
        <thead>
          <tr>
            <th>الصورة</th>
            <th>الرقم الجامعي</th>
            <th>تحكم</th>
            <th>الحالة</th>
            <th>الاسم</th>
            <th>الكلية</th>
            <th>القسم</th>
            <th>مكان الولادة</th>
            <th>تاريخ الميلاد</th>
            <th>العنوان</th>
            <th>الهاتف</th>
            <th>اسم الأم</th>
            <th>اسم الأب</th>
            <th>تاريخ الإنشاء</th>
            <th>آخر تعديل</th>
            <th>الجنس</th>
          </tr>
        </thead>
        <tbody></tbody>
      </table>
    </div>
  </div>

  <!-- إحصائيات -->
  <div class="stats">
    <div class="stat">
      <h2 id="studentCount">0</h2>
      <p>إجمالي الطلاب</p>
    </div>
    <div class="stat" style="border-top-color:#16a34a;">
      <h2 id="activeCount" style="color:#16a34a;">0</h2>
      <p>المنتظمون</p>
    </div>
    <div class="stat" style="border-top-color:#dc2626;">
      <h2 id="inactiveCount" style="color:#dc2626;">0</h2>
      <p>الموقوفون</p>
    </div>
  </div>

</div>

<!-- Modal تعديل الطالب -->
<div id="editModal">
  <div class="modal-box">
    <h3><i class="fa-solid fa-pen-to-square"></i> تعديل بيانات الطالب</h3>
    <div class="form-grid">
      <div class="form-group full">
        <label>الرقم الجامعي</label>
        <input id="editId" disabled>
      </div>
      <div class="form-group">
        <label>الاسم الكامل</label>
        <input id="editName" placeholder="الاسم الكامل">
      </div>
      <div class="form-group">
        <label>الجنس</label>
        <select id="editgender">
          <option value="ذكر">ذكر</option>
          <option value="أنثى">أنثى</option>
        </select>
      </div>
      <div class="form-group">
        <label>الكلية</label>
        <input id="editFaculty" placeholder="الكلية">
      </div>
      <div class="form-group">
        <label>القسم</label>
        <input id="editDepartment" placeholder="القسم">
      </div>
      <div class="form-group">
        <label>مكان الولادة</label>
        <input id="editBirthPlace" placeholder="مكان الولادة">
      </div>
      <div class="form-group">
        <label>تاريخ الميلاد</label>
        <input id="editBirthDate" type="date">
      </div>
      <div class="form-group">
        <label>العنوان</label>
        <input id="editAddress" placeholder="العنوان">
      </div>
      <div class="form-group">
        <label>رقم الهاتف</label>
        <input id="editPhone" placeholder="رقم الهاتف">
      </div>
      <div class="form-group">
        <label>اسم الأم</label>
        <input id="editMother" placeholder="اسم الأم">
      </div>
      <div class="form-group">
        <label>اسم الأب</label>
        <input id="editFather" placeholder="اسم الأب">
      </div>
    </div>
    <div class="modal-actions">
      <button class="btn-save"   onclick="saveEditStudent()"><i class="fa-solid fa-floppy-disk"></i> حفظ</button>
      <button class="btn-cancel" onclick="closeEditModal()">إلغاء</button>
    </div>
  </div>
</div>
