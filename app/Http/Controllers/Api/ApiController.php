<?php

namespace App\Http\Controllers\Api;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApiController extends Controller
{
  public function apiDistribusi(Request $request, $nomor)
  {
    $tahun = $request->tahun;
    $bulan = $request->bulan;
    $customers = Customer::where('dma', 'like', $nomor . '%')->where('tahun', $tahun)->where('nama_bln', $bulan)->get();
    $distribusi = [];
    $distribusi['total_stan_awal'] = 0;
    $distribusi['total_stan_akhir'] = 0;
    $distribusi['total_kubik'] = 0;

    // calculate stan_awal, stan_akhir and kubik
    foreach ($customers as $customer) {
      $distribusi['total_stan_awal'] += $customer['stan_awal'];
      $distribusi['total_stan_akhir'] += $customer['stan_akhir'];
      $distribusi['total_kubik'] += $customer['kubik'];
    }
    // calculate pakai
    $distribusi['pakai'] = $distribusi['total_stan_akhir'] - $distribusi['total_stan_awal'];
    $distribusi['jumlah_pel'] = count($customers->unique('zona_norek'));
    return response()->json($distribusi);
  }
}
