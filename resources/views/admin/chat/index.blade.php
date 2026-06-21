@extends('layouts.admin')
@section('title', 'Chat Konsultasi')
@section('content')
<div class="container py-4">
    @include('components.admin-header')

    <div class="chatlist-card">
        <div class="chatlist-card__head">
            <div>
                <h5 class="chatlist-card__title">Daftar Percakapan</h5>
                <p class="chatlist-card__subtitle">Semua percakapan konsultasi dengan pengguna</p>
            </div>
            <span class="chatlist-count">{{ $chats->count() }} total</span>
        </div>

        <div class="chatlist-card__body">
            @forelse($chats as $chat)
                <div class="chat-row">
                    <a href="/admin/chat/{{ $chat->id }}" class="chat-row__avatar text-decoration-none">
                        {{ strtoupper(substr($chat->user->name, 0, 1)) }}
                    </a>

                    <a href="/admin/chat/{{ $chat->id }}" class="chat-row__info text-decoration-none">
                        <div class="chat-row__name">{{ $chat->user->name }}</div>
                        <div class="chat-row__email">{{ $chat->user->email }}</div>
                    </a>

                    <a href="/admin/chat/{{ $chat->id }}" class="chat-row__meta text-decoration-none">
                        <span class="msg-badge">{{ $chat->messages->count() }} pesan</span>
                    </a>

                    <a href="/admin/chat/{{ $chat->id }}" class="chat-row__action text-decoration-none">
                        <span class="open-btn">
                            Buka Chat
                            <i class="bi bi-chevron-right"></i>
                        </span>
                    </a>

                    <form action="/admin/chat/{{ $chat->id }}" method="POST"
                        onsubmit="return confirm('Hapus percakapan dengan {{ $chat->user->name }}?\n\nSemua pesan dalam percakapan ini akan ikut terhapus secara permanen dan tidak bisa dikembalikan.')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="delete-btn" title="Hapus percakapan">
                            <i class="bi bi-trash3"></i>
                        </button>
                    </form>
                </div>
            @empty
                <div class="chat-empty">
                    <div class="chat-empty__icon">
                        <i class="bi bi-chat-dots"></i>
                    </div>
                    <p class="chat-empty__text">Belum ada percakapan</p>
                </div>
            @endforelse
        </div>
    </div>
</div>

@include('components.tampilan-chatmin')
@endsection