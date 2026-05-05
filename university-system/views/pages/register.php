<div id="register" class="page">
  <form id="form">
    <input type="file" accept="image/*">
    <input placeholder="الرقم الجامعي" required>
    <input placeholder="الاسم الكامل" required>
    <select required>
      <option disabled selected>اختر الكلية</option>
      <option>كلية العلوم الطبيعية والتكنولوجيا</option>
      <option>كلية الهندسة</option>
      <option>كلية العلوم</option>
    </select>
    <select required>
      <option disabled selected>اختر القسم</option>
      <option>هندسة الحاسوب</option>
      <option>هندسة اتصالات</option>
      <option>هندسة ميكاترونيك</option>
      <option>بيوكيمياء</option>
      <option>رياضيات</option>
      <option>كيمياء</option>
      <option>فيزياء</option>
      <option>بيولوجيا</option>
    </select>
    <input placeholder="مكان الولادة">
    <input type="date">
    <input placeholder="بلد/العنوان">
    <input placeholder="رقم الهاتف">
    <input placeholder="اسم الأم">
    <input placeholder="اسم الأب">
    <select id="editGender">
      <option value="ذكر">ذكر</option>
      <option value="أنثى">أنثى</option>
    </select>
    <button type="button" onclick="addStudentFromRegister()">تسجيل الطالب</button>
  </form>
</div>
