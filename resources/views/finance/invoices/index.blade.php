@extends('layouts.app')

@section('page-title', 'Daftar Invoice')

@section('content')
    <div class="container-fluid p-0 mt-4">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 fw-bold text-navy">Riwayat Tagihan Klien</h6>
                <a href="{{ route('invoices.create') }}" class="btn btn-navy text-white btn-sm">
                    <i class="fa-solid fa-plus me-1"></i> Buat Invoice Baru
                </a>
            </div>
            <div class="card-body p-0">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-4">No. Invoice</th>
                            <th>Klien</th>
                            <th>Tanggal</th>
                            <th>Total Tagihan</th>
                            <th>Status</th>
                            <th class="text-end pe-4">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($invoices as $inv)
                            <tr>
                                <td class="ps-4 fw-bold text-navy">{{ $inv->invoice_number }}</td>
                                <td>
                                    <div class="fw-bold">{{ $inv->client_name }}</div>
                                    <small class="text-muted">{{ $inv->project->name ?? 'Project Umum' }}</small>
                                </td>
                                <td>{{ date('d M Y', strtotime($inv->invoice_date)) }}</td>
                                <td class="fw-bold">Rp {{ number_format($inv->items->sum('total'), 0, ',', '.') }}</td>
                                <td>
                                    @if ($inv->status == 'PAID')
                                        <span class="badge bg-success">LUNAS</span>
                                    @else
                                        <span class="badge bg-warning text-dark">BELUM BAYAR</span>
                                    @endif
                                </td>
                                <td class="text-end pe-4">
                                    @if ($inv->status == 'UNPAID')
                                        <form action="{{ route('invoices.paid', $inv->id) }}" method="POST"
                                            class="d-inline" onsubmit="return confirm('Tandai Lunas?')">
                                            @csrf
                                            <button class="btn btn-sm btn-outline-success" title="Tandai Lunas"><i
                                                    class="fa-solid fa-check"></i></button>
                                        </form>
                                    @endif
                                    <a href="{{ route('invoices.print', $inv->id) }}" target="_blank"
                                        class="btn btn-sm btn-outline-primary" title="Cetak PDF">
                                        <i class="fa-solid fa-print"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4 text-muted">Belum ada invoice dibuat.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
