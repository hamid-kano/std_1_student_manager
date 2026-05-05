<?php
class AbsenceController
{
    private Absence $model;
    private Student $studentModel;
    private string  $back = '/std_1_student_manager/?page=absences';

    public function __construct()
    {
        $this->model        = new Absence();
        $this->studentModel = new Student();
    }

    public function handle(): void
    {
        Session::requireLogin();
        match($_POST['action'] ?? '') {
            'store'  => $this->store(),
            'update' => $this->update(),
            'delete' => $this->delete(),
            default  => header("Location: {$this->back}") & exit
        };
    }

    private function store(): void
    {
        $uid = trim($_POST['university_id'] ?? '');

        if (!$uid || empty($_POST['subject']) || empty($_POST['absence_date'])) {
            Session::flash('error', 'جميع الحقول مطلوبة');
            header("Location: {$this->back}"); exit;
        }

        $student = $this->studentModel->findByUniversityId($uid);
        if (!$student) {
            Session::flash('error', 'الرقم الجامعي غير موجود');
            header("Location: {$this->back}"); exit;
        }

        $this->model->create([
            'student_id'   => $student['id'],
            'subject'      => trim($_POST['subject']),
            'absence_date' => $_POST['absence_date'],
            'year'         => $_POST['year']     ?? '1',
            'semester'     => $_POST['semester'] ?? 'أول',
        ]);

        Session::flash('success', 'تم تسجيل الغياب');
        header("Location: {$this->back}"); exit;
    }

    private function update(): void
    {
        $id = (int)($_POST['id'] ?? 0);
        if ($id) $this->model->update($id, [
            'subject'      => trim($_POST['subject']      ?? ''),
            'absence_date' => $_POST['absence_date']      ?? '',
            'year'         => $_POST['year']              ?? '',
            'semester'     => $_POST['semester']          ?? '',
        ]);
        Session::flash('success', 'تم التعديل');
        header("Location: {$this->back}"); exit;
    }

    private function delete(): void
    {
        $id = (int)($_POST['id'] ?? 0);
        if ($id) $this->model->delete($id);
        Session::flash('success', 'تم الحذف');
        header("Location: {$this->back}"); exit;
    }
}
