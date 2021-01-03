<?php

namespace App\Exports;

use App\Models\Publisher;
use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use Maatwebsite\Excel\Concerns\FromCollection;

class PublishersExport implements FromCollection, WithDrawings 
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $publisher = Publisher::all(['name', 'email', 'phone', 'address', 'description']);
        
        return $publisher;
    }

    public function drawings()
    {
        $drawing = new Drawing();
        $drawing->setName('Logo');
        $drawing->setDescription('This is my logo');
        $drawing->setPath(public_path('/upload/publisher/new_1.jpg'));
        $drawing->setHeight(90);
        $drawing->setCoordinates('B1');

        return $drawing;
    }
}
