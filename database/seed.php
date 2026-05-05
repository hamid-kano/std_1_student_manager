<?php
/**
 * Seeder - بيانات تجريبية شاملة
 * http://localhost/std_1_student_manager/database/seed.php
 */
require_once __DIR__ . '/../app/bootstrap.php';

$db = Database::getInstance();

// ===== تنظيف البيانات القديمة (بالترتيب بسبب FK) =====
$db->exec("DELETE FROM absences");
$db->exec("DELETE FROM grades");
$db->exec("DELETE FROM students");
$db->exec("DELETE FROM courses");
$db->exec("DELETE FROM departments");
$db->exec("DELETE FROM faculties");
$db->exec("DELETE FROM staff");

// إعادة تعيين الـ auto increment
foreach (['absences','grades','students','courses','departments','faculties','staff'] as $t) {
    $db->exec("DELETE FROM sqlite_sequence WHERE name='$t'");
}

echo '<div style="font-family:Cairo,Arial;direction:rtl;padding:30px;max-width:800px;margin:auto;">';
echo '<h2>🌱 جاري زرع البيانات...</h2><ul style="line-height:2.2;">';

// =========================================
// 1. الكليات
// =========================================
$faculties = [
    ['name' => 'كلية الهندسة',                    'dean' => 'أ.د. محمد خالد العمر'],
    ['name' => 'كلية العلوم',                      'dean' => 'أ.د. سمير يوسف الحسن'],
    ['name' => 'كلية العلوم الطبيعية والتكنولوجيا','dean' => 'أ.د. ليلى أحمد مصطفى'],
];

$facultyIds = [];
$stmt = $db->prepare("INSERT INTO faculties (name, dean) VALUES (?, ?)");
foreach ($faculties as $f) {
    $stmt->execute([$f['name'], $f['dean']]);
    $facultyIds[$f['name']] = (int)$db->lastInsertId();
}
echo '<li>✅ الكليات: ' . count($faculties) . '</li>';

// =========================================
// 2. الأقسام
// =========================================
$departments = [
    ['name' => 'هندسة الحاسوب',    'faculty' => 'كلية الهندسة'],
    ['name' => 'هندسة اتصالات',    'faculty' => 'كلية الهندسة'],
    ['name' => 'هندسة ميكاترونيك', 'faculty' => 'كلية الهندسة'],
    ['name' => 'رياضيات',          'faculty' => 'كلية العلوم'],
    ['name' => 'فيزياء',           'faculty' => 'كلية العلوم'],
    ['name' => 'كيمياء',           'faculty' => 'كلية العلوم'],
    ['name' => 'بيولوجيا',         'faculty' => 'كلية العلوم الطبيعية والتكنولوجيا'],
    ['name' => 'بيوكيمياء',        'faculty' => 'كلية العلوم الطبيعية والتكنولوجيا'],
];

$deptIds = [];
$stmt = $db->prepare("INSERT INTO departments (name, faculty_id) VALUES (?, ?)");
foreach ($departments as $d) {
    $stmt->execute([$d['name'], $facultyIds[$d['faculty']]]);
    $deptIds[$d['name']] = (int)$db->lastInsertId();
}
echo '<li>✅ الأقسام: ' . count($departments) . '</li>';

