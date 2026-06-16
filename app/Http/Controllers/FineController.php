<?php

namespace App\Http\Controllers;

use App\Models\Fine;
use Illuminate\Http\Request;

class FineController extends Controller
{
    public function index()
    {
        $fines = Fine::with('loan.member', 'loan.book')->get();
        return view('fines.index', compact('fines'));
    }

    public function pay(Fine $fine)
    {
        $fine->update(['status' => 'paid']);
        return redirect()->route('fines.index')->with('success', 'Denda berhasil dibayar!');
    }
}
