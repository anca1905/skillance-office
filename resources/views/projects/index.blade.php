@extends('layouts.app')

@section('page-title', 'Project Monitoring')

@section('content')
    <div class="container-fluid p-0 mt-4">

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fa-solid fa-check-circle me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card shadow-sm border-0">
            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 fw-bold text-navy">Daftar Project Berjalan</h6>
                <div>
                    <button class="btn btn-success text-white btn-sm me-2" data-bs-toggle="modal"
                        data-bs-target="#addProjectModal">
                        <i class="fa-solid fa-plus me-1"></i> Project Baru
                    </button>

                    <button class="btn btn-outline-secondary btn-sm me-2">
                        <i class="fa-solid fa-filter me-1"></i> Filter
                    </button>
                    <a href="{{ route('projects.export-pdf') }}" target="_blank" class="btn btn-navy text-white btn-sm"
                        style="background-color: var(--corporate-navy);">
                        <i class="fa-solid fa-print me-1"></i> PDF
                    </a>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped table-hover align-middle mb-0">
                        <thead class="bg-light text-uppercase small text-muted">
                            <tr>
                                <th class="ps-4" style="width: 25%;">Nama Project</th>
                                <th style="width: 20%;">Klien / Instansi</th>
                                <th style="width: 15%;">Deadline</th>
                                <th style="width: 15%;">Status</th>
                                <th style="width: 15%;">Pembayaran</th>
                                <th class="text-end pe-4" style="width: 10%;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($projects as $project)
                                <tr>
                                    <td class="ps-4">
                                        <span class="fw-bold d-block text-navy">{{ $project->name }}</span>
                                        <small class="text-muted">
                                            @if (str_contains(strtolower($project->platform), 'android'))
                                                <i class="fa-brands fa-android text-success me-1"></i>
                                            @else
                                                <i class="fa-solid fa-globe text-primary me-1"></i>
                                            @endif
                                            {{ $project->platform }}
                                            </span>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="rounded-circle bg-navy text-white d-flex justify-content-center align-items-center fw-bold me-2"
                                                style="width:30px; height:30px; font-size: 0.8rem;">
                                                {{ substr($project->client_name, 0, 1) }}
                                            </div>
                                            <div>
                                                <div class="fw-bold">{{ $project->client_name }}</div>
                                                <a href="https://wa.me/{{ $project->client_contact }}" target="_blank"
                                                    class="text-decoration-none small text-success">
                                                    <i class="fa-brands fa-whatsapp"></i> Chat WA
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ date('d M Y', strtotime($project->deadline)) }}</td>
                                    <td>
                                        @if ($project->status == 'Development')
                                            <span
                                                class="badge bg-warning text-dark border border-warning">Development</span>
                                        @elseif($project->status == 'Testing')
                                            <span class="badge bg-info text-dark border border-info">Testing</span>
                                        @elseif($project->status == 'Selesai')
                                            <span class="badge bg-success text-white border border-success">Selesai</span>
                                        @else
                                            <span class="badge bg-secondary">{{ $project->status }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="badge bg-light text-dark border">{{ $project->payment_status }}</span>
                                    </td>
                                    <td class="text-end pe-4">
                                        @if ($project->demo_link)
                                            <a href="{{ $project->demo_link }}" target="_blank"
                                                class="btn btn-sm btn-outline-primary" title="Lihat Demo">
                                                <i class="fa-solid fa-globe"></i>
                                            </a>
                                        @else
                                            <button class="btn btn-sm btn-outline-secondary disabled">
                                                <i class="fa-solid fa-globe"></i>
                                            </button>
                                        @endif

                                        <button class="btn btn-sm btn-light border btn-edit" data-bs-toggle="modal"
                                            data-bs-target="#editProjectModal" data-id="{{ $project->id }}"
                                            data-name="{{ $project->name }}" data-platform="{{ $project->platform }}"
                                            data-client="{{ $project->client_name }}"
                                            data-deadline="{{ $project->deadline }}" data-status="{{ $project->status }}"
                                            data-payment="{{ $project->payment_status }}"
                                            data-demo="{{ $project->demo_link }}">
                                            <i class="fa-solid fa-pen"></i>
                                        </button>
                                        <a href="{{ route('docs.index', $project->id) }}"
                                            class="btn btn-sm btn-outline-info text-info border-info"
                                            title="Buat Buku Laporan">
                                            <i class="fa-solid fa-book-open"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer bg-white border-top-0 py-3">
                    <small class="text-muted">Menampilkan semua data</small>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addProjectModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header bg-navy text-white">
                    <h6 class="modal-title fw-bold">Tambah Project Baru</h6>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>

                <form action="{{ route('projects.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-md-12">
                                <label class="form-label small fw-bold text-muted">NAMA PROJECT</label>
                                <input type="text" name="name" class="form-control"
                                    placeholder="Contoh: Sistem Informasi Sekolah" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-muted">PLATFORM</label>
                                <select name="platform" class="form-select">
                                    <option value="Web App (Laravel)">Web App (Laravel)</option>
                                    <option value="Android Mobile">Android Mobile</option>
                                    <option value="Web GIS">Web GIS</option>
                                    <option value="Expert System">Expert System</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-muted">DEADLINE</label>
                                <input type="date" name="deadline" class="form-control" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-muted">NAMA KLIEN</label>
                                <input type="text" name="client_name" class="form-control" placeholder="Nama Klien"
                                    required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-muted">NO. HP / WA</label>
                                <input type="text" name="client_contact" class="form-control" placeholder="628..."
                                    required>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label small fw-bold text-muted">INSTANSI / STATUS</label>
                                <input type="text" name="client_institution" class="form-control"
                                    placeholder="Contoh: Mahasiswa / Dinas PU">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-muted">STATUS AWAL</label>
                                <select name="status" class="form-select">
                                    <option value="Development" selected>Development</option>
                                    <option value="Testing">Testing</option>
                                    <option value="On Hold">On Hold</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-muted">STATUS PEMBAYARAN</label>
                                <select name="payment_status" class="form-select">
                                    <option value="Belum Bayar">Belum Bayar</option>
                                    <option value="DP 50%">DP 50%</option>
                                    <option value="Lunas">Lunas</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-top-0">
                        <button type="button" class="btn btn-light border" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-navy text-white">Simpan Project</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editProjectModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header bg-navy text-white">
                    <h6 class="modal-title fw-bold">Edit Data Project</h6>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <form id="editForm" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-md-12">
                                <label class="form-label small fw-bold text-muted">NAMA PROJECT</label>
                                <input type="text" name="name" id="edit_name" class="form-control" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-muted">PLATFORM</label>
                                <input type="text" name="platform" id="edit_platform" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-muted">NAMA KLIEN</label>
                                <input type="text" name="client_name" id="edit_client" class="form-control" required>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label small fw-bold text-muted">DEADLINE</label>
                                <input type="date" name="deadline" id="edit_deadline" class="form-control" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label small fw-bold text-muted">STATUS PENGERJAAN</label>
                                <select name="status" id="edit_status" class="form-select">
                                    <option value="Development">Development</option>
                                    <option value="Testing">Testing</option>
                                    <option value="Selesai">Selesai</option>
                                    <option value="On Hold">On Hold</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label small fw-bold text-muted">PEMBAYARAN</label>
                                <input type="text" name="payment_status" id="edit_payment" class="form-control">
                            </div>

                            <div class="col-md-12">
                                <label class="form-label small fw-bold text-muted">LINK DEMO (Opsional)</label>
                                <input type="url" name="demo_link" id="edit_demo" class="form-control"
                                    placeholder="https://...">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-top-0">
                        <button type="button" class="btn btn-light border" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-navy text-white">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var editModal = document.getElementById('editProjectModal');

            editModal.addEventListener('show.bs.modal', function(event) {
                // 1. Ambil tombol yang diklik
                var button = event.relatedTarget;

                // 2. Ambil data dari atribut data-* tombol tersebut
                var id = button.getAttribute('data-id');
                var name = button.getAttribute('data-name');
                var platform = button.getAttribute('data-platform');
                var client = button.getAttribute('data-client');
                var deadline = button.getAttribute('data-deadline');
                var status = button.getAttribute('data-status');
                var payment = button.getAttribute('data-payment');
                var demo = button.getAttribute('data-demo');

                // 3. Isi nilai input dalam modal
                document.getElementById('edit_name').value = name;
                document.getElementById('edit_platform').value = platform;
                document.getElementById('edit_client').value = client;
                document.getElementById('edit_deadline').value = deadline;
                document.getElementById('edit_status').value = status;
                document.getElementById('edit_payment').value = payment;
                document.getElementById('edit_demo').value = demo;

                // 4. Update URL Action pada form agar mengarah ke ID yang benar
                // Hasilnya: /projects/1, /projects/2, dst.
                var form = document.getElementById('editForm');
                form.action = '/projects/' + id;
            });
        });
    </script>
@endsection
