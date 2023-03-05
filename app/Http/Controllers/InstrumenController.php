<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Instrumen;
use App\Models\Instrument;
use Illuminate\Contracts\Pagination\Paginator;

class InstrumenController extends Controller
{
    public function index()
    {
        $data = Instrument::all();
        foreach ($data as $item) {
            $item->link = 'Ins' . $item->kode_instrumen;
        }
        return view('instrumen', ['data' => $data]);
    }
    public function sebaran()
    {
        $data = Instrument::select('kode_instrumen', 'nama_instrumen', 'tipe_instrumen', 'long', 'lat', 'kode_rayon', 'kode_pc', 'kode_dma')->get();
        return view('sebaran', ['data' => $data]);
    }
}
