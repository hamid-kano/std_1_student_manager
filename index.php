<?php
require_once __DIR__ . '/app/bootstrap.php';

Session::start();

$page = $_GET['page'] ?? 'dashboard';

// صفحة تسجيل الدخول - لا تحتاج حماية
if ($page === 'login') {
    require_once __DIR__ . '/views/auth/login.php';
    exit;
}

// باقي الصفحات تحتاج تسجيل دخول
Session::requireLogin();

// تحميل البيانات حسب الصفحة
$data = match($page) {
    'students'    => ['students'    => (new Student())->filter(
                          $_GET['q']          ?? '',
                          $_GET['department'] ?? '',
                          $_GET['status']     ?? 'all'
                      ),
                      'counts'      => (new Student())->counts()],

    'staff'       => ['staff'       => (new Staff())->all()],
    'faculties'   => ['faculties'   => (new Faculty())->all()],

    'departments' => ['departments' => (new Department())->allWithFaculty(),
                      'faculties'   => (new Faculty())->all()],

    'courses'     => ['courses'     => (new Course())->grouped(),
                      'departments' => (new Department())->all()],

    'register'    => ['faculties'   => (new Faculty())->all(),
                      'departments' => (new Department())->all()],

    'grades'      => ['grades'      => (new Grade())->allGrouped(
                          $_GET['q']          ?? '',
                          $_GET['department'] ?? 'all'
                      ),
                      'departments' => (new Department())->all()],

    'absences'    => ['absences'    => (new Absence())->allWithStudent(
                          $_GET['q']        ?? '',
                          $_GET['year']     ?? '',
                          $_GET['semester'] ?? ''
                      )],

    'cards'       => [],
    default       => [],
};

// عرض الصفحة
require_once __DIR__ . '/views/layout/header.php';
?>

<div class="dashboard">
  <?php require_once __DIR__ . '/views/layout/sidebar.php'; ?>

  <div class="content">
    <?php
    $view = __DIR__ . "/views/pages/{$page}.php";
    if (file_exists($view)) {
        require_once $view;
    } else {
        require_once __DIR__ . '/views/pages/dashboard.php';
    }
    ?>
  </div>
</div>

<?php require_once __DIR__ . '/views/layout/footer.php'; ?>
