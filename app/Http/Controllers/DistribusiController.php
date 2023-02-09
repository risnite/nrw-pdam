<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Distribution;
use DateTime;
use DateTimeZone;
use Illuminate\Http\Request;

class DistribusiController extends Controller
{
    public function index(Request $request)
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
        }
        return view('distribusi.index', ['data' => $data]);
    }


    public function show(Request $request, $kode_instrument)
    {
        $data = [];
        // if DMA
        if (str_contains($request->nama_instrument, 'PC') && str_contains($request->nama_instrument, 'DMA')) {
            $data['nomor'] = $kode_instrument;
        }
        // if PC
        if (str_contains($request->nama_instrument, 'PC') && !str_contains($request->nama_instrument, 'DMA')) {
            $data['nomor'] = substr($request->kode_instrument, 0, 5);
        }
        // if Rayon
        if (str_contains($request->nama_instrument, 'Rayon')) {
            $data['nomor'] = substr($request->kode_instrument, 0, 2);
        }
        // if IPA
        if (str_contains($request->nama_instrument, 'IPA')) {
            $data['nomor'] = substr($request->kode_instrument, 0, 1);
        }
        $customers = Customer::select('tahun', 'nama_bln')->where('dma', 'like', $data['nomor'] . '%')->groupBy('tahun', 'nama_bln')->get();
        $data['nama'] = $request->nama_instrument;
        $data['tahun'] = [];
        $data['bulan'] = [];
        // get all years list
        foreach ($customers->unique('tahun') as $customer) {
            $tahun = $customer['tahun'];
            array_push($data['tahun'], $tahun);
        }
        // get all months list
        foreach ($customers->unique('nama_bln') as $customer) {
            $namaBulan = date_create_from_format('m', $customer['nama_bln'])->format('M');
            $bulan = $customer['nama_bln'];
            $data['bulan'][$bulan] = $namaBulan;
        }
        // write meter atasnya
        if (strlen($data['nomor']) == 1) {
            $data['meter_atasnya'] = '-';
        }
        if (strlen($data['nomor']) == 2) {
            $data['meter_atasnya'] = substr($data['nomor'], 0, 1);
        }
        if (strlen($data['nomor']) == 5) {
            $data['meter_atasnya'] = substr($data['nomor'], 0, 2);
        }
        if (strlen($data['nomor']) == 7) {
            $data['meter_atasnya'] = substr($data['nomor'], 0, 5);
        }
        $data['nrw_jaringan'] = $request->nrw_jaringan;
        $data['nrw_area'] = $request->nrw_area;
        return view('distribusi.show', ['data' => $data]);
    }
}
