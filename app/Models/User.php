<?php

namespace App\Models;

use App\Helpers\Database;
use PDO;

class User {
    private PDO $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    public function getAllUsers(): array {
        $stmt = $this->db->query("SELECT id, username, email FROM users");
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function getUserById(int $id): ?object {
        $stmt = $this->db->prepare("SELECT id, username, email, birthdate, url, phone_number FROM users WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ) ?: null;
    }

    public function createUser(array $data): bool {
        $stmt = $this->db->prepare("INSERT INTO users (username, email, password, birthdate, phone_number, url) VALUES (:username, :email, :password, :birthdate, :phone_number, :url)");
        return $stmt->execute($data);
    }

    public function deleteUser(int $id): bool {
        $stmt = $this->db->prepare("DELETE FROM users WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
