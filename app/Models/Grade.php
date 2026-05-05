<?php
class Grade extends BaseModel
{
    protected string $table    = 'grades';
    protected array  $fillable = ['student_id','subject','grade','year','semester','department'];

    public function allGrouped(string $q = '', string $dept = ''): array
    {
        $where = ['1=1'];
        $p     = [];

        if ($q) {
            $where[] = '(s.name LIKE ? OR s.university_id LIKE ?)';
            $p[] = "%$q%"; $p[] = "%$q%";
        }
        if ($dept && $dept !== 'all') {
            $where[] = 'g.department = ?';
            $p[] = $dept;
        }

        $s = $this->db->prepare(
            "SELECT g.*, s.name AS student_name, s.university_id
             FROM grades g JOIN students s ON g.student_id = s.id
             WHERE " . implode(' AND ', $where) . "
             ORDER BY s.name, g.year, g.semester"
        );
        $s->execute($p);
        $rows   = $s->fetchAll();
        $result = [];

        foreach ($rows as $r) {
            $sid = $r['student_id'];
            if (!isset($result[$sid])) {
                $result[$sid] = [
                    'student_id'    => $sid,
                    'student_name'  => $r['student_name'],
                    'university_id' => $r['university_id'],
                    'department'    => $r['department'],
                    'year'          => $r['year'],
                    'semester'      => $r['semester'],
                    'grades'        => [],
                ];
            }
            $result[$sid]['grades'][] = ['id' => $r['id'], 'subject' => $r['subject'], 'grade' => $r['grade']];
        }
        return array_values($result);
    }
}
