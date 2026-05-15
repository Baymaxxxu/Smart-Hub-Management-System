<?php

namespace App\Http\Controllers;

use App\Models\Borrowing;
use Illuminate\Http\Request;

class BorrowingController extends Controller
{
    public function index()
    {
        $borrowings = Borrowing::with(['user', 'equipment', 'room'])
            ->latest()
            ->get();

        return response()->json([
            'success' => true,
            'message' => 'Data borrowing berhasil diambil',
            'data' => $borrowings
        ]);
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
            return response()->json([
                'success' => false,
                'message' => 'Pilih minimal equipment atau room untuk dipinjam'
            ], 422);
        }

        $borrowing = Borrowing::create([
            'user_id' => $request->user_id,
            'equipment_id' => $request->equipment_id,
            'room_id' => $request->room_id,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'status' => $request->status,
            'notes' => $request->notes,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Borrowing berhasil ditambahkan',
            'data' => $borrowing->load(['user', 'equipment', 'room'])
        ], 201);
    }

    public function show(string $id)
    {
        $borrowing = Borrowing::with(['user', 'equipment', 'room'])->find($id);

        if (! $borrowing) {
            return response()->json([
                'success' => false,
                'message' => 'Borrowing tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Detail borrowing berhasil diambil',
            'data' => $borrowing
        ]);
    }

    public function update(Request $request, string $id)
    {
        $borrowing = Borrowing::find($id);

        if (! $borrowing) {
            return response()->json([
                'success' => false,
                'message' => 'Borrowing tidak ditemukan'
            ], 404);
        }

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
            return response()->json([
                'success' => false,
                'message' => 'Pilih minimal equipment atau room untuk dipinjam'
            ], 422);
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

        return response()->json([
            'success' => true,
            'message' => 'Borrowing berhasil diperbarui',
            'data' => $borrowing->load(['user', 'equipment', 'room'])
        ]);
    }

    public function destroy(string $id)
    {
        $borrowing = Borrowing::find($id);

        if (! $borrowing) {
            return response()->json([
                'success' => false,
                'message' => 'Borrowing tidak ditemukan'
            ], 404);
        }

        $borrowing->delete();

        return response()->json([
            'success' => true,
            'message' => 'Borrowing berhasil dihapus'
        ]);
    }
}