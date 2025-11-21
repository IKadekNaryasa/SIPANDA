<x-operator.layout :active="$active" :link="$link" :open="$open" :title="$title">
    <x-operator.dashboard>
        <x-operator.kendaraan-by-operator :kendaraans="$kendaraans"></x-operator.kendaraan-by-operator>
    </x-operator.dashboard>
</x-operator.layout>