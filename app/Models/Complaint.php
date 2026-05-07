<?php

namespace App\Models;

use App\Core\Database;

class Complaint
{
    public static function create(int $userId, string $title, string $description, ?string $photoUrl): bool
    {
        $pdo = Database::connection();
        $stmt = $pdo->prepare('INSERT INTO complaints (user_id, title, description, photo_url) VALUES (?, ?, ?, ?)');

        return $stmt->execute([$userId, $title, $description, $photoUrl]);
    }

    public static function listByUser(int $userId): array
    {
        $pdo = Database::connection();
        $stmt = $pdo->prepare('SELECT * FROM complaints WHERE user_id = ? ORDER BY created_at DESC');
        $stmt->execute([$userId]);

        return $stmt->fetchAll();
    }

    public static function listAll(): array
    {
        $pdo = Database::connection();
        $stmt = $pdo->query('SELECT c.*, u.name AS user_name FROM complaints c JOIN users u ON c.user_id = u.id ORDER BY c.created_at DESC');

        return $stmt->fetchAll();
    }

    public static function updateStatus(int $id, string $status): bool
    {
        $pdo = Database::connection();
        $stmt = $pdo->prepare('UPDATE complaints SET status = ? WHERE id = ?');

        return $stmt->execute([$status, $id]);
    }
}
