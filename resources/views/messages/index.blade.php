@extends('layouts.app')

@section('title', 'Pesan & Notifikasi')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3 col-lg-2 px-0">
            <div class="card-modern sidebar-desainer">
                <div class="card-body p-4">
                    <h5 class="mb-4">
                        <i class="fas fa-envelope me-2"></i>Pesan
                    </h5>
                    <nav class="nav flex-column">
                        <a class="nav-link active" href="{{ route('messages.index') }}">
                            <i class="fas fa-inbox me-2"></i>Semua Pesan
                        </a>
                    </nav>
                </div>
            </div>
        </div>

        <div class="col-md-9 col-lg-10">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <div>
                    <h2 class="mb-0">
                        <i class="fas fa-envelope me-2"></i>Pesan & Notifikasi
                    </h2>
                    <small class="text-muted">Kelola semua percakapan Anda</small>
                </div>
                <button class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#newMessageModal">
                    <i class="fas fa-plus me-2"></i>Pesan Baru
                </button>
            </div>

            @if($messages->count() > 0)
                <div class="card card-modern">
                    <div class="list-group list-group-flush">
                        @foreach($messages as $message)
                            <a href="{{ route('messages.conversation', $message->from_user_id === Auth::id() ? $message->to_user_id : $message->from_user_id) }}"
                               class="list-group-item list-group-item-action {{ !$message->read && $message->to_user_id === Auth::id() ? 'bg-light' : '' }}">
                                <div class="d-flex w-100 justify-content-between align-items-start">
                                    <div>
                                        <h6 class="mb-1">
                                            @if($message->from_user_id === Auth::id())
                                                <i class="fas fa-arrow-right text-success me-2"></i>
                                            @else
                                                <i class="fas fa-arrow-left text-primary me-2"></i>
                                            @endif
                                            {{ $message->from_user_id === Auth::id() ? $message->toUser->name : $message->fromUser->name }}
                                        </h6>
                                        <p class="mb-1 text-muted">
                                            @if($message->type === 'update_request')
                                                <span class="badge bg-warning">Update Request</span>
                                            @elseif($message->type === 'notification')
                                                <span class="badge bg-info">Notifikasi</span>
                                            @endif
                                            {{ Str::limit($message->message, 80) }}
                                        </p>
                                    </div>
                                    <small class="text-muted ms-2">{{ $message->created_at->diffForHumans() }}</small>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            @else
                <div class="alert alert-info">
                    <i class="fas fa-info-circle me-2"></i>Belum ada pesan.
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Modal Pesan Baru -->
<div class="modal fade" id="newMessageModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none; color: white;">
                <h5 class="modal-title"><i class="fas fa-pen-fancy me-2"></i>Pesan Baru</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('messages.store') }}" method="POST" id="newMessageForm">
                    @csrf

                    <div class="mb-4">
                        <label for="to_user_id" class="form-label fw-bold">
                            <i class="fas fa-user-circle me-2 text-primary"></i>Kirim Ke:
                        </label>
                        <select name="to_user_id" id="to_user_id" class="form-select form-select-lg" required>
                            <option value="">-- Pilih Penerima Pesan --</option>
                            @php
                                $allUsers = \App\Models\User::where('id', '!=', auth()->id())->get();
                            @endphp
                            @forelse($allUsers as $user)
                                <option value="{{ $user->id }}">
                                    {{ $user->name }} 
                                    <span class="text-muted">({{ ucfirst($user->role) }})</span>
                                </option>
                            @empty
                                <option value="" disabled>Tidak ada user tersedia</option>
                            @endforelse
                        </select>
                        <small class="form-text text-muted">Pilih user yang ingin Anda kirim pesan</small>
                    </div>

                    <div class="mb-4">
                        <label for="message" class="form-label fw-bold">
                            <i class="fas fa-comments me-2 text-primary"></i>Pesan:
                        </label>
                        <textarea name="message" id="message" class="form-control" rows="6" 
                                  placeholder="Tulis pesan Anda di sini..." required></textarea>
                        <small class="form-text text-muted">Pesan akan dikirim segera</small>
                    </div>

                    <div class="mb-4">
                        <label for="type" class="form-label fw-bold">
                            <i class="fas fa-tag me-2 text-primary"></i>Tipe Pesan (Opsional):
                        </label>
                        <select name="type" id="type" class="form-select">
                            <option value="general">📝 Pesan Umum</option>
                            <option value="update_request">🔄 Update Request</option>
                            <option value="notification">🔔 Notifikasi</option>
                        </select>
                        <small class="form-text text-muted">Tipe pesan membantu penerima memahami prioritas</small>
                    </div>

                    <div class="alert alert-info">
                        <i class="fas fa-info-circle me-2"></i>
                        <strong>Catatan:</strong> Pesan Anda akan tersimpan dalam sistem dan kedua pihak dapat melihat riwayat percakapan.
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                            <i class="fas fa-times me-2"></i>Batal
                        </button>
                        <button type="submit" class="btn btn-primary" id="sendMessageBtn">
                            <i class="fas fa-paper-plane me-2"></i>Kirim Pesan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    .card-modern {
        border: none;
        border-radius: 20px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        margin-bottom: 2rem;
    }

    .sidebar-desainer {
        position: sticky;
        top: 20px;
    }
</style>
@endsection
