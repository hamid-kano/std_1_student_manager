<?php
class StudentController
{
    private Student $model;

    public function __construct() { $this->model = new Student(); }

    public function handle(): void
    {
        Session::requireLogin();
        $action = $_POST['action'] ?? '';

        match($action) {
            'store'         => $this->store(),
            'update'        => $this->update(),
            'delete'        => $this->delete(),
            'toggle_status' => $this->toggleStatus(),
            default         => $this->back()
        };
    }

    private function store(): void
    {
        $uid = trim($_POST['university_id'] ?? '');
        $name = trim($_POST['name'] ?? '');

        if (!$uid || !$name) {
            Session::flash('error', 'الرقم الجامعي والاسم مطلوبان');
            $this->back();
        }

        if ($this->model->findByUniversityId($uid)) {
            Session::flash('error', 'الرقم الجامعي مسجل مسبقاً');
            $this->back();
        }

        // معالجة الصورة
        $image = '';
        if (!empty($_FILES['image']['tmp_name'])) {
            $image = $this->uploadImage($_FILES['image']);
        }

        $this->model->create([
            'university_id' => $uid,
            'name'          => $name,
            'faculty'       => $_POST['faculty']     ?? '',
            'department'    => $_POST['department']  ?? '',
            'birth_place'   => $_POST['birth_place'] ?? '',
            'birth_date'    => $_POST['birth_date']  ?? '',
            'address'       => $_POST['address']     ?? '',
            'phone'         => $_POST['phone']       ?? '',
            'mother_name'   => $_POST['mother_name'] ?? '',
            'father_name'   => $_POST['father_name'] ?? '',
            'gender'        => $_POST['gender']      ?? 'ذكر',
            'status'        => 'active',
            'image'         => $image,
            'created_at'    => date('Y-m-d H:i:s'),
            'updated_at'    => date('Y-m-d H:i:s'),
        ]);

        Session::flash('success', 'تم تسجيل الطالب بنجاح ✅');
        $this->back();
    }

    private function update(): void
    {
        $id = (int)($_POST['id'] ?? 0);
        if (!$id) $this->back();

        $data = [
            'name'        => trim($_POST['name']        ?? ''),
            'faculty'     => $_POST['faculty']          ?? '',
            'department'  => $_POST['department']       ?? '',
            'birth_place' => $_POST['birth_place']      ?? '',
            'birth_date'  => $_POST['birth_date']       ?? '',
            'address'     => $_POST['address']          ?? '',
            'phone'       => $_POST['phone']            ?? '',
            'mother_name' => $_POST['mother_name']      ?? '',
            'father_name' => $_POST['father_name']      ?? '',
            'gender'      => $_POST['gender']           ?? 'ذكر',
            'updated_at'  => date('Y-m-d H:i:s'),
        ];

        if (!empty($_FILES['image']['tmp_name'])) {
            $data['image'] = $this->uploadImage($_FILES['image']);
        }

        $this->model->update($id, $data);
        Session::flash('success', 'تم تعديل بيانات الطالب');
        $this->back();
    }

    private function delete(): void
    {
        $id = (int)($_POST['id'] ?? 0);
        if ($id) $this->model->delete($id);
        Session::flash('success', 'تم حذف الطالب');
        $this->back();
    }

    private function toggleStatus(): void
    {
        $id = (int)($_POST['id'] ?? 0);
        if ($id) $this->model->toggleStatus($id);
        $this->back();
    }

    private function uploadImage(array $file): string
    {
        $dir = __DIR__ . '/../../assets/uploads/students/';
        if (!is_dir($dir)) mkdir($dir, 0755, true);

        $ext      = pathinfo($file['name'], PATHINFO_EXTENSION);
        $filename = uniqid('student_') . '.' . $ext;
        move_uploaded_file($file['tmp_name'], $dir . $filename);

        return '/std_1_student_manager/assets/uploads/students/' . $filename;
    }

    private function back(): never
    {
        header('Location: /std_1_student_manager/?page=students');
        exit;
    }
}