// =========================================
// 3. المقررات
// =========================================
$courses = [
    // هندسة الحاسوب
    ['dept'=>'هندسة الحاسوب','year'=>'السنة الأولى', 'sem'=>'الفصل الأول', 'name'=>'مقدمة في البرمجة'],
    ['dept'=>'هندسة الحاسوب','year'=>'السنة الأولى', 'sem'=>'الفصل الأول', 'name'=>'رياضيات هندسية 1'],
    ['dept'=>'هندسة الحاسوب','year'=>'السنة الأولى', 'sem'=>'الفصل الثاني','name'=>'هياكل البيانات'],
    ['dept'=>'هندسة الحاسوب','year'=>'السنة الأولى', 'sem'=>'الفصل الثاني','name'=>'رياضيات هندسية 2'],
    ['dept'=>'هندسة الحاسوب','year'=>'السنة الثانية','sem'=>'الفصل الأول', 'name'=>'قواعد البيانات'],
    ['dept'=>'هندسة الحاسوب','year'=>'السنة الثانية','sem'=>'الفصل الأول', 'name'=>'نظم التشغيل'],
    ['dept'=>'هندسة الحاسوب','year'=>'السنة الثانية','sem'=>'الفصل الثاني','name'=>'شبكات الحاسوب'],
    ['dept'=>'هندسة الحاسوب','year'=>'السنة الثانية','sem'=>'الفصل الثاني','name'=>'برمجة كائنية'],
    ['dept'=>'هندسة الحاسوب','year'=>'السنة الثالثة','sem'=>'الفصل الأول', 'name'=>'الذكاء الاصطناعي'],
    ['dept'=>'هندسة الحاسوب','year'=>'السنة الثالثة','sem'=>'الفصل الثاني','name'=>'أمن المعلومات'],
    ['dept'=>'هندسة الحاسوب','year'=>'السنة الرابعة','sem'=>'الفصل الأول', 'name'=>'مشروع التخرج 1'],
    ['dept'=>'هندسة الحاسوب','year'=>'السنة الرابعة','sem'=>'الفصل الثاني','name'=>'مشروع التخرج 2'],
    // هندسة اتصالات
    ['dept'=>'هندسة اتصالات','year'=>'السنة الأولى', 'sem'=>'الفصل الأول', 'name'=>'مبادئ الاتصالات'],
    ['dept'=>'هندسة اتصالات','year'=>'السنة الأولى', 'sem'=>'الفصل الثاني','name'=>'إلكترونيات 1'],
    ['dept'=>'هندسة اتصالات','year'=>'السنة الثانية','sem'=>'الفصل الأول', 'name'=>'معالجة الإشارات'],
    ['dept'=>'هندسة اتصالات','year'=>'السنة الثانية','sem'=>'الفصل الثاني','name'=>'شبكات لاسلكية'],
    // رياضيات
    ['dept'=>'رياضيات','year'=>'السنة الأولى', 'sem'=>'الفصل الأول', 'name'=>'تفاضل وتكامل 1'],
    ['dept'=>'رياضيات','year'=>'السنة الأولى', 'sem'=>'الفصل الثاني','name'=>'جبر خطي'],
    ['dept'=>'رياضيات','year'=>'السنة الثانية','sem'=>'الفصل الأول', 'name'=>'معادلات تفاضلية'],
    // بيولوجيا
    ['dept'=>'بيولوجيا','year'=>'السنة الأولى', 'sem'=>'الفصل الأول', 'name'=>'أحياء عامة'],
    ['dept'=>'بيولوجيا','year'=>'السنة الأولى', 'sem'=>'الفصل الثاني','name'=>'كيمياء حيوية مقدمة'],
];

$stmt = $db->prepare("INSERT INTO courses (name, department_id, year, semester) VALUES (?, ?, ?, ?)");
foreach ($courses as $c) {
    $stmt->execute([$c['name'], $deptIds[$c['dept']], $c['year'], $c['sem']]);
}
echo '<li>✅ المقررات: ' . count($courses) . '</li>';

// =========================================
// 4. المدرسون
// =========================================
$staff = [
    ['name'=>'د. أحمد محمود السيد',    'university'=>'جامعة دمشق',       'experience'=>'برمجة، قواعد بيانات، 15 سنة خبرة'],
    ['name'=>'د. فاطمة علي الزهراء',   'university'=>'جامعة حلب',        'experience'=>'شبكات، أمن معلومات، 12 سنة خبرة'],
    ['name'=>'م. خالد يوسف النجار',    'university'=>'جامعة تشرين',      'experience'=>'هندسة اتصالات، 8 سنوات خبرة'],
    ['name'=>'د. سارة إبراهيم قاسم',   'university'=>'جامعة البعث',      'experience'=>'رياضيات تطبيقية، 10 سنوات خبرة'],
    ['name'=>'أ. محمد حسن الأحمد',     'university'=>'جامعة دمشق',       'experience'=>'فيزياء، كيمياء، 6 سنوات خبرة'],
    ['name'=>'د. نور الدين عبد الله',  'university'=>'جامعة القاهرة',    'experience'=>'ذكاء اصطناعي، تعلم آلي، 9 سنوات'],
    ['name'=>'م. رنا سليمان الخطيب',   'university'=>'جامعة الإسكندرية', 'experience'=>'بيولوجيا جزيئية، 7 سنوات خبرة'],
    ['name'=>'د. عمر فارس الدباغ',     'university'=>'جامعة حلب',        'experience'=>'ميكاترونيك، روبوتيك، 11 سنة خبرة'],
];

$stmt = $db->prepare("INSERT INTO staff (name, university, experience) VALUES (?, ?, ?)");
foreach ($staff as $s) {
    $stmt->execute([$s['name'], $s['university'], $s['experience']]);
}
echo '<li>✅ المدرسون: ' . count($staff) . '</li>';

