{{-- Loading Overlay --}}
<x-overlay></x-overlay>

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
                            <th style="font-size: small;" class="text-center">Action</th>
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
                            <td style="font-size: small;" class="text-center">
                                <div class="d-inline-flex gap-2">
                                    <a href="{{ route('kendaraan.edit',$kendaraan->id) }}" class="text-warning"
                                        data-bs-toggle="tooltip" data-bs-placement="left" title="edit">
                                        <i class='bx bxs-edit'></i>
                                    </a>

                                    <form action="{{ route('kendaraan.setStatus',$kendaraan->id) }}" method="POST"
                                        id="formUpdateKendaraan{{ $kendaraan->id }}" class="d-inline">
                                        @csrf
                                        @method('PUT')
                                        @if ($kendaraan->status == 'active')
                                        <input type="hidden" name="status" value="nonactive">
                                        <button type="button" class="btn btn-link p-0 text-success"
                                            data-bs-toggle="tooltip" data-bs-placement="top" title="Confirm"
                                            onclick="confirmNonactive('{{ $kendaraan->id }}', '{{ $kendaraan->N_polisi }}', 'Non Aktifkan')">
                                            <i class='bx bxs-info-circle'></i>
                                        </button>
                                        @else
                                        <input type="hidden" name="status" value="active">
                                        <button type="button" class="btn btn-link p-0 text-danger"
                                            data-bs-toggle="tooltip" data-bs-placement="top" title="Confirm"
                                            onclick="confirmNonactive('{{ $kendaraan->id }}', '{{ $kendaraan->N_polisi }}', 'Aktifkan')">
                                            <i class='bx bxs-info-circle'></i>
                                        </button>
                                        @endif
                                    </form>
                                </div>
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
<script>
    const formUpdateKendaraan = document.getElementById('formUpdateKendaraan');

    function confirmNonactive(id, name, status) {
        Swal.fire({
            title: "Konfirmasi",
            text: `Kendaraan ${name} akan di ${status}. Lanjutkan?`,
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya, lanjutkan!",
            cancelButtonText: "Batal"
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById(`formUpdateKendaraan${id}`).submit();
                loadingOverlay.classList.remove('d-none');
                formUpdateKendaraan.classList.add('form-disabled');
                submitBtn.disabled = true;
                submitText.textContent = 'Menyimpan data, mohon tunggu...';
                submitSpinner.classList.remove('d-none');
            }
        });
    }
</script>
@endpush()