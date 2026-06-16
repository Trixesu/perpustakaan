@extends('layouts.app')

@section('title', 'Denda')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold"><i class="bi bi-cash"></i> Daftar Denda</h4>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <table class="table table-hover">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Anggota</th>
                    <th>Buku</th>
                    <th>Hari Terlambat</th>
                    <th>Total Denda</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($fines as $fine)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $fine->loan->member->name }}</td>
                    <td>{{ $fine->loan->book->title }}</td>
                    <td>{{ $fine->days_late }} hari</td>
                    <td>Rp {{ number_format($fine->amount, 0, ',', '.') }}</td>
                    <td>
                        @if($fine->status == 'unpaid')
                            <span class="badge bg-danger">Belum Bayar</span>
                        @else
                            <span class="badge bg-success">Lunas</span>
                        @endif
                    </td>
                    <td>
                        @if($fine->status == 'unpaid')
                            <form action="{{ route('fines.pay', $fine) }}" method="POST" class="d-inline"
                                onsubmit="return confirm('Konfirmasi pembayaran denda ini?')">
                                @csrf
                                <button class="btn btn-sm btn-success">
                                    <i class="bi bi-check-circle"></i> Bayar
                                </button>
                            </form>
                        @else
                            <span class="text-muted small">Sudah lunas</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center text-muted">Belum ada denda.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection