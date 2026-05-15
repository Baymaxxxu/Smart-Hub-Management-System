<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Borrowing;
use App\Models\Equipment;
use App\Models\Room;
use App\Models\User;
use Illuminate\Http\Request;

class BorrowingController extends Controller
{
    public function index()
    {
        $borrowings = Borrowing::with(['user', 'equipment', 'room'])
            ->latest()
            ->get();

        return view('borrowings.index', compact('borrowings'));
    }

    public function create()
    {
        $users = User::all();
        $equipment = Equipment::all();
        $rooms = Room::all();

        return view('borrowings.create', compact('users', 'equipment', 'rooms'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'equipment_id' => 'nullable|exists:equipment,id',
            'room_id' => 'nullable|exists:rooms,id',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
            'status' => 'required|in:pending,approved,rejected,returned',
            'notes' => 'nullable|string',
        ]);

        if (! $request->equipment_id && ! $request->room_id) {
            return back()
                ->withErrors(['item' => 'Pilih minimal equipment atau room.'])
                ->withInput();
        }

        Borrowing::create([
            'user_id' => $request->user_id,
            'equipment_id' => $request->equipment_id,
            'room_id' => $request->room_id,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'status' => $request->status,
            'notes' => $request->notes,
        ]);

        return redirect('/web/borrowings')->with('success', 'Jadwal peminjaman berhasil ditambahkan.');
    }

    public function edit(string $id)
    {
        $borrowing = Borrowing::findOrFail($id);
        $users = User::all();
        $equipment = Equipment::all();
        $rooms = Room::all();

        return view('borrowings.edit', compact('borrowing', 'users', 'equipment', 'rooms'));
    }

    public function update(Request $request, string $id)
    {
        $borrowing = Borrowing::findOrFail($id);

        $request->validate([
            'user_id' => 'required|exists:users,id',
            'equipment_id' => 'nullable|exists:equipment,id',
            'room_id' => 'nullable|exists:rooms,id',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
            'status' => 'required|in:pending,approved,rejected,returned',
            'notes' => 'nullable|string',
        ]);

        if (! $request->equipment_id && ! $request->room_id) {
            return back()
                ->withErrors(['item' => 'Pilih minimal equipment atau room.'])
                ->withInput();
        }

        $borrowing->update([
            'user_id' => $request->user_id,
            'equipment_id' => $request->equipment_id,
            'room_id' => $request->room_id,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'status' => $request->status,
            'notes' => $request->notes,
        ]);

        return redirect('/web/borrowings')->with('success', 'Jadwal peminjaman berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $borrowing = Borrowing::findOrFail($id);
        $borrowing->delete();

        return redirect('/web/borrowings')->with('success', 'Jadwal peminjaman berhasil dihapus.');
    }
}