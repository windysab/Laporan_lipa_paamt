<?php

// namespace App\Exports;

// use Illuminate\Contracts\View\View;
// use Maatwebsite\Excel\Concerns\FromView;
// use Maatwebsite\Excel\Concerns\Exportable;

// class Lipa1Export implements FromView
// {
//     use Exportable;

//     private $data;

//     public function __construct($data)
//     {

//         // dd($this->data);
//         $this->data = $data;
//         // dd($this->data);
//     }

//     public function view(): View
//     {
//          dd($this->data);
//         return view('excel.lipa1', ['result' => $this->data]);
//     }
// }

// namespace App\Exports;

// use App\Traits\PerkaraDataTrait;
// use Maatwebsite\Excel\Concerns\FromCollection;

// class Lipa1Export implements FromCollection
// {
//     use PerkaraDataTrait;

//     public function collection()
//     {
//         $lap_tahun = request()->lap_tahun;
//         $lap_bulan = request()->lap_bulan;
//         $jenis_perkara = request()->jenis_perkara;


//         return $this->getData($lap_tahun, $lap_bulan, $jenis_perkara);
//     }
// }


// app/Exports/Lipa1Export.php

// app/Exports/Lipa1Export.php

namespace App\Exports;

use Illuminate\Support\Collection;
use Illuminate\View\View;

use Maatwebsite\Excel\Concerns\FromCollection;

class Lipa1Export implements FromCollection
{
    private $data;

    public function __construct(Collection $data)
    {
        dd($this->data);
        $this->data = $data;
        dd($this->data);
    }

    public function collection()
    {
        return $this->data;
    }



    public function view(): View
    {
        return view('excel.lipa1', [
            'data' => $this->data,
        ]);
    }
}
