<?php
class Absence extends BaseModel
{
    protected string $table    = 'absences';
    protected array  $fillable = ['student_id','subject','absence_date','year','semester'];

    public function allWithStudent(string $q = '', string $year = '', string $sem = ''): array
    {
        $where = ['1=1'];
        $p     = [];

        if ($q) {
            $where[] = '(s.name LIKE ? OR s.university_id LIKE ?)';
            $p[] = "%$q%"; $p[] = "%$q%";
        }
        if ($year) { $where[] = 'a.year = ?';     $p[] = $year; }
        if ($sem)  { $where[] = 'a.semester = ?'; $p[] = $sem;  }

        $s = $this->db->prepare(
            "SELECT a.*, s.name AS student_name, s.university_id
             FROM absences a JOIN students s ON a.student_id = s.id
             WHERE " . implode(' AND ', $where) . "
             ORDER BY a.absence_date DESC"
        );
        $s->execute($p);
        return $s->fetchAll();
    }
}
