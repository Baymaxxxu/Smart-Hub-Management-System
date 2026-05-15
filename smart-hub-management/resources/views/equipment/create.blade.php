@extends('layouts.app')

@section('content')
    <h1>Tambah Equipment</h1>

    @if ($errors->any())
        <div class="error">
            Data belum valid. Silakan cek kembali.
        </div>
    @endif

    <div class="card">
        <form method="POST" action="/web/equipment">
            @csrf

            <label>Nama Equipment</label>
            <input type="text" name="name" value="{{ old('name') }}" required>

            <label>Kode</label>
            <input type="text" name="code" value="{{ old('code') }}" required>

            <label>Kategori</label>
            <input type="text" name="category" value="{{ old('category') }}" required>

            <label>Kondisi</label>
            <select name="condition" required>
                <option value="good">Good</option>
                <option value="damaged">Damaged</option>
                <option value="maintenance">Maintenance</option>
            </select>

            <label>Status</label>
            <select name="status" required>
                <option value="available">Available</option>
                <option value="borrowed">Borrowed</option>
                <option value="checked_in">Checked In</option>
            </select>

            <label>Deskripsi</label>
            <textarea name="description">{{ old('description') }}</textarea>

            <button class="btn" type="submit">Simpan</button>
        </form>
    </div>
@endsection