<?php
namespace Model;

use PDO;

class Student
{
    protected $db;
    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    public function all(): array
    {
        return $this->db->query("SELECT * FROM Student ORDER BY CreatedAt DESC")->fetchAll();
    }

    public function find(int $id): ?array
    {
        $stmt = $this->db->prepare("SELECT * FROM Student WHERE StudentID = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch() ?: null;
    }

    public function create(array $data): int
    {
        $stmt = $this->db->prepare("INSERT INTO Student (EnrollmentNo, FirstName, LastName, DOB, Gender, Email, Phone) VALUES (:enr, :fn, :ln, :dob, :gender, :email, :phone)");
        $stmt->execute([
            ':enr' => $data['EnrollmentNo'],
            ':fn' => $data['FirstName'],
            ':ln' => $data['LastName'],
            ':dob' => $data['DOB'] ?: null,
            ':gender' => $data['Gender'] ?: null,
            ':email' => $data['Email'] ?: null,
            ':phone' => $data['Phone'] ?: null,
        ]);
        return (int)$this->db->lastInsertId();
    }

    public function update(int $id, array $data): bool
    {
        $stmt = $this->db->prepare("UPDATE Student SET EnrollmentNo=:enr, FirstName=:fn, LastName=:ln, DOB=:dob, Gender=:gender, Email=:email, Phone=:phone WHERE StudentID = :id");
        return $stmt->execute([
            ':enr' => $data['EnrollmentNo'],
            ':fn' => $data['FirstName'],
            ':ln' => $data['LastName'],
            ':dob' => $data['DOB'] ?: null,
            ':gender' => $data['Gender'] ?: null,
            ':email' => $data['Email'] ?: null,
            ':phone' => $data['Phone'] ?: null,
            ':id' => $id
        ]);
    }

    public function delete(int $id): bool
    {
        $stmt = $this->db->prepare("DELETE FROM Student WHERE StudentID = :id");
        return $stmt->execute([':id' => $id]);
    }
}