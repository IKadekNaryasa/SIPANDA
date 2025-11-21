{{-- Loading Overlay --}}
<div class="row">
    <div class="card mb-4">
        <h5 class="card-header text-center">History Samsat</h5>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped w-100" id="samsatTable">
                    <thead>
                        <tr>
                            <th style="font-size: small;" class="text-center">No</th>
                            <th style="font-size: small;" class="text-start">Kode Barang</th>
                            <th style="font-size: small;" class="text-start">No. Polisi</th>
                            <th style="font-size: small;" class="text-start">Tgl. Samsat</th>
                            <th style="font-size: small;" class="text-start">Biaya</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($samsats as $samsat)
                        <tr>
                            <td style="font-size: small;" class="text-center">{{ $loop->iteration }}</td>
                            <td style="font-size: small;" class="text-start">{{ $samsat->kendaraan->kode_barang }}</td>
                            <td style="font-size: small;" class="text-start">{{ $samsat->kendaraan->N_polisi ?? 'On-Sett' }}</td>
                            <td style="font-size: small;" class="text-start">{{ $samsat->tgl_samsat }}</td>
                            <td style="font-size: small;" class="text-start">{{ $samsat->biaya }}</td>
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
    let table = new DataTable('#samsatTable', {
        ordering: false,
        autoWidth: false,
    });
</script>
@endpush()