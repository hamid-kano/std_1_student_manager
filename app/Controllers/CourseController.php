<?php
class CourseController
{
    private Course $model;
    private string $back = '/std_1_student_manager/?page=courses';

    public function __construct() { $this->model = new Course(); }

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
        if (empty($_POST['name']) || empty($_POST['year']) || empty($_POST['semester'])) {
            Session::flash('error', 'جميع الحقول مطلوبة');
            header("Location: {$this->back}"); exit;
        }
        $this->model->create([
            'name'          => trim($_POST['name']),
            'department_id' => (int)($_POST['department_id'] ?? 0),
            'year'          => $_POST['year'],
            'semester'      => $_POST['semester'],
        ]);
        Session::flash('success', 'تمت إضافة المادة');
        header("Location: {$this->back}"); exit;
    }

    private function update(): void
    {
        $id = (int)($_POST['id'] ?? 0);
        if ($id) $this->model->update($id, [
            'name'          => trim($_POST['name']     ?? ''),
            'department_id' => (int)($_POST['department_id'] ?? 0),
            'year'          => $_POST['year']          ?? '',
            'semester'      => $_POST['semester']      ?? '',
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
