<?php
class Course extends BaseModel
{
    protected string $table    = 'courses';
    protected array  $fillable = ['name','department_id','year','semester'];

    public function grouped(): array
    {
        $rows   = $this->db->query(
            "SELECT c.*, d.name AS dept_name
             FROM courses c
             LEFT JOIN departments d ON c.department_id = d.id
             ORDER BY d.name, c.year, c.semester, c.name"
        )->fetchAll();

        $result = [];
        foreach ($rows as $r) {
            $result[$r['dept_name']][$r['year']][$r['semester']][] = $r;
        }
        return $result;
    }
}
