<!DOCTYPE html>
<html>
<head>
    <title>Verify You’re Human</title>
    {!! NoCaptcha::renderJs() !!}
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="flex items-center justify-center min-h-screen bg-gray-100">
    <form action="{{ route('captcha.verify') }}" method="POST" class="bg-white p-6 rounded shadow-md">
        @csrf
        @method('POST')
        {!! NoCaptcha::display() !!}
        <button type="submit" class="justify-center mt-4 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-700">Verify</button>
    </form>
</body>
</html>
