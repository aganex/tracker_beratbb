{{--
    tampilan-chatmin.blade.php
    Shared styling for admin chat pages (Daftar Percakapan & Detail Chat).
    Include this once per page via:
    @include('components.tampilan-chatmin')
--}}
<style>
/* ===== Shared card shell ===== */
.chatlist-card,
.chatdetail-card {
    background: #ffffff;
    border: 1px solid #eef1f6;
    border-radius: 18px;
    box-shadow: 0 4px 24px rgba(20, 40, 80, 0.06);
    overflow: hidden;
}

/* ===== index.blade.php — Daftar Percakapan ===== */
.chatlist-card__head {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 22px 26px;
    border-bottom: 1px solid #eef1f6;
}

.chatlist-card__title {
    margin: 0;
    font-size: 1.05rem;
    font-weight: 700;
    color: #1a2233;
}

.chatlist-card__subtitle {
    margin: 2px 0 0;
    font-size: 0.82rem;
    color: #8a93a3;
}

.chatlist-count {
    font-size: 0.78rem;
    font-weight: 600;
    letter-spacing: .03em;
    color: #1ca3e0;
    background: linear-gradient(135deg, rgba(28,163,224,0.12), rgba(99,102,241,0.12));
    padding: 6px 14px;
    border-radius: 999px;
    white-space: nowrap;
}

.chatlist-card__body {
    display: flex;
    flex-direction: column;
}

.chat-row {
    display: grid;
    grid-template-columns: 44px 1fr auto auto auto;
    align-items: center;
    gap: 16px;
    padding: 16px 26px;
    text-decoration: none;
    color: inherit;
    border-bottom: 1px solid #f3f5f9;
    transition: background 0.15s ease;
}

.chat-row:last-child {
    border-bottom: none;
}

.chat-row:hover {
    background: #f8fafc;
}

.chat-row:hover .open-btn {
    background: linear-gradient(135deg, #1ca3e0, #6366f1);
    color: #fff;
}

.chat-row:hover .open-btn i {
    transform: translateX(2px);
}

.chat-row__avatar {
    width: 44px;
    height: 44px;
    border-radius: 50%;
    background: linear-gradient(135deg, #e8f4fc, #eef0fd);
    color: #1ca3e0;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 0.95rem;
    flex-shrink: 0;
}

.chat-row__info {
    min-width: 0;
}

.chat-row__name {
    font-weight: 600;
    font-size: 0.92rem;
    color: #1a2233;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.chat-row__email {
    font-size: 0.8rem;
    color: #8a93a3;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.msg-badge {
    font-size: 0.76rem;
    font-weight: 600;
    color: #5b6577;
    background: #f1f3f8;
    padding: 5px 12px;
    border-radius: 999px;
    white-space: nowrap;
}

.open-btn {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    font-size: 0.8rem;
    font-weight: 600;
    color: #1ca3e0;
    background: #eaf6fd;
    padding: 8px 14px;
    border-radius: 10px;
    white-space: nowrap;
    transition: all 0.15s ease;
}

.open-btn i {
    font-size: 0.7rem;
    transition: transform 0.15s ease;
}

.delete-btn {
    width: 36px;
    height: 36px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border: none;
    border-radius: 10px;
    background: #fde8e8;
    color: #d64545;
    font-size: 0.85rem;
    flex-shrink: 0;
    transition: background 0.15s ease, color 0.15s ease;
}

.delete-btn:hover {
    background: #d64545;
    color: #fff;
}

.chat-empty {
    text-align: center;
    padding: 60px 20px;
}

.chat-empty__icon {
    font-size: 1.8rem;
    color: #c3cbd9;
    margin-bottom: 10px;
}

.chat-empty__text {
    color: #8a93a3;
    font-size: 0.9rem;
    margin: 0;
}

@media (max-width: 576px) {
    .chat-row {
        grid-template-columns: 40px 1fr auto;
        grid-template-areas:
            "avatar info action"
            "meta meta action";
    }
    .chat-row__avatar { grid-area: avatar; }
    .chat-row__info { grid-area: info; }
    .chat-row__meta { grid-area: meta; }
    .chat-row__action { grid-area: action; }
    .delete-btn { grid-area: action; justify-self: end; }
}

/* ===== show.blade.php — Detail Chat ===== */
.chatdetail-head {
    display: flex;
    align-items: center;
    gap: 14px;
    padding: 18px 24px;
    border-bottom: 1px solid #eef1f6;
    background: #ffffff;
}

.back-btn {
    width: 36px;
    height: 36px;
    border-radius: 10px;
    background: #f1f3f8;
    color: #5b6577;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    text-decoration: none;
    transition: background 0.15s ease;
}

.back-btn:hover {
    background: #e6e9f0;
    color: #1a2233;
}

.chatdetail-avatar {
    width: 42px;
    height: 42px;
    border-radius: 50%;
    background: linear-gradient(135deg, #1ca3e0, #6366f1);
    color: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 0.95rem;
    flex-shrink: 0;
}

.chatdetail-userinfo {
    min-width: 0;
}

.chatdetail-name {
    margin: 0;
    font-weight: 700;
    font-size: 0.98rem;
    color: #1a2233;
}

.chatdetail-email {
    color: #8a93a3;
    font-size: 0.8rem;
}

.chatdetail-body {
    height: 500px;
    overflow-y: auto;
    padding: 24px;
    background:
        radial-gradient(circle at top right, rgba(28,163,224,0.04), transparent 50%),
        #f8fafc;
}

.bubble-row {
    display: flex;
    margin-bottom: 14px;
}

.bubble-row--left {
    justify-content: flex-start;
}

.bubble-row--right {
    justify-content: flex-end;
}

.bubble {
    max-width: 70%;
    padding: 12px 16px;
    border-radius: 16px;
    font-size: 0.9rem;
    line-height: 1.45;
}

.bubble--user {
    background: #ffffff;
    color: #1a2233;
    box-shadow: 0 2px 10px rgba(20, 40, 80, 0.06);
    border-bottom-left-radius: 4px;
}

.bubble--admin {
    background: linear-gradient(135deg, #1ca3e0, #6366f1);
    color: #ffffff;
    box-shadow: 0 4px 14px rgba(28, 163, 224, 0.25);
    border-bottom-right-radius: 4px;
}

.bubble-time {
    font-size: 0.7rem;
    margin-top: 5px;
}

.bubble-time--user {
    color: #aab2c0;
}

.bubble-time--admin {
    color: rgba(255, 255, 255, 0.8);
}

.chatdetail-footer {
    padding: 16px 20px;
    border-top: 1px solid #eef1f6;
    background: #ffffff;
}

.reply-form {
    display: flex;
    align-items: center;
    gap: 10px;
    background: #f1f3f8;
    border-radius: 14px;
    padding: 6px 6px 6px 16px;
}

.reply-input {
    flex: 1;
    border: none;
    background: transparent;
    outline: none;
    font-size: 0.9rem;
    color: #1a2233;
    padding: 10px 0;
}

.reply-input::placeholder {
    color: #aab2c0;
}

.reply-send {
    width: 40px;
    height: 40px;
    border: none;
    border-radius: 10px;
    background: linear-gradient(135deg, #1ca3e0, #6366f1);
    color: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    transition: opacity 0.15s ease;
}

.reply-send:hover {
    opacity: 0.9;
}

@media (max-width: 576px) {
    .chatdetail-body {
        height: 420px;
    }
    .bubble {
        max-width: 85%;
    }
}
</style>