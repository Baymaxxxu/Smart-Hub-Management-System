<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Equipment;
use App\Models\Room;
use App\Models\Borrowing;
use App\Models\Checkin;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.index', [
            'equipmentCount' => Equipment::count(),
            'roomCount' => Room::count(),
            'borrowingCount' => Borrowing::count(),
            'checkinCount' => Checkin::count(),
        ]);
    }
}