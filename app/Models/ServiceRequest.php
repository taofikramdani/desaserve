<?php

namespace App\Models;

use App\Core\Database;

class ServiceRequest
{
    public static function create(int $userId, string $type, string $description, ?string $documentUrl): bool
    {
        $pdo = Database::connection();
        $stmt = $pdo->prepare('INSERT INTO service_requests (user_id, request_type, description, document_url) VALUES (?, ?, ?, ?)');

        return $stmt->execute([$userId, $type, $description, $documentUrl]);
    }

    public static function listByUser(int $userId): array
    {
        $pdo = Database::connection();
        $stmt = $pdo->prepare('SELECT * FROM service_requests WHERE user_id = ? ORDER BY created_at DESC');
        $stmt->execute([$userId]);

        return $stmt->fetchAll();
    }

    public static function listAll(): array
    {
        $pdo = Database::connection();
        $stmt = $pdo->query('SELECT sr.*, u.name AS user_name FROM service_requests sr JOIN users u ON sr.user_id = u.id ORDER BY sr.created_at DESC');

        return $stmt->fetchAll();
    }

    public static function updateStatus(int $id, string $status): bool
    {
        $pdo = Database::connection();
        $stmt = $pdo->prepare('UPDATE service_requests SET status = ? WHERE id = ?');

        return $stmt->execute([$status, $id]);
    }
}
