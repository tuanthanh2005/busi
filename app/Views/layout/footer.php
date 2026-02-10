    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-light footer py-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container text-center py-5">
            <a href="<?= Config::url() ?>">
                <h1 class="display-4 mb-3 text-white text-uppercase"><i class="fa-solid fa-code me-1"></i>DigitalPro</h1>
            </a>
            <p class="fs-5 mb-4">Giáº£i PhÃ¡p Sá»' ToÃ n Diá»‡n - Blockchain, Web Design & Marketing</p>
            <div class="d-flex justify-content-center mb-4">
                <a class="btn btn-lg-square btn-outline-primary border-2 m-1" href="#!" title="Facebook"><i
                        class="fab fa-facebook-f"></i></a>
                <a class="btn btn-lg-square btn-outline-primary border-2 m-1" href="#!" title="Telegram"><i
                        class="fab fa-telegram"></i></a>
                <a class="btn btn-lg-square btn-outline-primary border-2 m-1" href="#!" title="TikTok"><i
                        class="fab fa-tiktok"></i></a>
                <a class="btn btn-lg-square btn-outline-primary border-2 m-1" href="#!" title="YouTube"><i
                        class="fab fa-youtube"></i></a>
                <a class="btn btn-lg-square btn-outline-primary border-2 m-1" href="#!" title="LinkedIn"><i
                        class="fab fa-linkedin-in"></i></a>
            </div>
            <div class="border-top border-secondary pt-4">
                <p class="mb-2">&copy; <?= date('Y') ?> <a class="border-bottom text-primary" href="<?= Config::url() ?>">DigitalPro</a>. All Rights Reserved.</p>
                <p class="mb-0 text-secondary">Powered by Advanced Technology & Innovation</p>
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-outline-primary border-2 btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- JavaScript Libraries (Quản lý từ Config Helper) -->
    <?php 
    $jsLibs = Config::getJsLibs();
    foreach ($jsLibs as $js) {
        echo '<script src="' . $js . '"></script>' . "\n";
    }
    ?>

    <!-- ðŸ”¥ LIVE CHAT SYSTEM CLIENT ðŸ”¥ -->
    <?php $isLoggedIn = !empty($_SESSION['user_id']); ?>
    
    <!-- Box Chat -->
    <div id="live-chat-box" class="live-chat-box shadow-lg">
        <div class="chat-header">
            <div class="d-flex align-items-center">
                <div class="position-relative">
                    <img src="https://ui-avatars.com/api/?name=Admin&background=fff&color=8E2DE2" class="rounded-circle" width="40" height="40" alt="Admin">
                    <span class="position-absolute bottom-0 end-0 bg-success p-1 border border-light rounded-circle"></span>
                </div>
                <div class="ms-3">
                    <h6 class="mb-0 text-white fw-bold">CSKH DigitalPro</h6>
                    <small class="text-white-50" style="font-size: 11px;">ThÆ°á»ng tráº£ lá»i sau 5 phÃºt</small>
                </div>
            </div>
            <button id="close-chat" class="btn btn-sm text-white-50 hover-white"><i class="fas fa-times fa-lg"></i></button>
        </div>
        
        <div id="chat-messages" class="chat-body">
            <?php if ($isLoggedIn): ?>
                <div class="text-center mt-3"><div class="spinner-border text-primary" role="status"><span class="visually-hidden">Loading...</span></div></div>
            <?php else: ?>
                <div class="text-center text-muted small mt-4">
                    Báº¡n cáº§n Ä‘Äƒng nháº­p Ä‘á»ƒ báº¯t Ä‘áº§u chat.<br>
                    <a href="<?= Config::url() ?>auth/login" class="text-primary fw-bold">ÄÄƒng nháº­p ngay</a>
                </div>
            <?php endif; ?>
        </div>
        
        <div class="chat-footer">
            <input type="text" id="chat-input" placeholder="Nháº­p tin nháº¯n..." autocomplete="off" <?= $isLoggedIn ? '' : 'disabled' ?>>
            <button id="send-btn" <?= $isLoggedIn ? '' : 'disabled' ?>><i class="fas fa-paper-plane"></i></button>
        </div>
    </div>

    <!-- Contact Widgets -->
    <div class="contact-widgets-container">
        <!-- Live Chat Button (Sáº½ Ä‘Æ°á»£c JS chÃ¨n badge vÃ o Ä‘Ã¢y) -->
        <a href="#" id="live-chat-trigger" class="chat-widget live-chat-widget mb-3">
            <i class="fas fa-comment-dots fa-lg"></i>
            <span class="chat-tooltip">Live Chat</span>
            <!-- Badge sáº½ Ä‘Æ°á»£c JS thÃªm vÃ o Ä‘Ã¢y -->
        </a>

        <!-- Zalo -->
        <a href="https://zalo.me/0708910952" target="_blank" class="chat-widget zalo-widget mb-3">
            <span class="fw-bold" style="font-size: 14px;">Zalo</span>
            <span class="chat-tooltip">Chat Zalo</span>
        </a>

        <!-- Telegram -->
        <a href="https://t.me/specademy" target="_blank" class="chat-widget telegram-widget">
            <i class="fab fa-telegram-plane fa-lg"></i>
            <span class="chat-tooltip">Chat Telegram</span>
        </a>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const chatBox = document.getElementById('live-chat-box');
        const triggerBtn = document.getElementById('live-chat-trigger');
        const closeBtn = document.getElementById('close-chat');
        const chatMsgs = document.getElementById('chat-messages');
        const chatInput = document.getElementById('chat-input');
        const sendBtn = document.getElementById('send-btn');
        
        const isLoggedIn = <?= $isLoggedIn ? 'true' : 'false' ?>;
        let isChatOpen = false;
        let badgeCount = 0;
        const POLL_INTERVAL = 4000;
        let pollTimer = null;

        // Toggle Chat
        triggerBtn.addEventListener('click', function(e) {
            e.preventDefault();
            isChatOpen = !isChatOpen;
            chatBox.style.display = isChatOpen ? 'flex' : 'none';
            
            if (isChatOpen) {
                if (isLoggedIn) {
                    fetchMessages();
                    markAsRead();
                    setTimeout(scrollToBottom, 100);
                    document.getElementById('chat-input').focus();
                } else {
                    showLoginNotice();
                }
            }
        });

        closeBtn.addEventListener('click', () => {
            isChatOpen = false;
            chatBox.style.display = 'none';
        });

        // Gá»­i tin nháº¯n
        function sendMessage() {
            const msg = chatInput.value.trim();
            if (!msg) return;
            if (!isLoggedIn) {
                showLoginNotice();
                return;
            }

            // UI Update ngay láº­p tá»©c
            appendMessage(msg, true, 'Vá»«a xong');
            chatInput.value = '';
            scrollToBottom();

            // AJAX
            fetch('<?= Config::url('ajax_chat.php') ?>', {
                method: 'POST',
                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                body: 'action=send&message=' + encodeURIComponent(msg)
            })
            .then(res => res.json())
            .then(data => {
                if(data.error) {
                    alert('Lá»—i: ' + data.error); // VÃ­ dá»¥: chÆ°a Ä‘Äƒng nháº­p
                    // CÃ³ thá»ƒ redirect tá»›i login náº¿u cáº§n
                }
            });
        }

        sendBtn.addEventListener('click', sendMessage);
        chatInput.addEventListener('keypress', (e) => { if(e.key === 'Enter') sendMessage(); });

        // Polling tin nhắn & Badge
        function startPolling() {
            if (!isLoggedIn || pollTimer) return;
            pollTimer = setInterval(() => {
                if (document.hidden) return;
                if (isChatOpen) fetchMessages();
                checkBadge();
            }, POLL_INTERVAL);
        }

        function stopPolling() {
            if (!pollTimer) return;
            clearInterval(pollTimer);
            pollTimer = null;
        }

        startPolling();

        document.addEventListener('visibilitychange', () => {
            if (document.hidden) {
                stopPolling();
            } else {
                if (isLoggedIn) {
                    checkBadge();
                    if (isChatOpen) fetchMessages();
                    startPolling();
                }
            }
        });

        function fetchMessages() {
            fetch('<?= Config::url('ajax_chat.php?action=get') ?>', {
                method: 'POST',
                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                body: 'action=get'
            })
            .then(res => res.json())
            .then(data => {
                if (data.messages) {
                    renderMessages(data.messages);
                }
            })
            .catch(err => console.error("Chat Error:", err));
        }

        function renderMessages(msgs) {
            chatMsgs.innerHTML = '';
            if(msgs.length === 0) {
                chatMsgs.innerHTML = '<div class="text-center text-muted small mt-5">ChÆ°a cÃ³ tin nháº¯n nÃ o.<br>HÃ£y báº¯t Ä‘áº§u trÃ² chuyá»‡n!</div>';
                return;
            }

            msgs.forEach(m => {
                appendMessage(m.msg, m.is_me, m.time);
            });
        }

        function appendMessage(msg, isMe, time) {
            const div = document.createElement('div');
            div.className = isMe ? 'message me' : 'message other';
            div.innerHTML = `${msg} <span class="time">${time}</span>`;
            chatMsgs.appendChild(div);
        }

        function checkBadge() {
            fetch('<?= Config::url('ajax_chat.php') ?>', {
                method: 'POST',
                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                body: 'action=count'
            })
            .then(res => res.json())
            .then(data => {
                updateBadge(data.unread);
            });
        }

        function updateBadge(count) {
            // TÃ¬m hoáº·c táº¡o badge
            let badge = triggerBtn.querySelector('.chat-badge-vip');
            if (!badge && count > 0) {
                badge = document.createElement('span');
                badge.className = 'chat-badge-vip';
                triggerBtn.appendChild(badge);
            }
            
            if (count > 0) {
                badge.innerText = count > 99 ? '99+' : count;
                badge.style.display = 'flex';
                badge.classList.add('pulse-anim');
            } else if (badge) {
                badge.style.display = 'none';
            }
        }

        function markAsRead() {
            updateBadge(0);
        }

        function scrollToBottom() {
            chatMsgs.scrollTop = chatMsgs.scrollHeight;
        }

        function showLoginNotice() {
            chatMsgs.innerHTML = '<div class="text-center text-muted small mt-4">Báº¡n cáº§n Ä‘Äƒng nháº­p Ä‘á»ƒ báº¯t Ä‘áº§u chat.<br><a href="<?= Config::url() ?>auth/login" class="text-primary fw-bold">ÄÄƒng nháº­p ngay</a></div>';
        }
    });
    </script>
    
    <style>
    /* Widget Container */
    .contact-widgets-container {
        position: fixed;
        bottom: 30px;
        right: 30px;
        z-index: 9999999 !important;
        display: flex;
        flex-direction: column;
        gap: 15px; /* Khoáº£ng cÃ¡ch giá»¯a cÃ¡c nÃºt */
        align-items: center;
    }

    /* CÃ¡c nÃºt Widget */
    .chat-widget {
        width: 55px;
        height: 55px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white !important;
        text-decoration: none;
        box-shadow: 0 4px 15px rgba(0,0,0,0.2);
        transition: transform 0.2s;
        position: relative; /* Äá»ƒ badge bÃ¡m theo */
    }
    .chat-widget:hover { transform: scale(1.1); }

    .live-chat-widget { background: linear-gradient(135deg, #A044FF, #6A00F4); }
    .zalo-widget { background: #0068FF; }
    .telegram-widget { background: #0088cc; }

    /* Badge Sá»‘ Äá» náº±m TRÃŠN nÃºt */
    .chat-badge-vip {
        position: absolute;
        top: -5px;
        right: -5px;
        background: #FF3B30;
        color: white;
        border-radius: 50%;
        width: 22px;
        height: 22px;
        font-size: 11px;
        font-weight: bold;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 2px solid white;
        animation: bounce 0.5s;
    }

    /* Chat Box Giao Diá»‡n */
    .live-chat-box {
        display: none;
        position: fixed;
        bottom: 100px;
        right: 30px; /* Tháº³ng hÃ ng vá»›i widget */
        width: 350px;
        height: 480px;
        background: #fff;
        border-radius: 15px;
        z-index: 10000000;
        flex-direction: column;
        overflow: hidden;
        border: 1px solid rgba(0,0,0,0.1);
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
    }

    .chat-header {
        background: linear-gradient(135deg, #A044FF, #6A00F4);
        padding: 15px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .chat-body {
        flex: 1;
        padding: 15px;
        background: #f4f6f8;
        overflow-y: auto;
        display: flex;
        flex-direction: column;
        gap: 10px;
    }
    .chat-footer {
        padding: 12px;
        background: white;
        border-top: 1px solid #eee;
        display: flex;
        gap: 8px;
    }
    #chat-input {
        flex: 1;
        border: 1px solid #ddd;
        border-radius: 20px;
        padding: 8px 15px;
        font-size: 14px;
        outline: none;
    }
    #chat-input:focus { border-color: #A044FF; }
    #send-btn {
        background: none; border: none; color: #A044FF; font-size: 20px; cursor: pointer;
    }

    /* Tin Nháº¯n */
    .message {
        max-width: 80%;
        padding: 8px 12px;
        border-radius: 15px;
        font-size: 14px;
        line-height: 1.4;
        position: relative;
        word-wrap: break-word;
    }
    .message.me {
        align-self: flex-end;
        background: #A044FF; /* MÃ u tÃ­m cá»§a Client */
        color: white;
        border-bottom-right-radius: 2px;
    }
    .message.other {
        align-self: flex-start;
        background: white; /* MÃ u tráº¯ng cho Admin */
        color: #333; /* Chá»¯ Ä‘en */
        border: 1px solid #eee;
        border-bottom-left-radius: 2px;
    }
    .message .time {
        display: block;
        font-size: 10px;
        margin-top: 4px;
        opacity: 0.7;
        text-align: right;
    }
    
    /* áº¨n tooltip máº·c Ä‘á»‹nh, hiá»‡n khi hover */
    .chat-tooltip {
        position: absolute; right: 65px; background: rgba(0,0,0,0.7); 
        color: white; padding: 4px 8px; border-radius: 4px; font-size: 12px;
        opacity: 0; pointer-events: none; white-space: nowrap; transition: 0.2s;
    }
    .chat-widget:hover .chat-tooltip { opacity: 1; right: 70px; }

    @keyframes bounce { 0% { transform: scale(0); } 80% { transform: scale(1.2); } 100% { transform: scale(1); } }
    </style>


    <style>
    .contact-widgets-container {
        position: fixed;
        bottom: 30px;
        right: 30px;
        z-index: 9999999 !important;
        display: flex;
        flex-direction: column;
        align-items: center;
        pointer-events: auto; /* Äáº£m báº£o click Ä‘Æ°á»£c */
    }

    .chat-widget {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        text-decoration: none !important;
        transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        border: 2px solid rgba(255,255,255,0.2);
        position: relative; 
    }

    .telegram-widget {
        background: linear-gradient(135deg, #0088cc, #005f8f);
        box-shadow: 0 0 20px rgba(0, 136, 204, 0.6);
    }

    .zalo-widget {
        background: linear-gradient(135deg, #0068FF, #0041a3);
        box-shadow: 0 0 20px rgba(0, 104, 255, 0.6);
    }

    .chat-widget:hover {
        transform: scale(1.1);
    }

    .telegram-widget:hover {
        box-shadow: 0 0 30px rgba(0, 136, 204, 0.8);
    }

    .zalo-widget:hover {
        box-shadow: 0 0 30px rgba(0, 104, 255, 0.8);
    }

    .chat-tooltip {
        position: absolute;
        right: 70px;
        background: rgba(255,255,255,0.1);
        backdrop-filter: blur(5px);
        padding: 5px 15px;
        border-radius: 20px;
        color: white;
        font-size: 14px;
        white-space: nowrap;
        opacity: 0;
        transform: translateX(20px);
        transition: all 0.3s ease;
        pointer-events: none;
        border: 1px solid rgba(255,255,255,0.1);
    }

    .chat-widget:hover .chat-tooltip {
        opacity: 1;
        transform: translateX(0);
    }
    </style>
</body>

</html>




