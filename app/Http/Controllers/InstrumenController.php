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
        return view('instrumen', ['data' => $data]);
    }
}
