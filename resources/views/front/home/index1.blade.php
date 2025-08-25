<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Talent Booking Platform</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold text-center mb-8">Talent Booking Platform</h1>
        
        <div class="text-center">
            <p class="text-lg mb-6">Welcome to our talent booking platform</p>
            
            <div class="space-x-4">
                <a href="/admin/login" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Admin Login
                </a>
                <a href="/member/auth/logins" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                    Member Login
                </a>
                <a href="/talent/auth/logins" class="bg-purple-500 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded">
                    Talent Login
                </a>
            </div>
        </div>
    </div>
</body>
</html>
