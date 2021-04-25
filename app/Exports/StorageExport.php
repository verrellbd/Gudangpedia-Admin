<?php

namespace App\Exports;

use App\Storage;
use Maatwebsite\Excel\Concerns\FromCollection;

class StorageExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Storage::all();
    }
}
