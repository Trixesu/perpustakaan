@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h5 class="fw-bold mb-0">Selamat datang, {{ ucfirst(Auth::user()->name) }}! </h5>
        <p class="text-muted small mb-0">Kelola data perpustakaan dengan mudah dan efisien.</p>
    </div>
    <div class="text-end">
        <div class="small text-muted"><i class="bi bi-calendar3 me-1"></i><span id="tanggal"></span></div>
        <div class="small text-muted"><i class="bi bi-clock me-1"></i><span id="jam"></span></div>
    </div>
</div>

<!-- Kartu Statistik -->
<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card border-0 shadow-sm">
            <div class="card-body d-flex align-items-center justify-content-between p-4">
                <div>
                    <div class="text-muted small mb-1">Kategori</div>
                    <div class="fw-bold fs-2 lh-1">{{ $totalCategories }}</div>
                    <div class="text-muted mt-1" style="font-size:11px;">Total kategori buku</div>
                </div>
                <div class="p-3 rounded-3" style="background-color:#3b82f6;">
                    <i class="bi bi-tag-fill fs-3 text-white"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm">
            <div class="card-body d-flex align-items-center justify-content-between p-4">
                <div>
                    <div class="text-muted small mb-1">Buku</div>
                    <div class="fw-bold fs-2 lh-1">{{ $totalBooks }}</div>
                    <div class="text-muted mt-1" style="font-size:11px;">Total koleksi buku</div>
                </div>
                <div class="p-3 rounded-3" style="background-color:#22c55e;">
                    <i class="bi bi-journal-bookmark-fill fs-3 text-white"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm">
            <div class="card-body d-flex align-items-center justify-content-between p-4">
                <div>
                    <div class="text-muted small mb-1">Anggota</div>
                    <div class="fw-bold fs-2 lh-1">{{ $totalMembers }}</div>
                    <div class="text-muted mt-1" style="font-size:11px;">Total anggota terdaftar</div>
                </div>
                <div class="p-3 rounded-3" style="background-color:#f59e0b;">
                    <i class="bi bi-people-fill fs-3 text-white"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm">
            <div class="card-body d-flex align-items-center justify-content-between p-4">
                <div>
                    <div class="text-muted small mb-1">Peminjaman Aktif</div>
                    <div class="fw-bold fs-2 lh-1">{{ $activeLoans }}</div>
                    <div class="text-muted mt-1" style="font-size:11px;">Sedang dipinjam</div>
                </div>
                <div class="p-3 rounded-3" style="background-color:#ef4444;">
                    <i class="bi bi-arrow-left-right fs-3 text-white"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Aksi Cepat + Denda & Terlambat -->
