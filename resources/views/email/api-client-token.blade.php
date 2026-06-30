<x-mail::message>
    # Token API Anda Telah Aktif 🎉

    Halo **{{ $client->name }}**,

    Token API Anda telah berhasil diaktivasi. Berikut adalah token Anda:

    <x-mail::panel>
        `{{ $plainToken }}`
    </x-mail::panel>

    **Cara penggunaan:**

    Tambahkan header berikut di setiap request API:

    ```
    Authorization: Bearer {{ $plainToken }}
    Accept: application/json
    ```

    > Simpan token ini dengan aman. Jangan bagikan kepada siapapun.

    Terima kasih,
    {{ config('app.name') }}
</x-mail::message>