@extends('layouts.app')

@section('title', 'Layanan Konsultasi')

@section('content')

<div class="container py-4">

    {{-- HEADER USER --}}
    @include('components.header')

    {{-- JUDUL --}}
    <div class="consult-intro mb-4">
        <h3 class="consult-intro__title">
            <i class="bi bi-chat-dots me-2"></i>
            Layanan Konsultasi
        </h3>
        <p class="consult-intro__desc">
            Konsultasikan penggunaan aplikasi atau perkembangan berat badan Anda kepada admin.
        </p>
    </div>

    {{-- CHAT --}}
    <div class="consult-card">

        {{-- HEADER CHAT --}}
        <div class="consult-head">
            <div class="consult-head__avatar">A</div>
            <div class="consult-head__info">
                <div class="consult-head__name">Admin Tracker BB</div>
                <small class="consult-head__status">
                    <span class="status-dot"></span>
                    Siap membantu
                </small>
            </div>
        </div>

        {{-- ISI CHAT --}}
        <div class="chat-container">

            @if ($chat)

                @forelse ($chat->messages as $message)

                    @if ($message->sender_role == 'user')

                        {{-- USER --}}
                        <div class="bubble-row bubble-row--right">
                            <div class="bubble bubble--user">
                                {{ $message->message }}
                                <div class="bubble-time bubble-time--user">
                                    {{ $message->created_at->format('H:i') }}
                                </div>
                            </div>
                        </div>

                    @else

                        {{-- ADMIN --}}
                        <div class="bubble-row bubble-row--left">
                            <div class="bubble bubble--admin">
                                {{ $message->message }}
                                <div class="bubble-time bubble-time--admin">
                                    {{ $message->created_at->format('H:i') }}
                                </div>
                            </div>
                        </div>

                    @endif

                @empty

                    <div class="empty-chat">
                        <div class="empty-chat__icon">
                            <i class="bi bi-chat-square-text"></i>
                        </div>
                        <h5 class="empty-chat__title">Belum Ada Pesan</h5>
                        <p class="empty-chat__desc">Mulai percakapan dengan admin.</p>
                    </div>

                @endforelse

            @else

                <div class="empty-chat">
                    <div class="empty-chat__icon">
                        <i class="bi bi-chat-square-text"></i>
                    </div>
                    <h5 class="empty-chat__title">Belum Ada Percakapan</h5>
                    <p class="empty-chat__desc">Kirim pesan pertama untuk memulai konsultasi.</p>
                </div>

            @endif

        </div>

        {{-- FORM --}}
        <div class="consult-footer">
            <form action="/chat/send" method="POST" class="reply-form">
                @csrf
                <input
                    type="text"
                    name="message"
                    class="reply-input"
                    placeholder="Tulis pesan..."
                    required
                >
                <button type="submit" class="reply-send">
                    <i class="bi bi-send-fill"></i>
                </button>
            </form>
        </div>

    </div>

</div>

<style>
.consult-intro__title {
    font-weight: 700;
    color: #1a2233;
    margin-bottom: 4px;
}

.consult-intro__title i {
    color: #1ca3e0;
}

.consult-intro__desc {
    color: #8a93a3;
    margin: 0;
}

.consult-card {
    background: #ffffff;
    border: 1px solid #eef1f6;
    border-radius: 18px;
    box-shadow: 0 4px 24px rgba(20, 40, 80, 0.06);
    overflow: hidden;
}

.consult-head {
    display: flex;
    align-items: center;
    gap: 14px;
    padding: 18px 24px;
    border-bottom: 1px solid #eef1f6;
    background: #ffffff;
}

.consult-head__avatar {
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

.consult-head__name {
    font-weight: 700;
    font-size: 0.95rem;
    color: #1a2233;
}

.consult-head__status {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    color: #22b573;
    font-size: 0.8rem;
}

.status-dot {
    width: 7px;
    height: 7px;
    border-radius: 50%;
    background: #22b573;
    box-shadow: 0 0 0 3px rgba(34, 181, 115, 0.15);
}

.chat-container {
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
    word-wrap: break-word;
}

.bubble--admin {
    background: #ffffff;
    color: #1a2233;
    box-shadow: 0 2px 10px rgba(20, 40, 80, 0.06);
    border-bottom-left-radius: 4px;
}

.bubble--user {
    background: linear-gradient(135deg, #1ca3e0, #6366f1);
    color: #ffffff;
    box-shadow: 0 4px 14px rgba(28, 163, 224, 0.25);
    border-bottom-right-radius: 4px;
}

.bubble-time {
    font-size: 0.7rem;
    margin-top: 5px;
}

.bubble-time--admin {
    color: #aab2c0;
}

.bubble-time--user {
    color: rgba(255, 255, 255, 0.8);
}

.empty-chat {
    height: 100%;
    min-height: 450px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    text-align: center;
}

.empty-chat__icon {
    width: 56px;
    height: 56px;
    border-radius: 50%;
    background: #eef1f6;
    color: #c3cbd9;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.4rem;
    margin-bottom: 14px;
}

.empty-chat__title {
    color: #1a2233;
    font-weight: 700;
    font-size: 1rem;
    margin-bottom: 4px;
}

.empty-chat__desc {
    color: #8a93a3;
    font-size: 0.85rem;
    margin: 0;
}

.consult-footer {
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
    .chat-container {
        height: 420px;
    }
    .bubble {
        max-width: 85%;
    }
}
</style>

@endsection