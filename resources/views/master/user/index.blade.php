<x-admin.layout :title="$title" :active="$active" :link="$link" :open="$open">
    <x-admin.data-user :users="$users" route-prefix="master.user"></x-admin.data-user>
</x-admin.layout>
