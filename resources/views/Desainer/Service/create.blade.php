@extends('layouts.app')

@section('content')

<h4>Tambah Jasa Desain</h4>

<form method="POST" action="/desainer/service">
@csrf

<div class="mb-3">
    <label>Judul Jasa</label>
    <input type="text" name="title" class="form-control" required>
</div>

<div class="mb-3">
    <label>Deskripsi</label>
    <textarea name="description" class="form-control" rows="4" required></textarea>
</div>

<div class="mb-3">
    <label>Harga</label>
    <input type="number" name="price" class="form-control" required>
</div>

<div class="mb-3">
    <label>Kategori</label>
    <select name="category_id" class="form-control" required>
        @foreach($categories as $c)
            <option value="{{ $c->id }}">{{ $c->name }}</option>
        @endforeach
    </select>
</div>

<button class="btn btn-success">Simpan</button>
<a href="/desainer/service" class="btn btn-secondary">Kembali</a>

</form>

@endsection