// =========================================
// 5. الطلاب
// =========================================
$maleNames = [
    'أحمد محمد السيد','محمد علي حسن','عمر خالد النجار','يوسف إبراهيم قاسم',
    'كريم سامر الأحمد','طارق فارس الدباغ','زياد نور الدين','باسل عبد الله الخطيب',
    'سامر حسين العلي','رامي وليد المصري','فراس جمال الدين','ماهر سليمان الحسن',
    'لؤي أنور الشيخ','نضال ربيع الجمال','حسام الدين عمر','وسيم ناصر الدين',
];
$femaleNames = [
    'سارة أحمد الزهراء','فاطمة علي محمد','نور إبراهيم سليم','ريم خالد العمر',
    'لينا يوسف الحسن','دانا سامر قاسم','هبة الله فارس','رنا محمود الأحمد',
    'مي عبد الله النجار','سلمى وليد الخطيب','غادة حسين العلي','إيمان جمال الدين',
];

$deptList = array_keys($deptIds);
$faculties_list = [
    'هندسة الحاسوب'    => 'كلية الهندسة',
    'هندسة اتصالات'    => 'كلية الهندسة',
    'هندسة ميكاترونيك' => 'كلية الهندسة',
    'رياضيات'          => 'كلية العلوم',
    'فيزياء'           => 'كلية العلوم',
    'كيمياء'           => 'كلية العلوم',
    'بيولوجيا'         => 'كلية العلوم الطبيعية والتكنولوجيا',
    'بيوكيمياء'        => 'كلية العلوم الطبيعية والتكنولوجيا',
];

$cities     = ['دمشق','حلب','حمص','حماة','اللاذقية','طرطوس','دير الزور','الرقة'];
$addresses  = ['دمشق - المزة','حلب - الشهباء','حمص - الوعر','حماة - المريجة',
               'اللاذقية - الزراعة','طرطوس - المدينة','دمشق - كفرسوسة','حلب - العزيزية'];
$statuses   = ['active','active','active','active','active','inactive']; // 5 منتظم لكل موقوف

$stmt = $db->prepare(
    "INSERT INTO students
     (university_id,name,faculty,department,birth_place,birth_date,address,phone,mother_name,father_name,gender,status,created_at,updated_at)
     VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)"
);

$studentIds = [];
$year       = 2024;
$counter    = 1;

// طلاب ذكور
foreach ($maleNames as $i => $name) {
    $dept   = $deptList[$i % count($deptList)];
    $uid    = $year . str_pad($counter++, 4, '0', STR_PAD_LEFT);
    $bYear  = rand(2000, 2005);
    $status = $statuses[$i % count($statuses)];
    $stmt->execute([
        $uid, $name,
        $faculties_list[$dept], $dept,
        $cities[$i % count($cities)],
        "$bYear-" . str_pad(rand(1,12),2,'0',STR_PAD_LEFT) . '-' . str_pad(rand(1,28),2,'0',STR_PAD_LEFT),
        $addresses[$i % count($addresses)],
        '09' . rand(10000000, 99999999),
        'أم ' . explode(' ', $name)[0],
        explode(' ', $name)[1] . ' ' . explode(' ', $name)[2],
        'ذكر', $status,
        date('Y-m-d H:i:s', strtotime("-" . rand(30,365) . " days")),
        date('Y-m-d H:i:s'),
    ]);
    $studentIds[] = ['id' => (int)$db->lastInsertId(), 'dept' => $dept, 'gender' => 'ذكر'];
}

// طالبات إناث
foreach ($femaleNames as $i => $name) {
    $dept   = $deptList[($i + 3) % count($deptList)];
    $uid    = $year . str_pad($counter++, 4, '0', STR_PAD_LEFT);
    $bYear  = rand(2000, 2005);
    $status = $statuses[$i % count($statuses)];
    $stmt->execute([
        $uid, $name,
        $faculties_list[$dept], $dept,
        $cities[($i+2) % count($cities)],
        "$bYear-" . str_pad(rand(1,12),2,'0',STR_PAD_LEFT) . '-' . str_pad(rand(1,28),2,'0',STR_PAD_LEFT),
        $addresses[($i+2) % count($addresses)],
        '09' . rand(10000000, 99999999),
        'أم ' . explode(' ', $name)[0],
        explode(' ', $name)[1] . ' ' . (explode(' ', $name)[2] ?? ''),
        'أنثى', $status,
        date('Y-m-d H:i:s', strtotime("-" . rand(30,365) . " days")),
        date('Y-m-d H:i:s'),
    ]);
    $studentIds[] = ['id' => (int)$db->lastInsertId(), 'dept' => $dept, 'gender' => 'أنثى'];
}

