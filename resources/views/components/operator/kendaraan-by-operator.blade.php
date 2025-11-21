<div class="row">
    @forelse($kendaraans as $kendaraan)
    <div class="col-md-6 mb-3">
        <div class="card border border-primary p-1">
            <div class="card-body p-2">

                <table class="table table-sm mb-0 small">

                    <tr>
                        <th class="w-50">Kode Barang</th>
                        <td>{{ $kendaraan->kode_barang }}</td>
                    </tr>
                    <tr>
                        <th>Jenis Barang</th>
                        <td>{{ $kendaraan->jenis_barang }}</td>
                    </tr>
                    <tr>
                        <th>Merk / Type</th>
                        <td>{{ $kendaraan->merk_type }}</td>
                    </tr>
                    <tr>
                        <th>CC</th>
                        <td>{{ $kendaraan->cc }}</td>
                    </tr>
                    <tr>
                        <th>Tahun Pembelian</th>
                        <td>{{ $kendaraan->tahun_pembelian }}</td>
                    </tr>
                    <tr>
                        <th>No. Rangka</th>
                        <td class="text-uppercase">{{ $kendaraan->N_rangka }}</td>
                    </tr>
                    <tr>
                        <th>No. Mesin</th>
                        <td class="text-uppercase">{{ $kendaraan->N_mesin }}</td>
                    </tr>
                    <tr>
                        <th>No. Polisi</th>
                        <td class="text-uppercase">{{ $kendaraan->N_polisi }}</td>
                    </tr>
                    <tr>
                        <th>Harga</th>
                        <td>Rp {{ number_format($kendaraan->harga, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <th>Tgl Jatuh Tempo</th>
                        <td class="text-danger fw-bold">{{ $kendaraan->tgl_jatuh_tempo }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    @empty
    <div class="col-md-12 mb-3">
        <div class="card">
            <div class="card-body text-center">
                Tidak Ada Kendaraan yang Anda Gunakan!
            </div>
        </div>
    </div>
    @endforelse
</div>