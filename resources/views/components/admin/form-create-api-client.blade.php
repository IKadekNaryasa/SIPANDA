{{-- Loading Overlay --}}
<x-overlay></x-overlay>

<div class="row">
    <div class="card mb-4">
        <h5 class="card-header text-center">Add New API Client</h5>
        <div class="card-body">
            <form action="{{ route('api-clients.store') }}" method="post" id="apiClientForm">
                @csrf
                <div id="formContainer">
                    <div class="form-item border p-3 mb-3 rounded" data-index="0">
                        <div class="row mb-1">
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Nama Pemohon</label>
                                <input type="text" name="name" class="form-control" value="{{ old('name') }}" autofocus required placeholder="Nama Lengkap">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" value="{{ old('email') }}" required placeholder="masukan Email">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Catatan (Optional)</label>
                                <input type="text" name="notes" class="form-control" value="{{ old('notes') }}" placeholder="Notes">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-4 text-center">
                        <button type="submit" name="submit" id="submitBtn" class="btn btn-success w-50">
                            <span id="submitText">Buat & Kirim</span>
                            <span id="submitSpinner" class="spinner-border spinner-border-sm ms-2 d-none" role="status"></span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    const apiClientForm = document.getElementById('apiClientForm');

    apiClientForm.addEventListener('submit', function(e) {
        loadingOverlay.classList.remove('d-none');
        apiClientForm.classList.add('form-disabled');
        submitBtn.disabled = true;
        submitText.textContent = 'Mengirim Email Aktivasi, mohon tunggu...';
        submitSpinner.classList.remove('d-none');
    });
</script>