<div class="row g-3 mb-4">
    <div class="col-md-8">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body p-4">
                <h6 class="fw-bold mb-3">Aksi Cepat</h6>
                <div class="row g-2">
                    <div class="col-3">
                        <a href="{{ route('books.create') }}" class="btn btn-outline-primary w-100 py-3 d-flex flex-column align-items-center gap-1">
                            <i class="bi bi-plus-circle fs-5"></i>
                            <span style="font-size:0.8rem;">Tambah Buku</span>
                        </a>
                    </div>
                    <div class="col-3">
                        <a href="{{ route('members.create') }}" class="btn btn-outline-success w-100 py-3 d-flex flex-column align-items-center gap-1">
                            <i class="bi bi-person-plus fs-5"></i>
                            <span style="font-size:0.8rem;">Tambah Anggota</span>
                        </a>
                    </div>
                    <div class="col-3">
                        <a href="{{ route('loans.create') }}" class="btn btn-outline-info w-100 py-3 d-flex flex-column align-items-center gap-1">
                            <i class="bi bi-arrow-left-right fs-5"></i>
                            <span style="font-size:0.8rem;">Peminjaman Baru</span>
                        </a>
                    </div>
                    <div class="col-3">
                        <a href="{{ route('categories.create') }}" class="btn btn-outline-warning w-100 py-3 d-flex flex-column align-items-center gap-1">
                            <i class="bi bi-grid fs-5"></i>
                            <span style="font-size:0.8rem;">Tambah Kategori</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm mb-3">
            <div class="card-body p-3">
                <div class="d-flex align-items-center gap-3">
                    <div class="p-3 rounded-3" style="background-color:#fef2f2;">
                        <i class="bi bi-cash-coin fs-4" style="color:#ef4444;"></i>
                    </div>
                    <div>
                        <div class="text-muted small">Total Denda Bulan Ini</div>
                        <div class="fw-bold fs-5">Rp {{ number_format($totalFines, 0, ',', '.') }}</div>
                        <a href="{{ route('fines.index') }}" class="small text-primary text-decoration-none">Lihat Detail →</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="card border-0 shadow-sm">
            <div class="card-body p-3">
                <div class="d-flex align-items-center gap-3">
                    <div class="p-3 rounded-3" style="background-color:#fffbeb;">
                        <i class="bi bi-person-exclamation fs-4" style="color:#f59e0b;"></i>
                    </div>
                    <div>
                        <div class="text-muted small">Anggota Terlambat</div>
                        <div class="fw-bold fs-5">{{ $lateLoans }} Orang</div>
                        <a href="{{ route('loans.index') }}" class="small text-primary text-decoration-none">Lihat Daftar →</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Grafik + Aktivitas Terbaru -->
<div class="row g-3 mb-4">
    <div class="col-md-8">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body p-4">
                <h6 class="fw-bold mb-3">Grafik Peminjaman Bulanan</h6>
                <canvas id="loanChart" height="100"></canvas>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h6 class="fw-bold mb-0">Aktivitas Terbaru</h6>
                    <a href="{{ route('loans.index') }}" class="small text-primary text-decoration-none">Lihat Semua →</a>
                </div>
                @forelse($recentLoans as $loan)
                @php
                $bgColor = $loan->status == 'returned' ? '#f0fdf4' : ($loan->due_date < now() ? '#fef2f2' : '#eff6ff' );
                    $iconColor=$loan->status == 'returned' ? '#22c55e' : ($loan->due_date < now() ? '#ef4444' : '#3b82f6' );
                        $icon=$loan->status == 'returned' ? 'check-circle' : ($loan->due_date < now() ? 'exclamation-circle' : 'book' );
                            $styleDiv="background-color:{$bgColor}; flex-shrink:0;" ;
                            $styleIcon="color:{$iconColor}; font-size:0.8rem;" ;
                            @endphp
                            <div class="d-flex align-items-start gap-2 mb-3">
                            <div class="p-2 rounded-3 mt-1" style="{{ $styleDiv }}">
                                <i class="bi bi-{{ $icon }}" style="{{ $styleIcon }}"></i>
                            </div>
                            <div class="flex-grow-1">
                                <div class="small fw-semibold">{{ $loan->member->name }}</div>
                                <div class="text-muted" style="font-size:0.75rem;">
                                    @if($loan->status == 'returned')
                                    mengembalikan "{{ Str::limit($loan->book->title, 22) }}"
                                    @elseif($loan->due_date < now())
                                        terlambat mengembalikan "{{ Str::limit($loan->book->title, 22) }}"
                                        @else
                                        meminjam "{{ Str::limit($loan->book->title, 22) }}"
                                        @endif
                                        </div>
                                        <div class="text-muted" style="font-size:0.72rem;">{{ $loan->created_at->format('d M Y') }}</div>
                                </div>
                            </div>
                            @empty
                            <p class="text-muted small text-center mt-4">Belum ada aktivitas.</p>
                            @endforelse
            </div>
        </div>
    </div>
</div>

