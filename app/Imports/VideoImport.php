<?php

namespace App\Imports;

use App\Models\Dissections;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
//use Illuminate\Support\Collection;
//use Maatwebsite\Excel\Concerns\ToCollection;

class VideoImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        //return an eloquent object
        return new Dissections([
        'name' => $row['name'],
        'administrator' => $row['administrator'],
        'email' => $row['email'],
        'video' => $row['video'],
        'created_at' => $row['created_at'],
        'updated_at' => $row['updated_at'],
        'category_id' => $row['category_id']
        ]);
        $this->data->push($model);
        return $model;
    }
}
