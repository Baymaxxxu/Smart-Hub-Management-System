<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Equipment;
use Illuminate\Http\Request;

class EquipmentController extends Controller
{
    public function index()
    {
        $equipment = Equipment::latest()->get();

        return view('equipment.index', compact('equipment'));
    }

    public function create()
    {
        return view('equipment.create');
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

        Equipment::create([
            'name' => $request->name,
            'code' => $request->code,
            'category' => $request->category,
            'condition' => $request->condition,
            'status' => $request->status,
            'description' => $request->description,
        ]);

        return redirect('/web/equipment')->with('success', 'Equipment berhasil ditambahkan.');
    }

    public function edit(string $id)
    {
        $equipment = Equipment::findOrFail($id);

        return view('equipment.edit', compact('equipment'));
    }

    public function update(Request $request, string $id)
    {
        $equipment = Equipment::findOrFail($id);

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

        return redirect('/web/equipment')->with('success', 'Equipment berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $equipment = Equipment::findOrFail($id);
        $equipment->delete();

        return redirect('/web/equipment')->with('success', 'Equipment berhasil dihapus.');
    }
}