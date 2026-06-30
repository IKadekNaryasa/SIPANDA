<x-mail::message>
    # Aktivasi API Token

    Halo **{{ $client->name }}**,

    Admin telah mendaftarkan akun API Anda. Klik tombol di bawah untuk mengaktifkan token Anda.

    <x-mail::button :url="$activationUrl" color="blue">
        Aktifkan Token Saya
    </x-mail::button>

    > **Penting:** Link ini hanya berlaku hingga **{{ $expiredAt }}** dan hanya bisa digunakan **1 kali**.

    Jika Anda tidak merasa mendaftar, abaikan email ini.

    Terima kasih,
    {{ config('app.name') }}
</x-mail::message>