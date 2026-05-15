@extends('layouts.app')

@section('content')
    <h1>Jadwal Peminjaman</h1>

    @if (session('success'))
        <div class="alert">{{ session('success') }}</div>
    @endif

    <a href="/web/borrowings/create" class="btn">Tambah Jadwal</a>

    <br><br>

    <div class="card">
        <table>
            <thead>
                <tr>
                    <th>Peminjam</th>
                    <th>Equipment</th>
                    <th>Room</th>
                    <th>Mulai</th>
                    <th>Selesai</th>
                    <th>Status</th>
                    <th>Catatan</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($borrowings as $borrowing)
                    <tr>
                        <td>{{ $borrowing->user->name ?? '-' }}</td>
                        <td>{{ $borrowing->equipment->name ?? '-' }}</td>
                        <td>{{ $borrowing->room->name ?? '-' }}</td>
                        <td>{{ $borrowing->start_time }}</td>
                        <td>{{ $borrowing->end_time }}</td>
                        <td>{{ $borrowing->status }}</td>
                        <td>{{ $borrowing->notes ?? '-' }}</td>
                        <td>
                            <a href="/web/borrowings/{{ $borrowing->id }}/edit" class="btn btn-warning">
                                Edit
                            </a>

                            <form action="/web/borrowings/{{ $borrowing->id }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')

                                <button class="btn btn-danger" onclick="return confirm('Hapus jadwal peminjaman ini?')">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach

                @if ($borrowings->isEmpty())
                    <tr>
                        <td colspan="8">Belum ada jadwal peminjaman.</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
@endsection