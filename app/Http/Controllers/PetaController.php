<?php

namespace App\Http\Controllers;

use App\Models\Instrument;
use Illuminate\Http\Request;

class PetaController extends Controller
{
  public function ipa()
  {
    $data = Instrument::select('kode_instrumen', 'nama_instrumen', 'tipe_instrumen', 'long', 'lat', 'kode_rayon', 'kode_pc', 'kode_dma', 'polygon')->where('nama_instrumen', 'like', '% IPA %')->get();
    return view('peta.ipa', ['data' => $data]);
  }
  public function pc()
  {
    $data = Instrument::select('kode_instrumen', 'nama_instrumen', 'tipe_instrumen', 'long', 'lat', 'kode_rayon', 'kode_pc', 'polygon')->whereNotNull('kode_pc')->whereNull('kode_dma')->get();
    $pagination = $data->paginate(6);
    return view('peta.pc', ['data' => $data, 'pagination' => $pagination]);
  }
}
