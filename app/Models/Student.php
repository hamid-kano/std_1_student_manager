<?php
class Student extends BaseModel
{
    protected string $table    = 'students';
    protected array  $fillable = [
        'university_id','name','faculty','department',
        'birth_place','birth_date','address','phone',
        'mother_name','father_name','gender','status','image',
        'created_at','updated_at'
    ];

    public function filter(string $q = '', string $dept = '', string $status = 'all'): array
    {
        $where = ['1=1'];
        $p     = [];

        if ($q) {
            $where[] = '(name LIKE ? OR university_id LIKE ?)';
            $p[] = "%$q%"; $p[] = "%$q%";
        }
        if ($dept) { $where[] = 'department = ?'; $p[] = $dept; }
        if ($status !== 'all') { $where[] = 'status = ?'; $p[] = $status; }

        $s = $this->db->prepare(
            "SELECT * FROM students WHERE " . implode(' AND ', $where) . " ORDER BY id DESC"
        );
        $s->execute($p);
        return $s->fetchAll();
    }

    public function findByUniversityId(string $uid): array|false
    {
        $s = $this->db->prepare("SELECT * FROM students WHERE university_id = ?");
        $s->execute([$uid]);
        return $s->fetch();
    }

    public function toggleStatus(int $id): void
    {
        $this->db->prepare(
            "UPDATE students SET status = CASE WHEN status='active' THEN 'inactive' ELSE 'active' END
             WHERE id = ?"
        )->execute([$id]);
    }

    public function counts(): array
    {
        $row = $this->db->query(
            "SELECT COUNT(*) total,
                    SUM(status='active')   active,
                    SUM(status='inactive') inactive
             FROM students"
        )->fetch();
        return $row;
    }
}
