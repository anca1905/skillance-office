@extends('layouts.app')

@section('page-title', 'Executive Dashboard')

@section('content')
    <div class="container-fluid p-4">

        <div class="row g-4 mb-4">
            <div class="col-12 col-md-6 col-xl-3">
                <div class="card h-100 border-start border-4 border-primary">
                    <div class="card-body">
                        <small class="text-uppercase text-muted fw-bold" style="font-size: 0.7rem;">Total Omzet
                            (Realtime)</small>
                        <h3 class="fw-bold text-navy mt-2 mb-0">Rp {{ number_format($totalOmzet, 0, ',', '.') }}</h3>
                        <small class="text-success"><i class="fa-solid fa-check-circle"></i> Data Terupdate</small>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-6 col-xl-3">
                <div class="card h-100 border-start border-4 border-warning">
                    <div class="card-body">
                        <small class="text-uppercase text-muted fw-bold" style="font-size: 0.7rem;">Project Aktif</small>
                        <h3 class="fw-bold text-navy mt-2 mb-0">{{ $activeProjects }} Project</h3>
                        <small class="text-muted">Sedang berjalan</small>
                    </div>
                </div>
            </div>

            <div class="list-group list-group-flush">
                @foreach ($recentProjects as $item)
                    <div class="list-group-item p-3">
                        <div class="d-flex w-100 justify-content-between align-items-center">
                            <h6 class="mb-1 fw-bold text-navy">{{ $item->name }}</h6>
                            <small class="text-muted">{{ date('d M', strtotime($item->deadline)) }}</small>
                        </div>
                        <p class="mb-1 small text-muted">Klien: {{ $item->client_name }}</p>

                        @if ($item->status == 'Development')
                            <small class="badge bg-warning text-dark border">Dev</small>
                        @elseif($item->status == 'Testing')
                            <small class="badge bg-info text-dark border">Testing</small>
                        @else
                            <small class="badge bg-success border">Selesai</small>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>

        <div class="row g-4">
            <div class="col-12 col-lg-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-header bg-navy text-white d-flex justify-content-between align-items-center py-3">
                        <span class="fw-bold"><i class="fa-regular fa-calendar-check me-2"></i>AGENDA SAYA</span>

                        <button class="btn btn-sm btn-warning text-navy fw-bold" data-bs-toggle="modal"
                            data-bs-target="#addAgendaModal">
                            <i class="fa-solid fa-plus"></i> Baru
                        </button>
                    </div>

                    <div class="list-group list-group-flush" style="max-height: 400px; overflow-y: auto;">

                        @forelse($agendas as $agenda)
                            <div class="list-group-item p-3 border-bottom">
                                <div class="d-flex w-100 justify-content-between align-items-start mb-1">
                                    <div>
                                        <h6
                                            class="mb-0 fw-bold {{ $agenda->priority == 'critical' ? 'text-danger' : 'text-navy' }}">
                                            {{ $agenda->title }}
                                        </h6>

                                        <div class="small text-muted mt-1">
                                            <i class="fa-regular fa-clock me-1"></i>
                                            {{ date('H:i', strtotime($agenda->time)) }}
                                            @if ($agenda->date == date('Y-m-d'))
                                                <span class="badge bg-danger-subtle text-danger ms-1">Hari Ini</span>
                                            @else
                                                <span
                                                    class="badge bg-light text-dark border ms-1">{{ date('d M', strtotime($agenda->date)) }}</span>
                                            @endif
                                        </div>
                                        @if ($agenda->location)
                                            <small class="d-block text-muted mt-1">
                                                <i class="fa-solid fa-location-dot me-1 text-secondary"></i>
                                                {{ $agenda->location }}
                                            </small>
                                        @endif
                                    </div>

                                    @if ($agenda->priority == 'critical')
                                        <span class="badge bg-danger blink-badge">CRITICAL</span>
                                    @elseif($agenda->priority == 'high')
                                        <span class="badge bg-warning text-dark">High</span>
                                    @endif
                                </div>

                                <div class="mt-3 d-flex gap-2">
                                    <form action="{{ route('agenda.complete', $agenda->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-outline-success py-0 px-2"
                                            style="font-size: 0.75rem;">
                                            <i class="fa-solid fa-check me-1"></i> Selesai
                                        </button>
                                    </form>
                                    <form action="{{ route('agenda.destroy', $agenda->id) }}" method="POST">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-secondary py-0 px-2"
                                            style="font-size: 0.75rem;">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @empty
                            <div class="text-center p-4 text-muted">
                                <i class="fa-solid fa-mug-hot fa-2x mb-2 text-secondary"></i>
                                <p class="small mb-0">Tidak ada agenda mendesak.<br>Nikmati kopi Anda, Pak Arsyad.</p>
                            </div>
                        @endforelse

                    </div>
                </div>
            </div>

            <div class="modal fade" id="addAgendaModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header bg-navy text-white">
                            <h6 class="modal-title fw-bold">Tambah Agenda Baru</h6>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <form action="{{ route('agenda.store') }}" method="POST">
                            @csrf
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label class="form-label small fw-bold text-muted">KEGIATAN</label>
                                    <input type="text" name="title" class="form-control"
                                        placeholder="Contoh: Meeting Klien Laundry" required>
                                </div>
                                <div class="row">
                                    <div class="col-6 mb-3">
                                        <label class="form-label small fw-bold text-muted">TANGGAL</label>
                                        <input type="date" name="date" class="form-control"
                                            value="{{ date('Y-m-d') }}" required>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <label class="form-label small fw-bold text-muted">JAM (WITA)</label>
                                        <input type="time" name="time" class="form-control"
                                            value="{{ date('H:i') }}" required>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label small fw-bold text-muted">LOKASI (Opsional)</label>
                                    <input type="text" name="location" class="form-control"
                                        placeholder="Contoh: Warkop A">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label small fw-bold text-muted">PRIORITAS</label>
                                    <select name="priority" class="form-select">
                                        <option value="normal">Normal (Biasa)</option>
                                        <option value="high">High (Penting)</option>
                                        <option value="critical">Critical (Mendesak/Deadline)</option>
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light border"
                                    data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-navy text-white">Simpan Agenda</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-8">
                <div class="card h-100">
                    <div class="card-header">
                        Statistik Performa Mingguan
                    </div>
                    <div class="card-body d-flex align-items-center justify-content-center bg-light"
                        style="min-height: 250px;">
                        <p class="text-muted mb-0">
                            <i class="fa-solid fa-chart-area fa-2x mb-2 d-block text-center text-secondary"></i>
                            Grafik Visualisasi Data Omzet
                        </p>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
