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
        $validated = $request->validate([
            'book_id'   => 'required|exists:books,id',
            'member_id' => 'required|exists:members,id',
            'loan_date' => 'required|date',
            'due_date'  => 'required|date|after:loan_date',
        ]);

        $book = Book::findOrFail($validated['book_id']);

        if ($book->stock <= 0) {
            return redirect()->back()
                ->with('error', 'Stok buku tidak tersedia!');
        }

        $book->decrement('stock');

        $validated['status'] = 'borrowed';

        Loan::create($validated);

        return redirect()->route('loans.index')
            ->with('success', 'Peminjaman berhasil dicatat!');
    }

    public function return(Loan $loan)
    {
        if ($loan->status === 'returned') {
            return redirect()->route('loans.index')
                ->with('error', 'Buku ini sudah dikembalikan sebelumnya!');
        }

        $returnDate = Carbon::today();
        $dueDate = Carbon::parse($loan->due_date)->startOfDay();

        $loan->update([
            'return_date' => $returnDate,
            'status' => 'returned',
        ]);

        $loan->book->increment('stock');

        if ($returnDate->gt($dueDate)) {
            $daysLate = (int) $dueDate->diffInDays($returnDate);

            Fine::updateOrCreate(
                ['loan_id' => $loan->id],
                [
                    'days_late' => $daysLate,
                    'amount' => $daysLate * 1000,
                    'status' => 'unpaid',
                ]
            );
        } else {
            Fine::where('loan_id', $loan->id)->delete();
        }

        return redirect()->route('loans.index')
            ->with('success', 'Pengembalian berhasil dicatat!');
    }
}
