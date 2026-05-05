<?php
class FacultyController
{
    private Faculty $model;
    private string  $back = '/std_1_student_manager/?page=faculties';

    public function __construct() { $this->model = new Faculty(); }

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
        if (empty($_POST['name'])) {
            Session::flash('error', 'اسم الكلية مطلوب');
            header("Location: {$this->back}"); exit;
        }
        $this->model->create([
            'name' => trim($_POST['name']),
            'dean' => trim($_POST['dean'] ?? ''),
        ]);
        Session::flash('success', 'تمت إضافة الكلية');
        header("Location: {$this->back}"); exit;
    }

    private function update(): void
    {
        $id = (int)($_POST['id'] ?? 0);
        if ($id) $this->model->update($id, [
            'name' => trim($_POST['name'] ?? ''),
            'dean' => trim($_POST['dean'] ?? ''),
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
