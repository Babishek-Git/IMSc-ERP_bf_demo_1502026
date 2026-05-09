<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\Importable;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Events\BeforeSheet;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;

class UsersImport implements  ToCollection, WithEvents, WithCalculatedFormulas
{
    /**
    * @param Collection $collection
    */
    // public function collection(Collection $collection)
    // {
    //    dd($collection);
    // }

    use Importable;

    public $sheetNames;
    public $sheetData;

    public function __construct()
    {
        $this->sheetNames = [];
        $this->sheetData = [];
    }

    public function collection(Collection $collection)
    {
        $this->sheetData[] = $collection;
        //foreach($collection as $key => $value){
           // echo $value."<br/>";
           //$this->sheetData[] = $value;
        //}
        //dd($collection);
       // exit;
    }

    public function registerEvents(): array
    {
        return [
            BeforeSheet::class => function (BeforeSheet $event) {
                $this->sheetNames[] = $event->getSheet()->getDelegate()->getTitle();
            }
        ];
    }
}
