@extends('layouts.app')

@section('title', 'Peminjaman')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold"><i class="bi bi-arrow-left-right"></i> Daftar Peminjaman</h4>
    <a href="{{ route('loans.create') }}" class="btn btn-primary">
        <i class="bi bi-plus"></i> Tambah Peminjaman
    </a>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <table class="table table-hover">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Anggota</th>
                    <th>Buku</th>
                    <th>Tgl Pinjam</th>
                    <th>Tgl Kembali</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($loans as $loan)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $loan->member->name }}</td>
                    <td>{{ $loan->book->title }}</td>
                    <td>{{ $loan->loan_date }}</td>
                    <td>{{ $loan->due_date }}</td>
                    <td>
                        @if($loan->status == 'borrowed')
                            <span class="badge bg-warning text-dark">Dipinjam</span>
                        @else
                            <span class="badge bg-success">Dikembalikan</span>
                        @endif
                    </td>
                    <td>
                        @if($loan->status == 'borrowed')
                            <form action="{{ route('loans.return', $loan) }}" method="POST" class="d-inline"
                                onsubmit="return confirm('Konfirmasi pengembalian buku ini?')">
                                @csrf
                                <button class="btn btn-sm btn-success">
                                    <i class="bi bi-check-circle"></i> Kembalikan
                                </button>
                            </form>
                        @else
                            <span class="text-muted small">{{ $loan->return_date }}</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center text-muted">Belum ada peminjaman.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection