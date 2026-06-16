<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\Book;
use App\Models\Member;
use App\Models\Fine;
use Illuminate\Http\Request;
use Carbon\Carbon;

class LoanController extends Controller
{
    public function index()
    {
        $loans = Loan::with(['book', 'member'])->get();
        return view('loans.index', compact('loans'));
    }

    public function create()
    {
        $books = Book::where('stock', '>', 0)->get();
        $members = Member::all();
        return view('loans.create', compact('books', 'members'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'book_id'   => 'required|exists:books,id',
            'member_id' => 'required|exists:members,id',
            'loan_date' => 'required|date',
            'due_date'  => 'required|date|after:loan_date',
        ]);

        $book = Book::findOrFail($request->book_id);
        $book->decrement('stock');

        Loan::create($request->all());
        return redirect()->route('loans.index')->with('success', 'Peminjaman berhasil dicatat!');
    }

    public function return(Loan $loan)
    {
        $returnDate = Carbon::now();
        $dueDate = Carbon::parse($loan->due_date);

        $loan->update([
            'return_date' => $returnDate,
            'status' => 'returned',
        ]);

        $loan->book->increment('stock');

        if ($returnDate->gt($dueDate)) {
            $daysLate = $returnDate->diffInDays($dueDate);
            Fine::create([
                'loan_id'   => $loan->id,
                'days_late' => $daysLate,
                'amount'    => $daysLate * 1000,
                'status'    => 'unpaid',
            ]);
        }

        return redirect()->route('loans.index')->with('success', 'Pengembalian berhasil dicatat!');
    }
}
