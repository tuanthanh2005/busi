<?php
require_once __DIR__ . '/../app/config/config.php';
session_start();

if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
    die("<h1>ðŸš« ACCESS DENIED: Chá»‰ Admin má»›i Ä‘Æ°á»£c truy cáº­p!</h1>");
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Admin Chat Dashboard</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #f0f2f5; height: 100vh; overflow: hidden; }
        .chat-container { display: flex; height: 100vh; }
        .user-list { width: 300px; background: white; border-right: 1px solid #ddd; overflow-y: auto; }
        .user-item { padding: 15px; border-bottom: 1px solid #eee; cursor: pointer; transition: 0.2s; }
        .user-item:hover { background: #f8f9fa; }
        .user-item.active { background: #e8f0fe; border-left: 4px solid #1a73e8; }
        .user-name { font-weight: bold; margin-bottom: 5px; }
        .last-time { font-size: 11px; color: #888; float: right; }
        .badge-unread { background: #ff3b30; color: white; padding: 2px 8px; border-radius: 10px; font-size: 11px; float: right; }
        
        .chat-area { flex: 1; display: flex; flex-direction: column; background: #fff; }
        .chat-header { padding: 15px; border-bottom: 1px solid #ddd; background: #fff; }
        .messages { flex: 1; padding: 20px; overflow-y: auto; background: #e5ddd5; }
        .message { margin-bottom: 10px; max-width: 70%; padding: 10px 15px; border-radius: 15px; font-size: 14px; position: relative; }
        .message.me { align-self: flex-end; background: #dcf8c6; margin-left: auto; }
        .message.other { align-self: flex-start; background: white; }
        .input-area { padding: 15px; background: #f0f2f5; display: flex; gap: 10px; }
        #msg-input { flex: 1; padding: 10px; border: 1px solid #ddd; border-radius: 20px; outline: none; }
        #send-btn { width: 50px; border-radius: 50%; border: none; background: #1a73e8; color: white; }
        
        .placeholder-text { text-align: center; margin-top: 20%; color: #888; }
    </style>
</head>
<body>

<div class="chat-container">
    <!-- Sidebar: Danh sÃ¡ch user -->
    <div class="user-list" id="user-list">
        <!-- JS sáº½ load user vÃ o Ä‘Ã¢y -->
    </div>

    <!-- Khung chat chÃ­nh -->
    <div class="chat-area">
        <div class="chat-header" id="chat-header" style="display:none;">
            <h5 class="mb-0" id="current-user-name">User Name</h5>
        </div>
        
        <div class="messages d-flex flex-column" id="messages-box">
            <div class="placeholder-text"><h5>â¬…ï¸ Chá»n ngÆ°á»i dÃ¹ng Ä‘á»ƒ báº¯t Ä‘áº§u chat</h5></div>
        </div>
        
        <div class="input-area" id="input-area" style="display:none;">
            <input type="text" id="msg-input" placeholder="Nháº­p tin nháº¯n..." autocomplete="off">
            <button id="send-btn"><i class="fas fa-paper-plane"></i></button>
        </div>
    </div>
</div>

<script>
let currentUserId = 0;

document.addEventListener('DOMContentLoaded', function() {
    const USERS_INTERVAL = 5000;
    const MESSAGES_INTERVAL = 4000;
    let usersTimer = null;
    let messagesTimer = null;

    function startPolling() {
        if (!usersTimer) usersTimer = setInterval(loadUsers, USERS_INTERVAL);
        if (!messagesTimer) {
            messagesTimer = setInterval(() => {
                if (currentUserId > 0) loadMessages(currentUserId);
            }, MESSAGES_INTERVAL);
        }
    }

    function stopPolling() {
        if (usersTimer) { clearInterval(usersTimer); usersTimer = null; }
        if (messagesTimer) { clearInterval(messagesTimer); messagesTimer = null; }
    }

    // Load danh sách user ngay và bắt đầu polling
    loadUsers();
    startPolling();

    // Gửi tin nhắn
    document.getElementById('send-btn').addEventListener('click', sendMessage);
    document.getElementById('msg-input').addEventListener('keypress', function(e) {
        if (e.key === 'Enter') sendMessage();
    });

    // Tạm dừng polling khi tab bị ẩn
    document.addEventListener('visibilitychange', () => {
        if (document.hidden) {
            stopPolling();
        } else {
            loadUsers();
            if (currentUserId > 0) loadMessages(currentUserId);
            startPolling();
        }
    });
});

function loadUsers() {
    fetch('ajax_chat.php', {
        method: 'POST',
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        body: 'action=get_users'
    })
    .then(res => res.json())
    .then(data => {
        const list = document.getElementById('user-list');
        // Giá»¯ láº¡i vá»‹ trÃ­ scroll (náº¿u cáº§n)
        
        let html = '';
        data.users.forEach(u => {
            const activeClass = (u.id == currentUserId) ? 'active' : '';
            const badge = (u.unread > 0) ? `<span class="badge-unread">${u.unread}</span>` : '';
            
            const timeStr = (u.last_msg_time) ? timeSince(new Date(u.last_msg_time)) : 'ChÆ°a chat';
            
            html += `
            <div class="user-item ${activeClass}" onclick="selectUser(${u.id}, '${u.full_name}')">
                <div class="d-flex justify-content-between">
                    <div class="user-name">${u.full_name}</div>
                    <div class="last-time">${timeStr}</div>
                </div>
                <div class="small text-muted">Click Ä‘á»ƒ xem tin nháº¯n... ${badge}</div>
            </div>`;
        });
        list.innerHTML = html;
    });
}

function selectUser(uid, name) {
    currentUserId = uid;
    document.getElementById('current-user-name').innerText = name;
    document.getElementById('chat-header').style.display = 'block';
    document.getElementById('input-area').style.display = 'flex';
    
    // Highlight
    document.querySelectorAll('.user-item').forEach(el => el.classList.remove('active'));
    // (á»ž Ä‘Ã¢y ta render láº¡i list sau nÃªn cÃ³ thá»ƒ máº¥t highlight, nhÆ°ng ko sao vÃ¬ loadUsers sáº½ thÃªm láº¡i)
    
    loadMessages(uid);
}

function loadMessages(uid) {
    if (uid == 0) return;
    
    fetch('ajax_chat.php', {
        method: 'POST',
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        body: 'action=get&target_id=' + uid
    })
    .then(res => res.json())
    .then(data => {
        const box = document.getElementById('messages-box');
        
        // Kiá»ƒm tra xem user cÃ³ Ä‘ang scroll lÃªn xem tin cÅ© khÃ´ng
        const isScrolledToBottom = (box.scrollHeight - box.clientHeight <= box.scrollTop + 50);
        
        let html = '';
        if (data.messages.length === 0) {
            html = '<div class="text-center mt-5 text-muted">ChÆ°a cÃ³ tin nháº¯n nÃ o</div>';
        } else {
            data.messages.forEach(m => {
                const cls = m.is_me ? 'me' : 'other';
                html += `<div class="message ${cls}">${m.msg} <div class="small text-muted text-end" style="font-size:10px">${m.time}</div></div>`;
            });
        }
        
        // Náº¿u thay Ä‘á»•i ná»™i dung thÃ¬ render láº¡i
        // Äá»ƒ tá»‘i Æ°u, ta cÃ³ thá»ƒ so sÃ¡nh length hoáº·c lastID
        // á»ž Ä‘Ã¢y render láº¡i toÃ n bá»™ cho Ä‘Æ¡n giáº£n
        if (box.innerHTML !== html) {
             box.innerHTML = html;
             if (isScrolledToBottom || !box.innerHTML) scrollToBottom();
        }
    });
}

function sendMessage() {
    const input = document.getElementById('msg-input');
    const msg = input.value.trim();
    if (!msg || currentUserId == 0) return;
    
    input.value = '';
    
    fetch('ajax_chat.php', {
        method: 'POST',
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        body: `action=send&message=${encodeURIComponent(msg)}&to_user=${currentUserId}`
    })
    .then(() => {
        loadMessages(currentUserId);
        scrollToBottom();
    });
}

function scrollToBottom() {
    const box = document.getElementById('messages-box');
    box.scrollTop = box.scrollHeight;
}

function timeSince(date) {
    const seconds = Math.floor((new Date() - date) / 1000);
    if (seconds < 60) return seconds + "s";
    const minutes = Math.floor(seconds / 60);
    if (minutes < 60) return minutes + "m";
    const hours = Math.floor(minutes / 60);
    if (hours < 24) return hours + "h";
    return Math.floor(hours / 24) + "d";
}
</script>

</body>
</html>

