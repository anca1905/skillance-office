@extends('layouts.app')

@section('page-title', 'Finance & Cashflow')

@section('content')
    <div class="container-fluid p-4 mt-4">

        <div class="row g-3 mb-4">
            <div class="col-md-3">
                <div class="card bg-navy text-white h-100">
                    <div class="card-body p-3">
                        <small class="text-white-50 text-uppercase fw-bold">Saldo Saat Ini</small>
                        <h4 class="fw-bold mt-1 mb-0">Rp {{ number_format($saldo, 0, ',', '.') }}</h4>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card h-100 border-success border-start border-4">
                    <div class="card-body p-3">
                        <small class="text-muted text-uppercase fw-bold">Total Masuk</small>
                        <h4 class="fw-bold text-success mt-1 mb-0">+ Rp {{ number_format($pemasukan, 0, ',', '.') }}</h4>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card h-100 border-danger border-start border-4">
                    <div class="card-body p-3">
                        <small class="text-muted text-uppercase fw-bold">Total Keluar</small>
                        <h4 class="fw-bold text-danger mt-1 mb-0">- Rp {{ number_format($pengeluaran, 0, ',', '.') }}</h4>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card h-100 border-warning border-start border-4" style="background-color: #fffaf0;">
                    <div class="card-body p-3">
                        <small class="text-muted text-uppercase fw-bold">Tagihan Belum Lunas</small>
                        <h4 class="fw-bold text-warning mt-1 mb-0">Rp {{ number_format($totalPiutang ?? 0, 0, ',', '.') }}
                        </h4>
                        <a href="{{ route('invoices.index') }}"
                            class="small text-decoration-none fw-bold mt-2 d-block text-warning">
                            Lihat Detail <i class="fa-solid fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow-sm border-0">
            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 fw-bold text-navy">Riwayat Transaksi & Cashflow</h6>
                <div>
                    <a href="{{ route('invoices.index') }}" class="btn btn-outline-primary btn-sm me-2">
                        <i class="fa-solid fa-file-invoice me-1"></i> Kelola Tagihan
                    </a>

                    <button class="btn btn-navy text-white btn-sm" style="background-color: var(--corporate-navy);"
                        data-bs-toggle="modal" data-bs-target="#addTransactionModal">
                        <i class="fa-solid fa-plus me-1"></i> Transaksi Baru
                    </button>
                </div>
            </div>

            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover table-striped align-middle mb-0">
                        <thead class="bg-light text-uppercase small text-muted">
                            <tr>
                                <th class="ps-4">Tanggal</th>
                                <th>Keterangan</th>
                                <th>Jenis</th>
                                <th class="text-end pe-4">Nominal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transactions as $trx)
                                <tr>
                                    <td class="ps-4">{{ date('d M Y', strtotime($trx->transaction_date)) }}</td>
                                    <td>
                                        <span class="fw-bold d-block text-navy">{{ $trx->description }}</span>
                                        <small class="text-muted">{{ $trx->category ?? '-' }}</small>
                                    </td>
                                    <td>
                                        @if ($trx->type == 'income')
                                            <span
                                                class="badge bg-success-subtle text-success border border-success-subtle">Pemasukan</span>
                                        @else
                                            <span
                                                class="badge bg-danger-subtle text-danger border border-danger-subtle">Pengeluaran</span>
                                        @endif
                                    </td>
                                    <td
                                        class="text-end pe-4 {{ $trx->type == 'income' ? 'text-success' : 'text-danger' }} fw-bold">
                                        {{ $trx->type == 'income' ? '+' : '-' }} Rp
                                        {{ number_format($trx->amount, 0, ',', '.') }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card-footer bg-white border-top-0 py-3">
                <nav aria-label="Page navigation example">
                    <ul class="pagination pagination-sm justify-content-end m-0">
                        <li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>
                        <li class="page-item active"><a class="page-link bg-navy border-navy" href="#">1</a></li>
                        <li class="page-item"><a class="page-link text-navy" href="#">2</a></li>
                        <li class="page-item"><a class="page-link text-navy" href="#">Next</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
    <div class="modal fade" id="addTransactionModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header bg-navy text-white">
                    <h6 class="modal-title fw-bold">Catat Transaksi Keuangan</h6>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <form action="{{ route('finance.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="row mb-3 g-2">
                            <div class="col-6">
                                <input type="radio" class="btn-check" name="type" id="typeIn" value="income"
                                    checked>
                                <label class="btn btn-outline-success w-100 fw-bold" for="typeIn">
                                    <i class="fa-solid fa-arrow-down me-1"></i> Pemasukan
                                </label>
                            </div>
                            <div class="col-6">
                                <input type="radio" class="btn-check" name="type" id="typeOut" value="expense">
                                <label class="btn btn-outline-danger w-100 fw-bold" for="typeOut">
                                    <i class="fa-solid fa-arrow-up me-1"></i> Pengeluaran
                                </label>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label small fw-bold text-muted">NOMINAL (Rp)</label>
                            <input type="number" name="amount" class="form-control" placeholder="Contoh: 500000"
                                min="1000" required>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label small fw-bold text-muted">TANGGAL</label>
                                <input type="date" name="transaction_date" class="form-control"
                                    value="{{ date('Y-m-d') }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label small fw-bold text-muted">KATEGORI (Opsional)</label>
                                <input type="text" name="category" class="form-control"
                                    placeholder="Cth: Hosting / Klien">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label small fw-bold text-muted">KETERANGAN</label>
                            <textarea name="description" class="form-control" rows="2" placeholder="Contoh: Pembayaran DP Project Laundry"
                                required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer border-top-0">
                        <button type="button" class="btn btn-light border" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-navy text-white">Simpan Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
