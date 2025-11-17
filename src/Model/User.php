<?php
namespace Model;

use PDO;

class User
{
    protected $db;
    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    public function findByUsername(string $username): ?array
    {
        $stmt = $this->db->prepare("SELECT * FROM `User` WHERE Username = :u");
        $stmt->execute([':u'=>$username]);
        return $stmt->fetch() ?: null;
    }

    public function findById(int $id): ?array
    {
        $stmt = $this->db->prepare("SELECT * FROM `User` WHERE UserID = :id");
        $stmt->execute([':id'=>$id]);
        return $stmt->fetch() ?: null;
    }

    public function getRoles(int $userId): array
    {
        $stmt = $this->db->prepare("
            SELECT r.Name
            FROM Role r
            JOIN UserRole ur ON ur.RoleID = r.RoleID
            WHERE ur.UserID = :uid
        ");
        $stmt->execute([':uid'=>$userId]);
        return array_column($stmt->fetchAll(PDO::FETCH_ASSOC), 'Name');
    }
}