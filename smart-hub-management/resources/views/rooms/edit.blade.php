@extends('layouts.app')

@section('content')
    <h1>Edit Room</h1>

    @if ($errors->any())
        <div class="error">
            Data belum valid. Silakan cek kembali.
        </div>
    @endif

    <div class="card">
        <form method="POST" action="/web/rooms/{{ $room->id }}">
            @csrf
            @method('PUT')

            <label>Nama Room</label>
            <input type="text" name="name" value="{{ old('name', $room->name) }}" required>

            <label>Kapasitas</label>
            <input type="number" name="capacity" value="{{ old('capacity', $room->capacity) }}" required min="1">

            <label>Lokasi</label>
            <input type="text" name="location" value="{{ old('location', $room->location) }}" required>

            <label>Status</label>
            <select name="status" required>
                <option value="available" {{ $room->status == 'available' ? 'selected' : '' }}>Available</option>
                <option value="booked" {{ $room->status == 'booked' ? 'selected' : '' }}>Booked</option>
                <option value="maintenance" {{ $room->status == 'maintenance' ? 'selected' : '' }}>Maintenance</option>
            </select>

            <button class="btn" type="submit">Update</button>
            <a href="/web/rooms" class="btn btn-warning">Kembali</a>
        </form>
    </div>
@endsection