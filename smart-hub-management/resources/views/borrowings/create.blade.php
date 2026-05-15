@extends('layouts.app')

@section('content')
    <h1>Tambah Jadwal Peminjaman</h1>

    @if ($errors->any())
        <div class="error">
            Data belum valid. Pastikan peminjam, jadwal, dan minimal equipment atau room sudah dipilih.
        </div>
    @endif

    <div class="card">
        <form method="POST" action="/web/borrowings">
            @csrf

            <label>Peminjam</label>
            <select name="user_id" required>
                <option value="">-- Pilih Peminjam --</option>

                @foreach ($users as $user)
                    <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                        {{ $user->name }} - {{ $user->role }}
                    </option>
                @endforeach
            </select>

            <label>Equipment</label>
            <select name="equipment_id">
                <option value="">-- Tidak memilih equipment --</option>

                @foreach ($equipment as $item)
                    <option value="{{ $item->id }}" {{ old('equipment_id') == $item->id ? 'selected' : '' }}>
                        {{ $item->name }} - {{ $item->code }}
                    </option>
                @endforeach
            </select>

            <label>Room</label>
            <select name="room_id">
                <option value="">-- Tidak memilih room --</option>

                @foreach ($rooms as $room)
                    <option value="{{ $room->id }}" {{ old('room_id') == $room->id ? 'selected' : '' }}>
                        {{ $room->name }} - {{ $room->location }}
                    </option>
                @endforeach
            </select>

            <label>Waktu Mulai</label>
            <input type="datetime-local" name="start_time" value="{{ old('start_time') }}" required>

            <label>Waktu Selesai</label>
            <input type="datetime-local" name="end_time" value="{{ old('end_time') }}" required>

            <label>Status</label>
            <select name="status" required>
                <option value="pending">Pending</option>
                <option value="approved">Approved</option>
                <option value="rejected">Rejected</option>
                <option value="returned">Returned</option>
            </select>

            <label>Catatan</label>
            <textarea name="notes">{{ old('notes') }}</textarea>

            <button class="btn" type="submit">Simpan</button>
            <a href="/web/borrowings" class="btn btn-warning">Kembali</a>
        </form>
    </div>
@endsection