<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\Member;
use App\Models\Loan;
use App\Models\Fine;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Statistik utama
        $totalCategories = Category::count();
        $totalBooks = Book::count();
        $totalMembers = Member::count();
        $activeLoans = Loan::where('status', 'borrowed')->count();

        // Total denda bulan ini
        $totalFines = Fine::where('status', 'unpaid')
            ->whereMonth('created_at', Carbon::now()->month)
            ->sum('amount');

        // Anggota terlambat
        $lateLoans = Loan::where('status', 'borrowed')
            ->where('due_date', '<', Carbon::now())
            ->count();

        // Aktivitas terbaru (10 peminjaman terakhir)
        $recentLoans = Loan::with(['book', 'member'])
            ->latest()
            ->take(5)
            ->get();

        // Buku terpopuler
        $popularBooks = Book::withCount('loans')
            ->orderBy('loans_count', 'desc')
            ->take(5)
            ->get();

        // Anggota baru
        $newMembers = Member::latest()->take(3)->get();

        // Peminjaman terlambat
        $lateMembers = Loan::with(['book', 'member'])
            ->where('status', 'borrowed')
            ->where('due_date', '<', Carbon::now())
            ->take(3)
            ->get();

        // Data grafik peminjaman per bulan
        $loanChart = [];
        for ($i = 1; $i <= 12; $i++) {
            $loanChart[] = Loan::whereMonth('created_at', $i)
                ->whereYear('created_at', Carbon::now()->year)
                ->count();
        }

        return view('dashboard', compact(
            'totalCategories', 'totalBooks', 'totalMembers', 'activeLoans',
            'totalFines', 'lateLoans', 'recentLoans', 'popularBooks',
            'newMembers', 'lateMembers', 'loanChart'
        ));
    }
}