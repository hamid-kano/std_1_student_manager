<?php
/**
 * Router - يوجه POST requests للـ Controller المناسب
 */
require_once __DIR__ . '/../app/bootstrap.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: /std_1_student_manager/');
    exit;
}

$controller = $_POST['controller'] ?? '';

match($controller) {
    'auth'       => (new AuthController())->handle(),
    'students'   => (new StudentController())->handle(),
    'staff'      => (new StaffController())->handle(),
    'faculties'  => (new FacultyController())->handle(),
    'departments'=> (new DepartmentController())->handle(),
    'courses'    => (new CourseController())->handle(),
    'grades'     => (new GradeController())->handle(),
    'absences'   => (new AbsenceController())->handle(),
    default      => header('Location: /std_1_student_manager/') & exit
};