<!-- Buku Terpopuler + Anggota Baru + Peminjaman Terlambat -->
<div class="row g-3">
    <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h6 class="fw-bold mb-0">Buku Terpopuler</h6>
                    <a href="{{ route('books.index') }}" class="small text-primary text-decoration-none">Lihat Semua →</a>
                </div>
                <table class="table table-sm mb-0">
                    <thead>
                        <tr style="font-size:0.78rem;" class="text-muted">
                            <th>No</th>
                            <th>Judul</th>
                            <th>Penulis</th>
                            <th>Dipinjam</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($popularBooks as $i => $book)
                        <tr style="font-size:0.82rem;">
                            <td>{{ $i + 1 }}</td>
                            <td>{{ Str::limit($book->title, 15) }}</td>
                            <td class="text-muted">{{ Str::limit($book->author, 12) }}</td>
                            <td><span class="badge" style="background:#3b82f6;">{{ $book->loans_count }}x</span></td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted small">Belum ada data.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h6 class="fw-bold mb-0">Anggota Baru</h6>
                    <a href="{{ route('members.index') }}" class="small text-primary text-decoration-none">Lihat Semua →</a>
                </div>
                @forelse($newMembers as $member)
                <div class="d-flex align-items-center gap-3 mb-3">
                    <div class="rounded-circle text-white d-flex align-items-center justify-content-center fw-bold"
                        style="width:38px;height:38px;font-size:14px;background:linear-gradient(135deg,#3b82f6,#6366f1);flex-shrink:0;">
                        {{ strtoupper(substr($member->name, 0, 1)) }}
                    </div>
                    <div>
                        <div class="small fw-semibold">{{ $member->name }}</div>
                        <div class="text-muted" style="font-size:0.75rem;">{{ $member->created_at->format('d M Y') }}</div>
                    </div>
                </div>
                @empty
                <p class="text-muted small text-center mt-4">Belum ada anggota.</p>
                @endforelse
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h6 class="fw-bold mb-0 text-danger">Peminjaman Terlambat</h6>
                    <a href="{{ route('loans.index') }}" class="small text-primary text-decoration-none">Lihat Semua →</a>
                </div>
                @forelse($lateMembers as $loan)
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <div class="d-flex align-items-center gap-2">
                        <div class="rounded-circle bg-danger text-white d-flex align-items-center justify-content-center fw-bold"
                            style="width:38px;height:38px;font-size:14px;flex-shrink:0;">
                            {{ strtoupper(substr($loan->member->name, 0, 1)) }}
                        </div>
                        <div>
                            <div class="small fw-semibold">{{ $loan->member->name }}</div>
                            <div class="text-muted" style="font-size:0.75rem;">{{ Str::limit($loan->book->title, 18) }}</div>
                        </div>
                    </div>
                    <span class="badge bg-danger">{{ (int)\Carbon\Carbon::now()->diffInDays($loan->due_date) }} hari terlambat</span>
                </div>
                @empty
                <p class="text-muted small text-center mt-4">Tidak ada peminjaman terlambat.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    function updateTime() {
        const now = new Date();
        const options = {
            weekday: 'long',
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        };
        document.getElementById('tanggal').textContent = now.toLocaleDateString('id-ID', options);
        document.getElementById('jam').textContent = now.toLocaleTimeString('id-ID');
    }
    updateTime();
    setInterval(updateTime, 1000);

    const ctx = document.getElementById('loanChart').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
            datasets: [{
                label: 'Jumlah Peminjaman',
                data: { !!json_encode($loanChart) !! },
                borderColor: '#3b82f6',
                backgroundColor: 'rgba(59,130,246,0.08)',
                tension: 0.4,
                fill: true,
                pointBackgroundColor: '#3b82f6',
                pointRadius: 4,
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    },
                    grid: {
                        color: '#f1f5f9'
                    }
                },
                x: {
                    grid: {
                        display: false
                    }
                }
            }
        }
    });
</script>
@endsection