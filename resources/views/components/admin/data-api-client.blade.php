{{-- Loading Overlay --}}
<x-overlay></x-overlay>

<div class="row">
    <div class="card mb-4">
        <h5 class="card-header text-center">Data Api Clients</h5>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped w-100" id="apiClientTable">
                    <thead>
                        <tr>
                            <th style="font-size: small;" class="text-center">No</th>
                            <th style="font-size: small;">Nama</th>
                            <th style="font-size: small;" class="text-start">Email</th>
                            <th style="font-size: small;" class="text-center">Aktivasi</th>
                            <th style="font-size: small;" class="text-center">Status</th>
                            <th style="font-size: small;" class="text-center">Terakhir Digunakan</th>
                            <th style="font-size: small;" class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($clients as $client)
                        <tr>
                            <td style="font-size: small;" class="text-center">{{ $loop->iteration }}</td>
                            <td style="font-size: small;" class="text-start">{{ $client->name }}</td>
                            <td style="font-size: small;" class="text-start">{{ $client->email }}</td>
                            <td style="font-size: small;" class="text-center">{{ $client->activated_at ? $client->activated_at->format('d M Y H:i') : '-' }}</td>
                            <td style="font-size: small;" class="text-center">
                                @if ($client->status == 'active')
                                <span class="badge bg-success">{{ $client->status }}</span>
                                @elseif($client->status == 'nonactive')
                                <span class="badge bg-danger">{{ $client->status }}</span>
                                @endif
                            </td>
                            <td style="font-size: small;" class="text-center">{{ $client->last_used_at ? $client->last_used_at->diffForHumans() : '-' }}</td>
                            <td style="font-size: small;" class="text-center">
                                <div class="d-inline-flex gap-2">
                                    <form action="{{ route('api-clients.toggle',$client) }}" method="POST"
                                        id="formUpdateApiClient{{ $client->id }}" class="d-inline">
                                        @csrf
                                        @method('PATCH')
                                        @if ($client->status == 'active')
                                        <input type="hidden" name="status" value="nonactive">
                                        <button type="button" class="btn btn-link p-0 text-success"
                                            data-bs-toggle="tooltip" data-bs-placement="top" title="Confirm"
                                            onclick="confirmNonactive('{{ $client->id }}', '{{ $client->name }}', 'Non Aktifkan')">
                                            <i class='bx bxs-info-circle'></i>
                                        </button>
                                        @else
                                        <!-- <input type="hidden" name="status" value="active">
                                        <button type="button" class="btn btn-link p-0 text-danger"
                                            data-bs-toggle="tooltip" data-bs-placement="top" title="Confirm"
                                            onclick="confirmNonactive('{{ $client->id }}', '{{ $client->name }}', 'Aktifkan')">
                                            <i class='bx bxs-info-circle'></i>
                                        </button> -->
                                        @endif
                                    </form>
                                    @if ($client->status === 'nonactive')
                                    <form action="{{ route('api-clients.resend',$client) }}" method="POST"
                                        id="formResend{{ $client->id }}" class="d-inline">
                                        @csrf
                                        <button type="button" class="btn btn-link p-0 text-danger"
                                            data-bs-toggle="tooltip" data-bs-placement="top" title="Kirim Ulang Link AKtivasi"
                                            onclick="confirmResend('{{ $client->id }}', '{{ $client->name }}', 'Kirim Ulang')">
                                            <i class='bx bxs-info-circle'></i>
                                        </button>
                                    </form>
                                    @endif

                                    <form action="{{ route('api-clients.destroy',$client) }}" method="POST"
                                        id="formDeleteAPIClient{{ $client->id }}" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        @if ($client->status == 'nonactive')
                                        <button type="button" class="btn btn-link p-0 text-danger"
                                            data-bs-toggle="tooltip" data-bs-placement="top" title="Delete"
                                            onclick="confirmDelete('{{ $client->id }}', '{{ $client->name }}', '{{ $client->email }}', 'di-Hapus')">
                                            <i class='bx bxs-trash'></i>
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
    let table = new DataTable('#apiClientTable', {
        ordering: false,
        autoWidth: false,
    });
</script>
<script>
    const formUpdateApiClient = document.getElementById('formUpdateApiClient');
    const formResend = document.getElementById('formResend');
    const formDeleteAPIClient = document.getElementById('formDeleteAPIClient');

    function confirmNonactive(id, name, status) {
        Swal.fire({
            title: "Konfirmasi",
            text: `Api Client ${name} akan di ${status}. Lanjutkan?`,
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya, lanjutkan!",
            cancelButtonText: "Batal"
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById(`formUpdateApiClient${id}`).submit();
                loadingOverlay.classList.remove('d-none');
                formUpdateApiClient.classList.add('form-disabled');
                submitBtn.disabled = true;
                submitText.textContent = 'Menyimpan data, mohon tunggu...';
                submitSpinner.classList.remove('d-none');
            }
        });
    }

    function confirmResend(id, name) {
        Swal.fire({
            title: "Konfirmasi",
            text: `Link Aktivasi Akan dikirim Ulang. Lanjutkan?`,
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya, lanjutkan!",
            cancelButtonText: "Batal"
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById(`formResend${id}`).submit();
                loadingOverlay.classList.remove('d-none');
                formUpdateApiClient.classList.add('form-disabled');
                submitBtn.disabled = true;
                submitText.textContent = 'Mengirim Email Aktivasi, mohon tunggu...';
                submitSpinner.classList.remove('d-none');
            }
        });
    }

    function confirmDelete(id, name, email) {
        Swal.fire({
            title: "Konfirmasi",
            text: `Api Client ${name} dengan email ${email} akan dihapus. Lanjutkan?`,
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya, lanjutkan!",
            cancelButtonText: "Batal"
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById(`formDeleteAPIClient${id}`).submit();
                loadingOverlay.classList.remove('d-none');
                formUpdateApiClient.classList.add('form-disabled');
                submitBtn.disabled = true;
                submitText.textContent = 'Menghapus Data, mohon tunggu...';
                submitSpinner.classList.remove('d-none');
            }
        });
    }
</script>
@endpush()