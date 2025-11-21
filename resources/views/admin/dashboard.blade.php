<x-admin.layout :active="$active" :link="$link" :open="$open" :title="$title">
    <x-admin.dashboard>
        <x-jumlah-kendaraan :jumlahKendaraan="$jumlahKendaraan"></x-jumlah-kendaraan>
        <x-jumlah-user :jumlahUser="$jumlahUser"></x-jumlah-user>
    </x-admin.dashboard>
</x-admin.layout>