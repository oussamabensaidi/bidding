<!DOCTYPE html>
<html>
<head>
    <title>Verify You’re Human</title>
    <script src="https://www.google.com/recaptcha/api.js?render='{{ env('NOCAPTCHA_SITEKEY') }}'"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="flex items-center justify-center min-h-screen bg-gray-100">
    <form id="captcha-form" action="{{ route('captcha.verify') }}" method="POST" class="bg-white p-6 rounded shadow-md">
        @csrf
        @method('POST')

        <input type="hidden" name="g-recaptcha-response" id="recaptcha-response">

        <button type="submit" class="justify-center mt-4 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-700">
            Verify
        </button>
    </form>

    <script>
        document.getElementById('captcha-form').addEventListener('submit', function(event) {
            event.preventDefault(); // Stop the form from submitting immediately
    
            grecaptcha.ready(function() {
                grecaptcha.execute('{{ env("NOCAPTCHA_SITEKEY") }}', { action: 'submit' }).then(function(token) {
                    document.getElementById('recaptcha-response').value = token;
                    document.getElementById('captcha-form').submit(); // Now submit the form
                });
            });
        });
    </script>
    
</body>
</html>
