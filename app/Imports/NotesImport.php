<?php

namespace App\Imports;

use App\Models\Notes;
use Maatwebsite\Excel\Concerns\ToModel;

class NotesImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Notes([
         'id'     => $row[0],
         'name'    => $row[1],
         'administrator'     => $row[2],
         'urlCode'    => $row[3],
         'email'     => $row[4],
         'video'    => $row[5]
        ]);
    }
}
