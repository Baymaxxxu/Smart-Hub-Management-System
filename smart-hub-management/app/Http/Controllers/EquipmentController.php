<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use Illuminate\Http\Request;

class EquipmentController extends Controller
{
    public function index()
    {
        $equipment = Equipment::latest()->get();

        return response()->json([
            'success' => true,
            'message' => 'Data equipment berhasil diambil',
            'data' => $equipment
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:100|unique:equipment,code',
            'category' => 'required|string|max:255',
            'condition' => 'required|in:good,damaged,maintenance',
            'status' => 'required|in:available,borrowed,checked_in',
            'description' => 'nullable|string',
        ]);

        $equipment = Equipment::create([
            'name' => $request->name,
            'code' => $request->code,
            'category' => $request->category,
            'condition' => $request->condition,
            'status' => $request->status,
            'description' => $request->description,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Equipment berhasil ditambahkan',
            'data' => $equipment
        ], 201);
    }

    public function show(string $id)
    {
        $equipment = Equipment::find($id);

        if (! $equipment) {
            return response()->json([
                'success' => false,
                'message' => 'Equipment tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Detail equipment berhasil diambil',
            'data' => $equipment
        ]);
    }

    public function update(Request $request, string $id)
    {
        $equipment = Equipment::find($id);

        if (! $equipment) {
            return response()->json([
                'success' => false,
                'message' => 'Equipment tidak ditemukan'
            ], 404);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:100|unique:equipment,code,' . $equipment->id,
            'category' => 'required|string|max:255',
            'condition' => 'required|in:good,damaged,maintenance',
            'status' => 'required|in:available,borrowed,checked_in',
            'description' => 'nullable|string',
        ]);

        $equipment->update([
            'name' => $request->name,
            'code' => $request->code,
            'category' => $request->category,
            'condition' => $request->condition,
            'status' => $request->status,
            'description' => $request->description,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Equipment berhasil diperbarui',
            'data' => $equipment
        ]);
    }

    public function destroy(string $id)
    {
        $equipment = Equipment::find($id);

        if (! $equipment) {
            return response()->json([
                'success' => false,
                'message' => 'Equipment tidak ditemukan'
            ], 404);
        }

        $equipment->delete();

        return response()->json([
            'success' => true,
            'message' => 'Equipment berhasil dihapus'
        ]);
    }
}