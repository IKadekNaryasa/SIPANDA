<x-admin.layout :active="$active" :link="$link" :open="$open" :title="$title">
    <div class="row">
        <div class="col-md-6 col-12 mb-4">
            <div class="card">
                <div class="card-body">
                    <span class="fw-semibold d-block mb-1">User Master</span>
                    <h3 class="card-title mb-2">{{ $jumlahUserMaster }}</h3>
                    <a href="{{ route('master.user.index') }}">Kelola User Master</a>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-12 mb-4">
            <div class="card">
                <div class="card-body">
                    <span class="fw-semibold d-block mb-1">API Client</span>
                    <h3 class="card-title mb-2">{{ $jumlahApiClient }}</h3>
                    <a href="{{ route('api-clients.index') }}">Kelola API Client</a>
                </div>
            </div>
        </div>
    </div>
</x-admin.layout>
