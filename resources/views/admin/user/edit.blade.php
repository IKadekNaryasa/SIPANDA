<x-admin.layout :active="$active" :link="$link" :open="$open" :title="$title">
    <x-admin.form-edit-user :user="$user" :available-roles="$availableRoles"></x-admin.form-edit-user>
</x-admin.layout>