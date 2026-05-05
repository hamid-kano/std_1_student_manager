<?php
abstract class BaseModel
{
    protected PDO    $db;
    protected string $table;
    protected array  $fillable = [];

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    public function all(string $order = 'id DESC'): array
    {
        return $this->db->query("SELECT * FROM {$this->table} ORDER BY {$order}")
                        ->fetchAll();
    }

    public function find(int $id): array|false
    {
        $s = $this->db->prepare("SELECT * FROM {$this->table} WHERE id = ?");
        $s->execute([$id]);
        return $s->fetch();
    }

    public function create(array $data): int
    {
        $data  = $this->only($data);
        $cols  = implode(', ', array_keys($data));
        $marks = implode(', ', array_fill(0, count($data), '?'));
        $this->db->prepare("INSERT INTO {$this->table} ({$cols}) VALUES ({$marks})")
                 ->execute(array_values($data));
        return (int) $this->db->lastInsertId();
    }

    public function update(int $id, array $data): void
    {
        $data = $this->only($data);
        $set  = implode(', ', array_map(fn($k) => "$k = ?", array_keys($data)));
        $this->db->prepare("UPDATE {$this->table} SET {$set} WHERE id = ?")
                 ->execute([...array_values($data), $id]);
    }

    public function delete(int $id): void
    {
        $this->db->prepare("DELETE FROM {$this->table} WHERE id = ?")
                 ->execute([$id]);
    }

    protected function only(array $data): array
    {
        if (empty($this->fillable)) return $data;
        return array_intersect_key($data, array_flip($this->fillable));
    }

    protected function redirect(string $page, string $msg = '', string $type = 'success'): never
    {
        $base = '/std_1_student_manager/?page=' . $page;
        if ($msg) Session::flash($type, $msg);
        header("Location: $base");
        exit;
    }
}
