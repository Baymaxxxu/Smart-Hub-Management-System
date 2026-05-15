@extends('layouts.app')

@section('content')
    <h1>Dashboard Admin</h1>
    <p>Ringkasan data Smart-Hub Management System.</p>

    <div class="grid">
        <div class="card">
            <div>Total Equipment</div>
            <div class="stat">{{ $equipmentCount }}</div>
        </div>

        <div class="card">
            <div>Total Rooms</div>
            <div class="stat">{{ $roomCount }}</div>
        </div>

        <div class="card">
            <div>Total Borrowings</div>
            <div class="stat">{{ $borrowingCount }}</div>
        </div>

        <div class="card">
            <div>Total Check-ins</div>
            <div class="stat">{{ $checkinCount }}</div>
        </div>
    </div>
@endsection