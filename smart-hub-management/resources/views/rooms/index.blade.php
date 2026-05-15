@extends('layouts.app')

@section('content')
    <h1>Data Rooms</h1>

    @if (session('success'))
        <div class="alert">{{ session('success') }}</div>
    @endif

    <a href="/web/rooms/create" class="btn">Tambah Room</a>

    <br><br>

    <div class="card">
        <table>
            <thead>
                <tr>
                    <th>Nama Room</th>
                    <th>Kapasitas</th>
                    <th>Lokasi</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($rooms as $room)
                    <tr>
                        <td>{{ $room->name }}</td>
                        <td>{{ $room->capacity }} orang</td>
                        <td>{{ $room->location }}</td>
                        <td>{{ $room->status }}</td>
                        <td>
                            <a href="/web/rooms/{{ $room->id }}/edit" class="btn btn-warning">Edit</a>

                            <form action="/web/rooms/{{ $room->id }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" onclick="return confirm('Hapus room ini?')">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach

                @if ($rooms->isEmpty())
                    <tr>
                        <td colspan="5">Belum ada data room.</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
@endsection