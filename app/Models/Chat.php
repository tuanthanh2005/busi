<?php
require_once '../app/Core/Database.php';

class ChatModel extends Database
{
    // Gửi tin nhắn
    public function send($sender_id, $receiver_id, $message) {
        $this->query("INSERT INTO messages (sender_id, receiver_id, message) VALUES (:sender, :receiver, :msg)");
        $this->bind(':sender', $sender_id);
        $this->bind(':receiver', $receiver_id);
        $this->bind(':msg', $message);
        return $this->execute();
    }

    // Lấy tin nhắn giữa User và Admin (999 tượng trưng Admin)
    public function getConversation($user_id) {
        // Lấy tin user gửi admin HOẶC admin gửi user
        $sql = "SELECT * FROM messages 
                WHERE (sender_id = :uid AND receiver_id = 999) 
                   OR (sender_id = 999 AND receiver_id = :uid)
                ORDER BY created_at ASC";
        $this->query($sql);
        $this->bind(':uid', $user_id);
        return $this->resultSet();
    }

    // Đánh dấu đã đọc
    public function markAsRead($user_id, $viewer_type) {
        // Nếu User xem -> Mark tin nhắn TỪ Admin (999) là đã đọc
        if ($viewer_type == 'user') {
            $this->query("UPDATE messages SET is_read = 1 WHERE sender_id = 999 AND receiver_id = :uid");
            $this->bind(':uid', $user_id);
        } 
        // Nếu Admin xem -> Mark tin nhắn TỪ User là đã đọc
        else {
            $this->query("UPDATE messages SET is_read = 1 WHERE sender_id = :uid AND receiver_id = 999");
            $this->bind(':uid', $user_id);
        }
        $this->execute();
    }

    // Đếm tin chưa đọc
    public function countUnread($user_id, $role) {
        if ($role == 'user') {
            // Đếm tin ADMIN gửi tới USER chưa đọc
            $this->query("SELECT COUNT(*) as count FROM messages WHERE sender_id = 999 AND receiver_id = :uid AND is_read = 0");
            $this->bind(':uid', $user_id);
        } else {
            // ADMIN: Đếm TẤT CẢ tin chưa đọc gửi tới Admin
            $this->query("SELECT COUNT(*) as count FROM messages WHERE receiver_id = 999 AND is_read = 0");
        }
        return $this->single()->count;
    }
}
