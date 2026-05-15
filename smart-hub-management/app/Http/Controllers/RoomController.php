<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = Room::latest()->get();

        return response()->json([
            'success' => true,
            'message' => 'Data room berhasil diambil',
            'data' => $rooms
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'capacity' => 'required|integer|min:1',
            'location' => 'required|string|max:255',
            'status' => 'required|in:available,booked,maintenance',
        ]);

        $room = Room::create([
            'name' => $request->name,
            'capacity' => $request->capacity,
            'location' => $request->location,
            'status' => $request->status,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Room berhasil ditambahkan',
            'data' => $room
        ], 201);
    }

    public function show(string $id)
    {
        $room = Room::find($id);

        if (! $room) {
            return response()->json([
                'success' => false,
                'message' => 'Room tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Detail room berhasil diambil',
            'data' => $room
        ]);
    }

    public function update(Request $request, string $id)
    {
        $room = Room::find($id);

        if (! $room) {
            return response()->json([
                'success' => false,
                'message' => 'Room tidak ditemukan'
            ], 404);
        }

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

        return response()->json([
            'success' => true,
            'message' => 'Room berhasil diperbarui',
            'data' => $room
        ]);
    }

    public function destroy(string $id)
    {
        $room = Room::find($id);

        if (! $room) {
            return response()->json([
                'success' => false,
                'message' => 'Room tidak ditemukan'
            ], 404);
        }

        $room->delete();

        return response()->json([
            'success' => true,
            'message' => 'Room berhasil dihapus'
        ]);
    }
}