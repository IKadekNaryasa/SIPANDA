<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Aktivasi API Token</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="bg-white rounded-lg shadow p-8 max-w-md w-full text-center">

        @if(isset($error))
        <div class="text-red-500 text-5xl mb-4">✗</div>
        <h1 class="text-xl font-bold text-gray-800 mb-2">Aktivasi Gagal</h1>
        <p class="text-gray-600">{{ $error }}</p>

        @elseif(isset($token))
        <div class="text-green-500 text-5xl mb-4">✓</div>
        <h1 class="text-xl font-bold text-gray-800 mb-2">Token Berhasil Diaktivasi!</h1>
        <p class="text-gray-600 mb-4">Simpan token berikut dengan aman. Token ini hanya ditampilkan sekali di halaman ini, namun juga sudah dikirimkan ke email Anda.</p>

        <div class="bg-gray-50 border rounded p-4 mb-4">
            <p class="text-xs text-gray-500 mb-1">Bearer Token Anda:</p>
            <code class="text-sm font-mono break-all text-blue-700 select-all">{{ $token }}</code>
        </div>

        <p class="text-xs text-gray-400">
            Gunakan token ini di header setiap request:<br>
            <code class="bg-gray-100 px-2 py-1 rounded">Authorization: Bearer {token}</code>
        </p>
        @endif

    </div>
</body>

</html>