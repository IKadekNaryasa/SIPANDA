{{-- Loading Overlay --}}
<x-overlay></x-overlay>


<style>
    .select2-container--default .select2-selection--single {
        height: 38px;
        padding: 6px 12px;
        border: 1px solid #ced4da;
        border-radius: 0.25rem;
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 24px;
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 36px;
    }

    .select2-dropdown {
        border: 1px solid #ced4da;
    }
</style>
<div class="row">
    <div class="card mb-4">
        <h5 class="card-header text-center">Edit Kendaraan</h5>
        <div class="card-body">
            <form action="{{ route('kendaraan.update',$kendaraan->id) }}" method="post" enctype="multipart/form-data" id="kendaraanForm">
                @csrf
                @method('PUT')
                <div id="formContainer">
                    <div class="form-item border p-3 mb-3 rounded" data-index="0">
                        <div class="row mb-1">
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Kode Barang</label>
                                <input type="text" name="kode_barang" class="form-control" value="{{ $kendaraan->kode_barang ?? old('kode_barang') }}" autofocus required placeholder="KODE BARANG">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Jenis Barang</label>
                                <input type="text" name="jenis_barang" class="form-control" value="{{ $kendaraan->jenis_barang ?? old('jenis_barang') }}" required placeholder="JENIS BARANG">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Merk/Type</label>
                                <input type="text" name="merk" class="form-control" value="{{ $kendaraan->merk_type ?? old('merk') }}" required placeholder="MERK/TYPE">
                            </div>
                            <div class="col-md-2 mb-3">
                                <label class="form-label">CC</label>
                                <input type="number" name="cc" class="form-control" value="{{ $kendaraan->cc ?? old('cc') }}" required placeholder="CC">
                            </div>
                            <div class="col-md-2 mb-3">
                                <label class="form-label">Tahun Pembelian</label>
                                <input type="number" name="tahun_pembelian" class="form-control" value="{{ $kendaraan->tahun_pembelian ?? old('tahun_pembelian') }}" required placeholder="TAHUN">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label">Nomor Rangka</label>
                                <input type="text" name="N_rangka" class="form-control" value="{{ $kendaraan->N_rangka ?? old('N_rangka') }}" required placeholder="Nomor Rangka" style="text-transform: uppercase;">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label">Nomor Mesin</label>
                                <input type="text" name="N_mesin" class="form-control" value="{{ $kendaraan->N_mesin ?? old('N_mesin') }}" required placeholder="Nomor Mesin" style="text-transform: uppercase;">
                            </div>
                            <div class="col-md-2 mb-3">
                                <label class="form-label">Nomor Polisi</label>
                                <input type="text" name="N_polisi" class="form-control" value="{{ $kendaraan->N_polisi ?? old('N_polisi') }}" required placeholder="Nomor Polisi" style="text-transform: uppercase;">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label">Harga</label>
                                <input type="number" name="harga" class="form-control" value="{{ $kendaraan->harga ?? old('harga') }}" required placeholder="HARGA">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label">Jatuh Tempo</label>
                                <input type="date" name="tgl_jatuh_tempo" class="form-control" value="{{ $kendaraan->tgl_jatuh_tempo ?? old('tgl_jatuh_tempo') }}" required placeholder="JATUH TEMPO">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Penanggung Jawab</label>
                                <select name="user_id" id="userSelect" class="form-control" required>
                                    <option value="{{ $kendaraan->user_id }}" selected>{{ $kendaraan->user->name }}</option>
                                    @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-4 text-center">
                        <button type="submit" name="submit" id="submitBtn" class="btn btn-success w-50">
                            <span id="submitText">Update</span>
                            <span id="submitSpinner" class="spinner-border spinner-border-sm ms-2 d-none" role="status"></span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@push('script')
<script>
    const kendaraanForm = document.getElementById('kendaraanForm');

    $(document).ready(function() {
        $('#userSelect').select2({
            placeholder: 'Choose User...',
            allowClear: true,
            width: '100%',
            language: {
                noResults: function() {
                    return "User tidak ditemukan";
                },
                searching: function() {
                    return "Mencari...";
                }
            }
        });
    });
    kendaraanForm.addEventListener('submit', function(e) {
        loadingOverlay.classList.remove('d-none');
        kendaraanForm.classList.add('form-disabled');
        submitBtn.disabled = true;
        submitText.textContent = 'Menyimpan data, mohon tunggu...';
        submitSpinner.classList.remove('d-none');
    });
</script>
@endpush