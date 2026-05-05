<?php
class Department extends BaseModel
{
    protected string $table    = 'departments';
    protected array  $fillable = ['name','faculty_id'];

    public function allWithFaculty(): array
    {
        return $this->db->query(
            "SELECT d.*, f.name AS faculty_name
             FROM departments d
             LEFT JOIN faculties f ON d.faculty_id = f.id
             ORDER BY d.id DESC"
        )->fetchAll();
    }
}
