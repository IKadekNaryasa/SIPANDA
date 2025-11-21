{{-- Loading Overlay --}}

<div class="row">
    <div class="card mb-4">
        <h5 class="card-header text-center">Data Kendaraan</h5>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped w-100" id="kendaraanTable">
                    <thead>
                        <tr>
                            <th style="font-size: small;" class="text-center">No</th>
                            <th style="font-size: small;" class="text-start">Kode Barang</th>
                            <th style="font-size: small;" class="text-start">Penanggung Jawab</th>
                            <th style="font-size: small;" class="text-start">Jenis Barang</th>
                            <th style="font-size: small;" class="text-start">Nomor Polisi</th>
                            <th style="font-size: small;" class="text-center">J. Tempo</th>
                            <th style="font-size: small;" class="text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($kendaraans as $kendaraan)
                        <tr>
                            <td style="font-size: small;" class="text-center">{{ $loop->iteration }}</td>
                            <td style="font-size: small;" class="text-start">{{ $kendaraan->kode_barang }}</td>
                            <td style="font-size: small;" class="text-start">{{ $kendaraan->user->name ?? 'On-Sett' }}</td>
                            <td style="font-size: small;" class="text-start">{{ $kendaraan->jenis_barang }}</td>
                            <td style="font-size: small;" class="text-start">{{ $kendaraan->N_polisi }}</td>
                            <td style="font-size: small;" class="text-start">{{ $kendaraan->tgl_jatuh_tempo }}</td>
                            <td style="font-size: small;" class="text-center">
                                @if ($kendaraan->status == 'active')
                                <span class="badge bg-success">{{ $kendaraan->status }}</span>
                                @elseif($kendaraan->status == 'nonactive')
                                <span class="badge bg-danger">{{ $kendaraan->status }}</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@push('script')
<script>
    let table = new DataTable('#kendaraanTable', {
        ordering: false,
        autoWidth: false,
    });
</script>
@endpush()