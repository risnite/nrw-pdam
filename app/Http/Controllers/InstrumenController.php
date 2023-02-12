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
        $data = Instrument::select('tipe_instrumen', 'long', 'lat')->get();
        return view('sebaran', ['data' => $data]);
    }
}
