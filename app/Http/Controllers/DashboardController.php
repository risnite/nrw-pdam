<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Distribution;

class DashboardController extends Controller
{
  public function index()
  {
    $data = Distribution::all();
    // dd($data->toArray());
    $inflowDma = [];
    $inflowPc = [];
    $inflowRayon = [];
    // calculate values
    foreach ($data as $entry) {
      $entry->rata_rata = round($entry->kubikase / $entry->jumlah_pelanggan);
      $entry->nrw_area = round((1 - ($entry->kubikase / $entry->inflow)) * 100, 2) . '%';
      // check if inside an IPA
      if (str_contains($entry->nama_instrument, 'IPA')) {
        $inflowRayon[$entry->kode_instrument] = 0;
      }
      // check if inside a Rayon
      if (str_contains($entry->nama_instrument, 'Rayon')) {
        $inflowPc[$entry->kode_instrument] = 0;
        // calculate total inflow rayon
        $inflowRayon[$entry->instrument_atasnya] += $entry->inflow;
      }
      // check if inside a PC
      if (str_contains($entry->nama_instrument, 'PC') && !str_contains($entry->nama_instrument, 'DMA')) {
        $inflowDma[$entry->kode_instrument] = 0;
        // calculate total inflow pc
        $inflowPc[$entry->instrument_atasnya] += $entry->inflow;
      }
      // calculate total inflow dma
      if (str_contains($entry->nama_instrument, 'PC') && str_contains($entry->nama_instrument, 'DMA')) {
        $inflowDma[$entry->instrument_atasnya] += $entry->inflow;
      }
    }
    // write the values
    foreach ($data as $entry) {
      // write PC values
      if (str_contains($entry->nama_instrument, 'PC') && !str_contains($entry->nama_instrument, 'DMA')) {
        $entry['total_inflow_dma'] = $inflowDma[$entry->kode_instrument];
        $entry['nrw_jaringan'] = round((1 - ($inflowDma[$entry->kode_instrument] / $entry->inflow)) * 100, 2) . '%';
      }
      // write Rayon values
      if (str_contains($entry->nama_instrument, 'Rayon')) {
        $entry['total_inflow_pc'] = $inflowPc[$entry->kode_instrument];
        $entry['nrw_jaringan'] = round((1 - ($inflowPc[$entry->kode_instrument] / $entry->inflow)) * 100, 2) . '%';
      }
      // write IPA values
      if (str_contains($entry->nama_instrument, 'IPA')) {
        $entry['total_inflow_ipa'] = $inflowRayon[$entry->kode_instrument];
        $entry['nrw_jaringan'] = round((1 - ($inflowRayon[$entry->kode_instrument] / $entry->inflow)) * 100, 2) . '%';
      }
      // write color values
      if ($entry->nrw_area < 20) {
        $entry['color'] = 'green';
      }
      if ($entry->nrw_area >= 25) {
        $entry['color'] = 'red';
      } else {
        $entry['color'] = 'yellow';
      }
    }
    return view('dashboard', ['data' => $data]);
  }
}
