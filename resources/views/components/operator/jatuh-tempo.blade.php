<style>
    .table-separator td {
        padding: 6px 0 !important;
        border-top: 1px solid blue !important;
    }
</style>
<x-overlay></x-overlay>
<div class="row">
    @forelse($kendaraanJatuhTempo as $jtempo)
    <div class="col-md-6 mb-3">
        <div class="card border border-primary p-1">
            <div class="card-body p-2">

                <table class="table table-sm mb-0 small">

                    <tr>
                        <th class="w-50">Kode Barang</th>
                        <td>{{ $jtempo->kode_barang }}</td>
                    </tr>
                    <tr>
                        <th>Jenis Barang</th>
                        <td>{{ $jtempo->jenis_barang }}</td>
                    </tr>
                    <tr>
                        <th>Merk / Type</th>
                        <td>{{ $jtempo->merk_type }}</td>
                    </tr>
                    <tr>
                        <th>CC</th>
                        <td>{{ $jtempo->cc }}</td>
                    </tr>
                    <tr>
                        <th>Tahun Pembelian</th>
                        <td>{{ $jtempo->tahun_pembelian }}</td>
                    </tr>
                    <tr>
                        <th>No. Rangka</th>
                        <td class="text-uppercase">{{ $jtempo->N_rangka }}</td>
                    </tr>
                    <tr>
                        <th>No. Mesin</th>
                        <td class="text-uppercase">{{ $jtempo->N_mesin }}</td>
                    </tr>
                    <tr>
                        <th>No. Polisi</th>
                        <td class="text-uppercase">{{ $jtempo->N_polisi }}</td>
                    </tr>
                    <tr>
                        <th>Harga</th>
                        <td>Rp {{ number_format($jtempo->harga, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <th>Tgl Jatuh Tempo</th>
                        <td class="text-danger fw-bold">{{ $jtempo->tgl_jatuh_tempo }}</td>
                    </tr>

                    <tr class="table-separator">
                        <td colspan="2"></td>
                    </tr>

                    <form action="{{ route('opt.samsat.store') }}" method="post" id="samsatForm">
                        @csrf
                        <input type="hidden" name="kendaraan_id" value="{{ $jtempo->id }}">
                        <tr>
                            <th class="text-danger">Tanggal Samsat</th>
                            <td>
                                <input type="date" name="tgl_samsat"
                                    class="form-control form-control-sm mt-1"
                                    required>
                            </td>
                        </tr>

                        <tr>
                            <th class="text-danger">Biaya</th>
                            <td>
                                <input type="number" name="biaya"
                                    class="form-control form-control-sm mt-1"
                                    placeholder="biaya"
                                    required>
                            </td>
                        </tr>
                        <tr>
                            <th class="text-danger">Samsat Berikutnya</th>
                            <td>
                                <input type="date" name="tgl_jatuh_tempo"
                                    class="form-control form-control-sm mt-1"
                                    required>
                            </td>
                        </tr>
                        <tr>
                            <th class="text-danger"></th>
                            <td class="text-end">
                                <button type="submit" name="submit" id="submitBtn" class="btn btn-success btn-sm">
                                    <span id="submitText">Submit</span>
                                    <span id="submitSpinner" class="spinner-border spinner-border-sm ms-2 d-none" role="status"></span>
                                </button>
                            </td>
                        </tr>
                    </form>

                </table>

            </div>
        </div>
    </div>
    @empty
    <div class="col-md-12 mb-3">
        <div class="card">
            <div class="card-body text-center">
                Tidak Ada Kendaraan yang Jatuh Tempo!
            </div>
        </div>
    </div>
    @endforelse
</div>

@push('script')
<script>
    const samsatForm = document.getElementById('samsatForm');

    samsatForm.addEventListener('submit', function(e) {
        loadingOverlay.classList.remove('d-none');
        samsatForm.classList.add('form-disabled');
        submitBtn.disabled = true;
        submitText.textContent = 'Menyimpan data, mohon tunggu...';
        submitSpinner.classList.remove('d-none');
    });
</script>
@endpush