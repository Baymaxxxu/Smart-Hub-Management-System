<?php

namespace App\Http\Controllers;

use App\Models\Checkin;
use App\Models\Equipment;
use Illuminate\Http\Request;

class CheckinController extends Controller
{
    public function index()
    {
        $checkins = Checkin::with(['user', 'equipment'])
            ->latest()
            ->get();

        return response()->json([
            'success' => true,
            'message' => 'Data check-in berhasil diambil',
            'data' => $checkins
        ]);
    }

    public function checkin(Request $request)
    {
        $request->validate([
            'equipment_id' => 'required|exists:equipment,id',
        ]);

        $equipment = Equipment::find($request->equipment_id);

        if ($equipment->status === 'checked_in') {
            return response()->json([
                'success' => false,
                'message' => 'Equipment sedang digunakan atau sudah check-in'
            ], 422);
        }

        if ($equipment->status === 'maintenance') {
            return response()->json([
                'success' => false,
                'message' => 'Equipment sedang maintenance dan tidak dapat digunakan'
            ], 422);
        }

        $checkin = Checkin::create([
            'user_id' => $request->user()->id,
            'equipment_id' => $equipment->id,
            'checkin_time' => now(),
            'checkout_time' => null,
            'status' => 'checked_in',
        ]);

        $equipment->update([
            'status' => 'checked_in',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Check-in equipment berhasil',
            'data' => $checkin->load(['user', 'equipment'])
        ], 201);
    }

    public function checkout(Request $request)
    {
        $request->validate([
            'equipment_id' => 'required|exists:equipment,id',
        ]);

        $checkin = Checkin::where('equipment_id', $request->equipment_id)
            ->where('status', 'checked_in')
            ->latest()
            ->first();

        if (! $checkin) {
            return response()->json([
                'success' => false,
                'message' => 'Data check-in aktif tidak ditemukan'
            ], 404);
        }

        $checkin->update([
            'checkout_time' => now(),
            'status' => 'checked_out',
        ]);

        $equipment = Equipment::find($request->equipment_id);

        $equipment->update([
            'status' => 'available',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Check-out equipment berhasil',
            'data' => $checkin->load(['user', 'equipment'])
        ]);
    }
}