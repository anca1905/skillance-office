@extends('layouts.app')
@section('page-title', 'Buat Invoice Baru')

@section('content')
    <div class="container-fluid p-0 mt-4">
        <form action="{{ route('invoices.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-4">
                    <div class="card shadow-sm mb-4">
                        <div class="card-header bg-navy text-white">
                            <h6 class="m-0 fw-bold">Informasi Invoice</h6>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="small fw-bold text-muted">NO. INVOICE</label>
                                <input type="text" name="invoice_number" class="form-control fw-bold"
                                    value="{{ $newInvNumber }}" readonly>
                            </div>
                            <div class="mb-3">
                                <label class="small fw-bold text-muted">PILIH PROJECT (Opsional)</label>
                                <select name="project_id" id="projectSelect" class="form-select"
                                    onchange="fillClientInfo()">
                                    <option value="">-- Invoice Lepas / Umum --</option>
                                    @foreach ($projects as $p)
                                        <option value="{{ $p->id }}" data-client="{{ $p->client_name }}">
                                            {{ $p->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="small fw-bold text-muted">KEPADA (KLIEN)</label>
                                <input type="text" name="client_name" id="clientName" class="form-control" required
                                    placeholder="Nama Klien / Instansi">
                            </div>
                            <div class="mb-3">
                                <label class="small fw-bold text-muted">ALAMAT (Opsional)</label>
                                <textarea name="client_address" class="form-control" rows="2" placeholder="Alamat penagihan..."></textarea>
                            </div>
                            <div class="row">
                                <div class="col-6 mb-3">
                                    <label class="small fw-bold text-muted">TANGGAL INV</label>
                                    <input type="date" name="invoice_date" class="form-control"
                                        value="{{ date('Y-m-d') }}" required>
                                </div>
                                <div class="col-6 mb-3">
                                    <label class="small fw-bold text-muted">JATUH TEMPO</label>
                                    <input type="date" name="due_date" class="form-control"
                                        value="{{ date('Y-m-d', strtotime('+7 days')) }}" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="card shadow-sm">
                        <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                            <h6 class="m-0 fw-bold text-navy">Rincian Biaya</h6>
                            <button type="button" class="btn btn-sm btn-success text-white" onclick="addItem()">
                                <i class="fa-solid fa-plus"></i> Tambah Item
                            </button>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-striped mb-0" id="itemsTable">
                                <thead class="bg-light">
                                    <tr>
                                        <th width="40%">Deskripsi</th>
                                        <th width="15%">Qty</th>
                                        <th width="30%">Harga Satuan (Rp)</th>
                                        <th width="15%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="itemsContainer">
                                    <tr>
                                        <td><input type="text" name="items[0][desc]" class="form-control"
                                                placeholder="Jasa..." required></td>
                                        <td><input type="number" name="items[0][qty]" class="form-control" value="1"
                                                min="1" required></td>
                                        <td><input type="number" name="items[0][price]" class="form-control"
                                                placeholder="0" required></td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer bg-white text-end">
                            <a href="{{ route('invoices.index') }}" class="btn btn-light border me-2">Batal</a>
                            <button type="submit" class="btn btn-navy text-white fw-bold px-4">SIMPAN INVOICE</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script>
        let itemIndex = 1;

        // Fungsi Tambah Baris Otomatis
        function addItem() {
            const html = `
            <tr>
                <td><input type="text" name="items[${itemIndex}][desc]" class="form-control" placeholder="Item tambahan..." required></td>
                <td><input type="number" name="items[${itemIndex}][qty]" class="form-control" value="1" min="1" required></td>
                <td><input type="number" name="items[${itemIndex}][price]" class="form-control" placeholder="0" required></td>
                <td><button type="button" class="btn btn-danger btn-sm text-white" onclick="this.closest('tr').remove()"><i class="fa-solid fa-trash"></i></button></td>
            </tr>
        `;
            document.getElementById('itemsContainer').insertAdjacentHTML('beforeend', html);
            itemIndex++;
        }

        // Fungsi Otomatis Isi Nama Klien dari Dropdown Project
        function fillClientInfo() {
            const select = document.getElementById('projectSelect');
            const clientInput = document.getElementById('clientName');
            const selectedOption = select.options[select.selectedIndex];

            if (selectedOption.value) {
                clientInput.value = selectedOption.getAttribute('data-client');
            } else {
                clientInput.value = '';
            }
        }
    </script>
@endsection
