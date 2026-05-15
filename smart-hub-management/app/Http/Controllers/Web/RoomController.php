<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = Room::latest()->get();

        return view('rooms.index', compact('rooms'));
    }

    public function create()
    {
        return view('rooms.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'capacity' => 'required|integer|min:1',
            'location' => 'required|string|max:255',
            'status' => 'required|in:available,booked,maintenance',
        ]);

        Room::create([
            'name' => $request->name,
            'capacity' => $request->capacity,
            'location' => $request->location,
            'status' => $request->status,
        ]);

        return redirect('/web/rooms')->with('success', 'Room berhasil ditambahkan.');
    }

    public function edit(string $id)
    {
        $room = Room::findOrFail($id);

        return view('rooms.edit', compact('room'));
    }

    public function update(Request $request, string $id)
    {
        $room = Room::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'capacity' => 'required|integer|min:1',
            'location' => 'required|string|max:255',
            'status' => 'required|in:available,booked,maintenance',
        ]);

        $room->update([
            'name' => $request->name,
            'capacity' => $request->capacity,
            'location' => $request->location,
            'status' => $request->status,
        ]);

        return redirect('/web/rooms')->with('success', 'Room berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $room = Room::findOrFail($id);
        $room->delete();

        return redirect('/web/rooms')->with('success', 'Room berhasil dihapus.');
    }
}