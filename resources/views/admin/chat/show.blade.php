@extends('layouts.admin')
@section('title', 'Detail Chat')
@section('content')
<div class="container py-4">
    @include('components.admin-header')

    <div class="chatdetail-card">
        {{-- HEADER CHAT --}}
        <div class="chatdetail-head">
            <a href="/admin/chat" class="back-btn">
                <i class="bi bi-arrow-left"></i>
            </a>
            <div class="chatdetail-avatar">
                {{ strtoupper(substr($chat->user->name, 0, 1)) }}
            </div>
            <div class="chatdetail-userinfo">
                <h5 class="chatdetail-name">{{ $chat->user->name }}</h5>
                <small class="chatdetail-email">{{ $chat->user->email }}</small>
            </div>
        </div>

        {{-- ISI CHAT --}}
        <div class="chatdetail-body">
            @forelse($chat->messages as $message)
                @if($message->sender_role == 'user')
                    <div class="bubble-row bubble-row--left">
                        <div class="bubble bubble--user">
                            {{ $message->message }}
                            <div class="bubble-time bubble-time--user">
                                {{ $message->created_at->format('H:i') }}
                            </div>
                        </div>
                    </div>
                @else
                    <div class="bubble-row bubble-row--right">
                        <div class="bubble bubble--admin">
                            {{ $message->message }}
                            <div class="bubble-time bubble-time--admin">
                                {{ $message->created_at->format('H:i') }}
                            </div>
                        </div>
                    </div>
                @endif
            @empty
                <div class="chat-empty">
                    <div class="chat-empty__icon">
                        <i class="bi bi-chat-square-text"></i>
                    </div>
                    <p class="chat-empty__text">Belum ada pesan</p>
                </div>
            @endforelse
        </div>

        {{-- FORM BALAS --}}
        <div class="chatdetail-footer">
            <form action="/admin/chat/{{ $chat->id }}/send" method="POST" class="reply-form">
                @csrf
                <input
                    type="text"
                    name="message"
                    class="reply-input"
                    placeholder="Tulis balasan..."
                    required
                >
                <button type="submit" class="reply-send">
                    <i class="bi bi-send-fill"></i>
                </button>
            </form>
        </div>
    </div>
</div>

@include('components.tampilan-chatmin')
@endsection