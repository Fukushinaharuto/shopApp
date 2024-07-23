<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\stock;

class StockController extends Controller
{
    public function index()
    {
        $stocks =Stock::paginate(6);

        return view('stocks', ['stocks' => $stocks]);
    }
}
