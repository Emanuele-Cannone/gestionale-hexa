<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Services\AttendanceService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class AttendanceController extends Controller
{
    public function __construct(readonly private AttendanceService $service)
    {
    }


    public function index()
    {

        // dd('ciao');
        $attendances = Attendance::where('user_id', Auth::id())
            ->orderByDesc('id')
            ->paginate(15);
        $activeAttendance = Attendance::where('user_id', Auth::id())
            ->whereNull('leave')
            ->exists();

        return view('attendances.index',
            [
                'attendances' => $attendances,
                'activeAttendance' => $activeAttendance,
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->service->create($request);

        return Redirect::route('attendances.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
