<?php

class Tours {
    public static function getScheduledToursByUserId($userId) {
        $db = Database::getInstance();
        $pdo = $db->getConnection();

        $stmt = $pdo->prepare("
            SELECT st.*, p.title AS property_title
            FROM scheduled_tours st
            JOIN properties p ON st.property_id = p.id
            WHERE st.user_id = ?
            ORDER BY st.scheduled_date DESC
        ");
        $stmt->execute([$userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
