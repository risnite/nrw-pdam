<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Distribution;
use Illuminate\Contracts\Pagination\Paginator;

class DistribusiController extends Controller
{
    public function index()
    {
        // $data1 = Distribution::groupBy('PC')->get();
        $data = Distribution::all()->groupBy('PC')->sortKeys();
        foreach ($data as $key => $entries) {
            $jumlah_pelanggan = count($entries->unique('NAMA_PEL'));
            $stan_awal = 0;
            $stan_akhir = 0;
            foreach ($entries as $entry) {
                $stan_awal += $entry['STAN_AWAL'];
                $stan_akhir += $entry['STAN_AKIR'];
            }
            $data[$key]['stan_awal'] = $stan_awal;
            $data[$key]['stan_akhir'] = $stan_akhir;
            $data[$key]['pakai'] = $stan_akhir - $stan_awal;
            $data[$key]['jumlah_pelanggan'] = $jumlah_pelanggan;
        }
        // $total = count($data);
        // $per_page = 1;
        // $current_page = $request->input('page') ?? 1;
        // $paginatedData = new Paginator();
        // dd($data->toArray());
        // dd($data1);
        // dd($data[25066][0]['STAN_AWAL']);
        return view('distribusi', ['data' => $data]);
    }
}
