@extends('layouts.app')

@section('page-title', 'Marketing & Leads')

@section('content')
    <div class="container-fluid p-4 mt-4">

        <div class="card">
            <div class="card-header bg-white py-3">
                <h6 class="m-0 fw-bold text-navy">Pipeline Project & Prospek</h6>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="ps-4">Instansi / Klien</th>
                                <th>Kontak</th>
                                <th>Potensi Nilai</th>
                                <th>Status Negosiasi</th>
                                <th class="text-end pe-4">Quick Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($leads as $lead)
                                <tr>
                                    <td class="ps-4">
                                        <span class="fw-bold text-navy">{{ $lead->institution }}</span>
                                        <small class="d-block text-muted">{{ $lead->project_name }}</small>
                                    </td>
                                    <td>{{ $lead->contact_person }}</td>
                                    <td class="text-success fw-bold">Rp
                                        {{ number_format($lead->potential_value, 0, ',', '.') }}</td>
                                    <td>
                                        <span class="badge bg-info text-dark">{{ $lead->status }}</span>
                                    </td>
                                    <td class="text-end pe-4">
                                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $lead->contact_person) }}"
                                            target="_blank" class="btn btn-success btn-sm">
                                            <i class="fa-brands fa-whatsapp me-1"></i> Hubungi
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
