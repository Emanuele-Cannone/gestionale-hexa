<?php

namespace App\Http\Controllers;

use App\Exceptions\QuestionException;
use App\Exports\RosterExampleImport;
use App\Http\Requests\RosterStoreRequest;
use App\Models\Roster;
use App\Services\RosterService;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Redirect;

class RosterController extends Controller
{
    protected $rosterService;

    public function __construct()
    {
        $this->rosterService = new RosterService();
        // $this->authorizeResource(Roster::class, 'roster');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $rosters = Roster::where('date', '>', Carbon::now()->subMonth(4))
            ->get()
            ->mapWithKeys( function (object $rosters, int $key) {
                return [
                    $key => [
                        'id' => $rosters->id,
                        'title' => $rosters->user->name . ' - ' . $rosters->proof->name,
                        'start' => $rosters->date . ' ' . $rosters->from,
                        'end' => $rosters->date . ' ' . $rosters->to,
                        'user_id' => $rosters->user_id,
                        'user_name' => $rosters->user->name,
                        'color' => 'green' // qui controllo la timbratura
                    ]
                ];
            });

        // creo il periodo temporale in base al numero della settimana corrente
        $today = Carbon::now();

        $weeksOfYearAvailable = collect($today)->times(52, function (int $weeksOfYear) {
            return $weeksOfYear;
        });

        return view('rosters.index',
            [
                'weeksOfYearAvailable' => $weeksOfYearAvailable->all(),
                'rosters' => $rosters,
                'currentWeekOfYear' => $today->weekOfYear,
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
        return (new RosterExampleImport($request->weekNumber))->download('turni-' . $request->weekNumber . '.xlsx');
    }

    public function importRosterFile(RosterStoreRequest $rosterStoreRequest)
    {
        $pattern = '/^turni-(?:[1-9]|[1-4][0-9]|52)$/i';

        $str = pathinfo($rosterStoreRequest->file('rosterFile')->getClientOriginalName(), PATHINFO_FILENAME);

        throw_unless(preg_match($pattern, $str), new QuestionException);

        $arrayRosterWeek = explode('-', pathinfo($rosterStoreRequest->file('rosterFile')->getClientOriginalName(), PATHINFO_FILENAME));

        $weekOfYear = $arrayRosterWeek[1];

        $this->rosterService->rosterImport($weekOfYear, $rosterStoreRequest->file('rosterFile'));

        return Redirect::route('rosters.index');
    }
}