echo '<li>✅ الطلاب: ' . count($studentIds) . ' (' . count($maleNames) . ' ذكور، ' . count($femaleNames) . ' إناث)</li>';

// =========================================
// 6. العلامات
// =========================================
$subjectsByDept = [
    'هندسة الحاسوب'    => ['مقدمة في البرمجة','رياضيات هندسية 1','هياكل البيانات','قواعد البيانات','نظم التشغيل'],
    'هندسة اتصالات'    => ['مبادئ الاتصالات','إلكترونيات 1','معالجة الإشارات','شبكات لاسلكية'],
    'هندسة ميكاترونيك' => ['ميكانيك تطبيقي','إلكترونيات','برمجة المتحكمات','روبوتيك'],
    'رياضيات'          => ['تفاضل وتكامل 1','جبر خطي','معادلات تفاضلية','إحصاء'],
    'فيزياء'           => ['فيزياء عامة 1','فيزياء عامة 2','ميكانيك كلاسيكي'],
    'كيمياء'           => ['كيمياء عامة','كيمياء عضوية','كيمياء تحليلية'],
    'بيولوجيا'         => ['أحياء عامة','كيمياء حيوية','علم الوراثة'],
    'بيوكيمياء'        => ['كيمياء حيوية مقدمة','بيولوجيا جزيئية','إنزيمات'],
];

$gradeStmt = $db->prepare(
    "INSERT INTO grades (student_id, subject, grade, year, semester, department) VALUES (?,?,?,?,?,?)"
);

$gradesCount = 0;
foreach ($studentIds as $s) {
    $subjects = $subjectsByDept[$s['dept']] ?? ['مادة عامة'];
    $year     = rand(1, 2);
    $semester = rand(0,1) ? 'أول' : 'ثاني';

    foreach ($subjects as $subject) {
        // توزيع واقعي للعلامات: معظمها بين 55-95
        $grade = min(100, max(0, (int)round(
            rand(0,1) ? rand(55, 95) : rand(40, 100)
        )));
        $gradeStmt->execute([$s['id'], $subject, $grade, $year, $semester, $s['dept']]);
        $gradesCount++;
    }
}
echo '<li>✅ العلامات: ' . $gradesCount . '</li>';

// =========================================
// 7. الغيابات
// =========================================
$absStmt = $db->prepare(
    "INSERT INTO absences (student_id, subject, absence_date, year, semester) VALUES (?,?,?,?,?)"
);

$absCount = 0;
// كل طالب له 1-4 غيابات عشوائية
foreach ($studentIds as $s) {
    $subjects = $subjectsByDept[$s['dept']] ?? ['مادة عامة'];
    $numAbs   = rand(1, 4);

    for ($i = 0; $i < $numAbs; $i++) {
        $daysAgo = rand(1, 120);
        $date    = date('Y-m-d', strtotime("-$daysAgo days"));
        $subject = $subjects[array_rand($subjects)];
        $year    = rand(1, 2);
        $sem     = rand(0,1) ? 'أول' : 'ثاني';
        $absStmt->execute([$s['id'], $subject, $date, $year, $sem]);
        $absCount++;
    }
}
echo '<li>✅ الغيابات: ' . $absCount . '</li>';

// =========================================
// نهاية
// =========================================
echo '</ul>';
echo '<div style="background:#dcfce7;border:1px solid #bbf7d0;border-radius:12px;padding:20px;margin-top:20px;">';
echo '<h3 style="color:#16a34a;margin:0 0 10px;">✅ اكتملت عملية زرع البيانات بنجاح!</h3>';
echo '<p style="margin:4px 0;">👨‍🎓 الطلاب: <strong>' . count($studentIds) . '</strong></p>';
echo '<p style="margin:4px 0;">🏛️ الكليات: <strong>' . count($faculties) . '</strong></p>';
echo '<p style="margin:4px 0;">📂 الأقسام: <strong>' . count($departments) . '</strong></p>';
echo '<p style="margin:4px 0;">📚 المقررات: <strong>' . count($courses) . '</strong></p>';
echo '<p style="margin:4px 0;">👨‍🏫 المدرسون: <strong>' . count($staff) . '</strong></p>';
echo '<p style="margin:4px 0;">📊 العلامات: <strong>' . $gradesCount . '</strong></p>';
echo '<p style="margin:4px 0;">📅 الغيابات: <strong>' . $absCount . '</strong></p>';
echo '</div>';
echo '<br><a href="/std_1_student_manager/" style="background:#2563eb;color:white;padding:12px 24px;border-radius:10px;text-decoration:none;font-weight:700;">
      🚀 الدخول للنظام</a>';
echo '</div>';
