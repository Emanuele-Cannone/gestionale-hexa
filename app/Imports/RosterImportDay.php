<?php

namespace App\Imports;

use App\DTOs\RosterDTO;
use App\Models\Proof;
use App\Models\Roster;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class RosterImportDay implements SkipsEmptyRows, ToCollection, WithChunkReading
{
    protected $weekDay;

    public function __construct(string $weekDay)
    {
        $this->weekDay = $weekDay;

    }

    public function collection(Collection $collection)
    {

        $arrayRoster = $collection->toArray();

        $arrayColumns = $arrayRoster[0];

        foreach ($arrayRoster as $key => $rosterDay) {

            if ($key != 0) {

                $newRoster = array_combine($arrayColumns, $rosterDay);

                for ($i = 3; $i < 10; $i++) {

                    $arrayRosterDay = explode('-', $newRoster[$arrayColumns[$i]]);

                    $proof = Proof::where('name', $rosterDay[2])->pluck('id')->toArray();

                    if ($arrayRosterDay) {

                        $data = [
                            'date' => $arrayColumns[$i],
                            'user_id' => $rosterDay[0],
                            'proof_id' => (int) $proof[0],
                            'from' => Carbon::createFromFormat('H:i', $arrayRosterDay[0])->format('H:i:s'),
                            'to' => Carbon::createFromFormat('H:i', $arrayRosterDay[1])->format('H:i:s'),
                        ];

                        if ($data['from'] < $data['to']) {

                            $validatedRosterDto = RosterDTO::fromArray($data);

                            Roster::UpdateOrCreate([
                                'date' => $validatedRosterDto->date,
                                'user_id' => $validatedRosterDto->user_id,
                                'proof_id' => $validatedRosterDto->proof_id,
                                'from' => $validatedRosterDto->from,
                                'to' => $validatedRosterDto->to,
                            ],
                                ['user_id', 'date']
                            );

                        }

                    }

                }

            }

        }

    }

    public function chunkSize(): int
    {
        return 300;
    }
}
