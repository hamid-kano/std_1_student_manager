<?php
class GradeController
{
    private Grade   $model;
    private Student $studentModel;
    private string  $back = '/std_1_student_manager/?page=grades';

    public function __construct()
    {
        $this->model        = new Grade();
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
        $uid   = trim($_POST['university_id'] ?? '');
        $grade = $_POST['grade'] ?? '';

        if (!$uid || !$_POST['subject'] || $grade === '') {
            Session::flash('error', 'جميع الحقول مطلوبة');
            header("Location: {$this->back}"); exit;
        }

        if ($grade < 0 || $grade > 100) {
            Session::flash('error', 'العلامة يجب أن تكون بين 0 و 100');
            header("Location: {$this->back}"); exit;
        }

        // البحث عن الطالب بالرقم الجامعي
        $student = $this->studentModel->findByUniversityId($uid);
        if (!$student) {
            Session::flash('error', 'الرقم الجامعي غير موجود');
            header("Location: {$this->back}"); exit;
        }

        $this->model->create([
            'student_id' => $student['id'],
            'subject'    => trim($_POST['subject']),
            'grade'      => (float)$grade,
            'year'       => $_POST['year']       ?? '1',
            'semester'   => $_POST['semester']   ?? 'أول',
            'department' => $_POST['department'] ?? $student['department'],
        ]);

        Session::flash('success', 'تمت إضافة العلامة');
        header("Location: {$this->back}"); exit;
    }

    private function update(): void
    {
        $id    = (int)($_POST['id']    ?? 0);
        $grade = $_POST['grade'] ?? '';

        if ($id && $grade !== '' && $grade >= 0 && $grade <= 100) {
            $this->model->update($id, [
                'subject' => trim($_POST['subject'] ?? ''),
                'grade'   => (float)$grade,
            ]);
        }
        Session::flash('success', 'تم تعديل العلامة');
        header("Location: {$this->back}"); exit;
    }

    private function delete(): void
    {
        $id = (int)($_POST['id'] ?? 0);
        if ($id) $this->model->delete($id);
        Session::flash('success', 'تم حذف العلامة');
        header("Location: {$this->back}"); exit;
    }
}
