@extends('layouts.app')

@section('content')
    <h1>Edit Equipment</h1>

    @if ($errors->any())
        <div class="error">
            Data belum valid. Silakan cek kembali.
        </div>
    @endif

    <div class="card">
        <form method="POST" action="/web/equipment/{{ $equipment->id }}">
            @csrf
            @method('PUT')

            <label>Nama Equipment</label>
            <input type="text" name="name" value="{{ old('name', $equipment->name) }}" required>

            <label>Kode</label>
            <input type="text" name="code" value="{{ old('code', $equipment->code) }}" required>

            <label>Kategori</label>
            <input type="text" name="category" value="{{ old('category', $equipment->category) }}" required>

            <label>Kondisi</label>
            <select name="condition" required>
                <option value="good" {{ $equipment->condition == 'good' ? 'selected' : '' }}>Good</option>
                <option value="damaged" {{ $equipment->condition == 'damaged' ? 'selected' : '' }}>Damaged</option>
                <option value="maintenance" {{ $equipment->condition == 'maintenance' ? 'selected' : '' }}>Maintenance</option>
            </select>

            <label>Status</label>
            <select name="status" required>
                <option value="available" {{ $equipment->status == 'available' ? 'selected' : '' }}>Available</option>
                <option value="borrowed" {{ $equipment->status == 'borrowed' ? 'selected' : '' }}>Borrowed</option>
                <option value="checked_in" {{ $equipment->status == 'checked_in' ? 'selected' : '' }}>Checked In</option>
            </select>

            <label>Deskripsi</label>
            <textarea name="description">{{ old('description', $equipment->description) }}</textarea>

            <button class="btn" type="submit">Update</button>
        </form>
    </div>
@endsection