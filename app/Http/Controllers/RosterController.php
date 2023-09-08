<?php

namespace App\Http\Controllers;

use App\Exceptions\QuestionException;
use App\Exports\RosterExampleImport;
use App\Http\Requests\RosterStoreRequest;
use App\Imports\RosterImport;
use App\Models\Roster;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Redirect;
use Maatwebsite\Excel\Facades\Excel;

class RosterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $data = Roster::where('date', '>', Carbon::now()->subMonth(6))
            ->with('proof')
            ->get();

        foreach ($data as $v) {

            $res[] = [
                'id' => $v->id,
                'title' => $v->user->name.' - '.$v->proof->name,
                'start' => $v->date.' '.$v->from,
                'end' => $v->date.' '.$v->to,
                'user_id' => $v->user_id,
            ];

        }

        // credo il periodo temporale in base al numero della settimana corrente
        $today = Carbon::now();
        $weeksOfYearAvailable = [];
        $currentWeekOfYear = $today->weekOfYear;

        for ($i = 1; $i < 53; $i++) {
            if ($i >= ($currentWeekOfYear - 4)) {
                $weeksOfYearAvailable[] = $i;
            }
        }

        return view('rosters.index',
            [
                'weeksOfYearAvailable' => $weeksOfYearAvailable,
                'res' => $res,
                'currentWeekOfYear' => $currentWeekOfYear,
            ],

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
        //
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

    public function downloadEmptyFile(Request $request)
    {
        return (new RosterExampleImport($request->weekNumber))->download('turni-'.$request->weekNumber.'.xlsx');
    }

    public function importRosterFile(RosterStoreRequest $rosterStoreRequest)
    {

        $pattern = '/^turni-(?:[1-9]|[1-4][0-9]|52)$/i';

        $str = pathinfo($rosterStoreRequest->file('rosterFile')->getClientOriginalName(), PATHINFO_FILENAME);

        throw_unless(preg_match($pattern, $str), new QuestionException);

        $arrayRosterWeek = explode('-', pathinfo($rosterStoreRequest->file('rosterFile')->getClientOriginalName(), PATHINFO_FILENAME));

        $rosterWeek = $arrayRosterWeek[1];

        Excel::import(new RosterImport($rosterWeek), $rosterStoreRequest->file('rosterFile'));

        return Redirect::route('rosters.index');
    }
}
