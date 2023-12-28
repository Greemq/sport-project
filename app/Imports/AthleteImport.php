<?php

namespace App\Imports;

use App\Models\Athlete;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class AthleteImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        foreach($rows as $row) {
            // [0] – ID
            // [2] – ФИО
            // [19] – Локация
            if (isset($row[0]) && isset($row[2]) && isset($row[19])) {
                $personal_id = $row[0];

                if ($personal_id > 0 && $personal_id <= 9) {
                    $personal_id = "000" . $personal_id;
                }
                else if ($personal_id > 9 && $personal_id <= 99) {
                    $personal_id = "00" . $personal_id;
                }
                else if ($personal_id > 99 && $personal_id <= 999) {
                    $personal_id = "0" . $personal_id;
                }

                $athlete = Athlete::create([
                    "fio" => $row[2],
                    "location" => $row[19],
                    "personal_id" => $personal_id,
                    "category" => "–",
                    "file" => "–",
                    "type" => "1",
                    "class" => "–",
                    // "accepted" => true,
                ]);
            }
            
        }
    }
}
