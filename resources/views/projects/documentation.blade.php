@extends('layouts.app')

@section('page-title', 'Penyusunan Laporan')

@section('content')
    <div class="container-fluid p-0 mt-4">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="fw-bold text-navy m-0">Dokumentasi: {{ $project->name }}</h4>
                <small class="text-muted">Klien: {{ $project->client_name }}</small>
            </div>
            <a href="{{ route('docs.print', $project->id) }}" target="_blank" class="btn btn-navy text-white">
                <i class="fa-solid fa-book me-2"></i> PREVIEW BUKU LAPORAN
            </a>
        </div>

        <div class="row g-4">
            <div class="col-lg-4">

                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-white py-3">
                        <h6 class="m-0 fw-bold text-navy"><i class="fa-regular fa-image me-2"></i>Cover Laporan</h6>
                    </div>
                    <div class="card-body text-center">
                        @if ($project->cover_image)
                            <img src="{{ asset('storage/' . $project->cover_image) }}" class="img-fluid rounded border mb-3"
                                style="max-height: 150px; width: 100%; object-fit: cover;">
                        @else
                            <div class="bg-light rounded border mb-3 d-flex align-items-center justify-content-center text-muted"
                                style="height: 150px;">
                                <small>Belum ada cover</small>
                            </div>
                        @endif

                        <form action="{{ route('docs.cover.upload', $project->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="input-group input-group-sm">
                                <input type="file" name="cover" class="form-control" accept="image/*" required>
                                <button class="btn btn-navy text-white" type="submit">Upload</button>
                            </div>
                            <small class="text-muted mt-2 d-block" style="font-size: 0.7rem;">Saran: Gambar Landscape (Rasio
                                16:9)</small>
                        </form>
                    </div>
                </div>

                <div class="card shadow-sm sticky-top" style="top: 20px; z-index: 1;">
                    <div class="card-header bg-navy text-white py-3">
                        <h6 class="m-0 fw-bold"><i class="fa-solid fa-plus me-2"></i>Tambah Halaman</h6>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('docs.store', $project->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label class="small fw-bold text-muted">JUDUL HALAMAN</label>
                                <input type="text" name="title" class="form-control" placeholder="Cth: Halaman Login"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label class="small fw-bold text-muted">UPLOAD SCREENSHOT</label>
                                <input type="file" name="image" class="form-control" accept="image/*" required>
                            </div>
                            <div class="mb-3">
                                <label class="small fw-bold text-muted">KETERANGAN (FUNGSI & CARA)</label>
                                <textarea name="description" class="form-control" rows="8" required placeholder="Fungsi: ...&#10;Cara Kerja: ..."></textarea>
                            </div>
                            <button type="submit" class="btn btn-warning w-100 fw-bold">Simpan ke Laporan</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-lg-8">
                @forelse($docs as $index => $doc)
                    <div class="card shadow-sm border-0 mb-3">
                        <div class="card-header bg-white d-flex justify-content-between align-items-center">
                            <span class="badge bg-secondary">Halaman {{ $index + 1 }}</span>
                            <h6 class="m-0 fw-bold text-navy mx-3 flex-grow-1">{{ $doc->title }}</h6>
                            <form action="{{ route('docs.destroy', $doc->id) }}" method="POST">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm text-danger"><i class="fa-solid fa-trash"></i></button>
                            </form>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <img src="{{ asset('storage/' . $doc->image_path) }}" class="img-fluid rounded border">
                                </div>
                                <div class="col-md-8">
                                    <div class="bg-light p-3 rounded h-100" style="white-space: pre-line;">
                                        {{ $doc->description }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-5 text-muted">
                        <i class="fa-solid fa-file-circle-plus fa-3x mb-3 opacity-25"></i>
                        <p>Belum ada halaman. Silakan input di sebelah kiri.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection
