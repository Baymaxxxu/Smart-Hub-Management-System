@extends('layouts.app')

@section('content')
    <h1>Data Equipment</h1>

    @if (session('success'))
        <div class="alert">{{ session('success') }}</div>
    @endif

    <a href="/web/equipment/create" class="btn">Tambah Equipment</a>

    <br><br>

    <div class="card">
        <table>
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Kode</th>
                    <th>Kategori</th>
                    <th>Kondisi</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($equipment as $item)
                    <tr>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->code }}</td>
                        <td>{{ $item->category }}</td>
                        <td>{{ $item->condition }}</td>
                        <td>{{ $item->status }}</td>
                        <td>
                            <a href="/web/equipment/{{ $item->id }}/edit" class="btn btn-warning">Edit</a>

                            <form action="/web/equipment/{{ $item->id }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" onclick="return confirm('Hapus equipment ini?')">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach

                @if ($equipment->isEmpty())
                    <tr>
                        <td colspan="6">Belum ada data equipment.</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
@endsection