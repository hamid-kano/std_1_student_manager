<div id="students" class="page">

  <!-- أدوات البحث والفلتر -->
  <input type="text" id="searchInput" placeholder="ابحث باسم الطالب..."
    style="padding:8px 12px; width:100%; max-width:400px; margin-bottom:15px; border-radius:8px; border:1px solid #ccc;">

  <input type="text" id="idSearchInput" placeholder="ابحث بالرقم الجامعي..."
    style="padding:8px 12px; width:100%; max-width:400px; margin-bottom:15px; border-radius:8px; border:1px solid #ccc;">

  <select id="statusFilter"
    style="padding:8px 12px; width:100%; max-width:200px; margin-bottom:20px; border-radius:8px; border:1px solid #ccc;">
    <option value="all">الكل</option>
    <option value="active">منتظم</option>
    <option value="inactive">موقوف</option>
  </select>

  <select id="departmentFilter"
    style="padding:8px 12px; width:100%; max-width:250px; margin-bottom:20px; border-radius:8px; border:1px solid #ccc;">
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

  <!-- جدول الطلاب -->
  <div class="card">
    <table id="studentsTableAdmin">
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
        <th>بلد/العنوان</th>
        <th>الهاتف</th>
        <th>اسم الأم</th>
        <th>اسم الأب</th>
        <th>تاريخ الإنشاء</th>
        <th>آخر تعديل</th>
        <th>الجنس</th>
      </tr>
    </table>
  </div>

  <!-- إحصائيات -->
  <div class="stats" style="display:flex; gap:30px; margin-right:0;">
    <div class="stat" style="text-align:center;">
      <h2 id="studentCount">0</h2>
      <p>عدد الطلاب الكلي</p>
    </div>
    <div class="stat" style="text-align:center;">
      <h2 id="activeCount">0</h2>
      <p>عدد المنتظمين</p>
    </div>
    <div class="stat" style="text-align:center;">
      <h2 id="inactiveCount">0</h2>
      <p>عدد الموقوفين</p>
    </div>
  </div>

</div>

<!-- Modal تعديل الطالب -->
<div id="editModal" style="display:none; position:fixed; inset:0; background:rgba(0,0,0,0.6); z-index:9999; align-items:center; justify-content:center;">
  <div style="background:white; width:90%; max-width:600px; max-height:85vh; overflow-y:auto; padding:25px; border-radius:16px;">
    <h3 style="margin-bottom:20px;">تعديل بيانات الطالب</h3>
    <input id="editId"         disabled placeholder="الرقم الجامعي">
    <input id="editName"       placeholder="الاسم الكامل">
    <input id="editFaculty"    placeholder="الكلية">
    <input id="editDepartment" placeholder="القسم">
    <input id="editBirthPlace" placeholder="مكان الولادة">
    <input id="editBirthDate"  type="date">
    <input id="editAddress"    placeholder="العنوان">
    <input id="editPhone"      placeholder="رقم الهاتف">
    <input id="editMother"     placeholder="اسم الأم">
    <input id="editFather"     placeholder="اسم الأب">
    <input id="editgender"     placeholder="الجنس">
    <div class="edit-actions" style="display:flex; gap:10px; margin-top:15px;">
      <button type="button" onclick="saveEditStudent()">حفظ</button>
      <button type="button" onclick="closeEditModal()">إلغاء</button>
    </div>
  </div>
</div>
