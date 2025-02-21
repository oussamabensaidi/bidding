<!DOCTYPE html>
<html>
<head>
    <title>Verify You’re Human</title>
    <!-- Change to v2 script -->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="flex items-center justify-center min-h-screen bg-gray-100">
    <form action="{{ route('captcha.verify', ['item' => $item->id]) }}" method="POST" class="bg-white p-6 rounded shadow-md">
        @csrf

        @if ($errors->has('captcha'))
            <div class="mb-4 text-red-500">{{ $errors->first('captcha') }}</div>
        @endif

        <!-- Add v2 widget -->
        <div class="g-recaptcha mb-4" data-sitekey="{{ env('NOCAPTCHA_SITEKEY') }}"></div>

        <button type="submit" class="justify-center mt-4 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-700">
            Verify
        </button>
    </form>
</body>
</html>