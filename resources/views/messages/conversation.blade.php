@extends('layouts.app')

@section('title', 'Percakapan - Pesan')

@section('content')
<div class="container">
    <div class="d-flex align-items-center mb-4">
        <a href="{{ route('messages.index') }}" class="btn btn-outline-secondary me-3">
            <i class="fas fa-arrow-left me-2"></i>Kembali
        </a>
        <h2 class="mb-0">
            <i class="fas fa-comment me-2"></i>Chat dengan {{ $otherUser->name }}
        </h2>
    </div>

    <div class="card card-modern" style="height: 500px; overflow-y: auto;">
        <div class="card-body">
            @forelse($messages as $message)
                <div class="mb-3 {{ $message->from_user_id === Auth::id() ? 'text-end' : '' }}">
                    <div class="d-inline-block p-3 rounded"
                         style="max-width: 70%; background-color: {{ $message->from_user_id === Auth::id() ? '#007bff' : '#e9ecef' }}; color: {{ $message->from_user_id === Auth::id() ? 'white' : 'black' }};">
                        @if($message->type !== 'general')
                            <span class="badge" style="background-color: {{ $message->type === 'update_request' ? '#ff6b6b' : '#4c6ef5' }}">
                                {{ ucfirst(str_replace('_', ' ', $message->type)) }}
                            </span>
                            <hr class="my-2">
                        @endif
                        <p class="mb-0">{{ $message->message }}</p>
                        <small class="d-block mt-2" style="opacity: 0.8;">{{ $message->created_at->format('H:i') }}</small>
                    </div>
                </div>
            @empty
                <p class="text-center text-muted">Belum ada percakapan.</p>
            @endforelse
        </div>
    </div>

    <div class="card card-modern mt-3">
        <div class="card-body">
            <form action="{{ route('messages.store') }}" method="POST">
                @csrf
                <input type="hidden" name="to_user_id" value="{{ $otherUser->id }}">
                <div class="input-group">
                    <textarea name="message" class="form-control" placeholder="Ketik pesan Anda..." rows="3" required></textarea>
                    <button class="btn btn-primary" type="submit">
                        <i class="fas fa-paper-plane me-2"></i>Kirim
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .card-modern {
        border: none;
        border-radius: 20px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.08);
    }
</style>
@endsection
