<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Instrument;

class HomeController extends Controller
{
  public function index()
  {
    $data = Instrument::select('kode_instrumen', 'nama_instrumen', 'tipe_instrumen', 'long', 'lat', 'kode_rayon', 'kode_pc', 'kode_dma')->get();
    return view('home', ['data' => $data]);
  }
}
