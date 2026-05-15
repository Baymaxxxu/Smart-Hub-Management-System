@extends('layouts.app')

@section('content')
    <h1>Tambah Room</h1>

    @if ($errors->any())
        <div class="error">
            Data belum valid. Silakan cek kembali.
        </div>
    @endif

    <div class="card">
        <form method="POST" action="/web/rooms">
            @csrf

            <label>Nama Room</label>
            <input type="text" name="name" value="{{ old('name') }}" required>

            <label>Kapasitas</label>
            <input type="number" name="capacity" value="{{ old('capacity') }}" required min="1">

            <label>Lokasi</label>
            <input type="text" name="location" value="{{ old('location') }}" required>

            <label>Status</label>
            <select name="status" required>
                <option value="available">Available</option>
                <option value="booked">Booked</option>
                <option value="maintenance">Maintenance</option>
            </select>

            <button class="btn" type="submit">Simpan</button>
            <a href="/web/rooms" class="btn btn-warning">Kembali</a>
        </form>
    </div>
@endsection