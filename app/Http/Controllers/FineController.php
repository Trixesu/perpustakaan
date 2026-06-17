<?php

namespace App\Http\Controllers;

use App\Models\Fine;
use App\Models\Loan;
use Carbon\Carbon;

class FineController extends Controller
{
    public function index()
    {
        $today = Carbon::today();

        $lateLoans = Loan::with(['book', 'member', 'fine'])
            ->where('status', 'borrowed')
            ->whereDate('due_date', '<', $today)
            ->get();

        foreach ($lateLoans as $loan) {
            $dueDate = Carbon::parse($loan->due_date)->startOfDay();
            $daysLate = $dueDate->diffInDays($today);

            Fine::updateOrCreate(
                ['loan_id' => $loan->id],
                [
                    'days_late' => $daysLate,
                    'amount' => $daysLate * 1000,
                    'status' => $loan->fine->status ?? 'unpaid',
                ]
            );
        }

        $fines = Fine::with('loan.member', 'loan.book')->get();

        return view('fines.index', compact('fines'));
    }

    public function pay(Fine $fine)
    {
        $fine->update(['status' => 'paid']);

        return redirect()->route('fines.index')
            ->with('success', 'Denda berhasil dibayar!');
    }
}
